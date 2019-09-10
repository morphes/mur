<?php
 namespace Magento\Framework\Session;
 
 use Magento\Framework\Session\Config\ConfigInterface;
 
 class SessionManager implements SessionManagerInterface
 {
     protected $defaultDestroyOptions = ['send_expire_cookie' => true, 'clear_storage' => true];
 
     protected static $urlHostCache = [];
 
     protected $validator;
 
     protected $request;
 
     protected $sidResolver;
 
     protected $sessionConfig;
 
     protected $saveHandler;
 
     protected $storage;
 
     protected $cookieManager;
 
     protected $cookieMetadataFactory;
 
     private $appState;
 
     public function __construct(
         \Magento\Framework\App\Request\Http $request,
         SidResolverInterface $sidResolver,
         ConfigInterface $sessionConfig,
         SaveHandlerInterface $saveHandler,
         ValidatorInterface $validator,
         StorageInterface $storage,
         \Magento\Framework\Stdlib\CookieManagerInterface $cookieManager,
         \Magento\Framework\Stdlib\Cookie\CookieMetadataFactory $cookieMetadataFactory,
         \Magento\Framework\App\State $appState
     ) {
         $this->request = $request;
         $this->sidResolver = $sidResolver;
         $this->sessionConfig = $sessionConfig;
         $this->saveHandler = $saveHandler;
         $this->validator = $validator;
         $this->storage = $storage;
         $this->cookieManager = $cookieManager;
         $this->cookieMetadataFactory = $cookieMetadataFactory;
         $this->appState = $appState;
         $this->start();
     }
 
     public function writeClose()
     {
         session_write_close();
     }
 
     public function __call($method, $args)
     {
         if (!in_array(substr($method, 0, 3), ['get', 'set', 'uns', 'has'])) {
             throw new \InvalidArgumentException(
                 sprintf('Invalid method %s::%s(%s)', get_class($this), $method, print_r($args, 1))
             );
         }
         $return = call_user_func_array([$this->storage, $method], $args);
         return $return === $this->storage ? $this : $return;
     }
 
     public function start()
     {
         if (!$this->isSessionExists()) {
             \Magento\Framework\Profiler::start('session_start');
 
             try {
                 $this->appState->getAreaCode();
             } catch (\Magento\Framework\Exception\LocalizedException $e) {
                 throw new \Magento\Framework\Exception\SessionException(
                     new \Magento\Framework\Phrase(
                         'Area code not set: Area code must be set before starting a session.'
                     ),
                     $e
                 );
             }
 
             // Need to apply the config options so they can be ready by session_start
             $this->initIniOptions();
             $this->registerSaveHandler();
             if (isset($_SESSION['new_session_id'])) {
                 // Not fully expired yet. Could be lost cookie by unstable network.
                 session_commit();
                 session_id($_SESSION['new_session_id']);
             }
             $sid = $this->sidResolver->getSid($this);
             // potential custom logic for session id (ex. switching between hosts)
             $this->setSessionId($sid);
             session_start();
             if (isset($_SESSION['destroyed'])
                 && $_SESSION['destroyed'] < time() - $this->sessionConfig->getCookieLifetime()
             ) {
                 $this->destroy(['clear_storage' => true]);
             }
 
             $this->validator->validate($this);
             $this->renewCookie($sid);
 
             register_shutdown_function([$this, 'writeClose']);
 
             $this->_addHost();
             \Magento\Framework\Profiler::stop('session_start');
         }
         $this->storage->init(isset($_SESSION) ? $_SESSION : []);
         return $this;
     }
 
     private function renewCookie($sid)
     {
         if (!$this->getCookieLifetime()) {
             return $this;
         }
         //When we renew cookie, we should aware, that any other session client do not
         //change cookie too
         $cookieValue = $sid ?: $this->cookieManager->getCookie($this->getName());
         if ($cookieValue) {
             $metadata = $this->cookieMetadataFactory->createPublicCookieMetadata();
             $metadata->setPath($this->sessionConfig->getCookiePath());
             $metadata->setDomain($this->sessionConfig->getCookieDomain());
             $metadata->setDuration($this->sessionConfig->getCookieLifetime());
             $metadata->setSecure($this->sessionConfig->getCookieSecure());
             $metadata->setHttpOnly($this->sessionConfig->getCookieHttpOnly());
 
             $this->cookieManager->setPublicCookie(
                 $this->getName(),
                 $cookieValue,
                 $metadata
             );
         }
 
         return $this;
     }
 
     protected function registerSaveHandler()
     {
         return session_set_save_handler(
             [$this->saveHandler, 'open'],
             [$this->saveHandler, 'close'],
             [$this->saveHandler, 'read'],
             [$this->saveHandler, 'write'],
             [$this->saveHandler, 'destroy'],
             [$this->saveHandler, 'gc']
         );
     }
 
     public function isSessionExists()
     {
         if (session_status() === PHP_SESSION_NONE && !headers_sent()) {
             return false;
         }
         return true;
     }
 
     public function getData($key = '', $clear = false)
     {
         $data = $this->storage->getData($key);
         if ($clear && isset($data)) {
             $this->storage->unsetData($key);
         }
         return $data;
     }
 
     public function getSessionId()
     {
         return session_id();
     }
 
     public function getName()
     {
         return session_name();
     }
 
     public function setName($name)
     {
         session_name($name);
         return $this;
     }
 
     public function destroy(array $options = null)
     {
         $options = $options ?? [];
         $options = array_merge($this->defaultDestroyOptions, $options);
 
         if ($options['clear_storage']) {
             $this->clearStorage();
         }
 
         if (session_status() !== PHP_SESSION_ACTIVE) {
             return;
         }
 
         session_regenerate_id(true);
         session_destroy();
         if ($options['send_expire_cookie']) {
             $this->expireSessionCookie();
         }
     }
 
     public function clearStorage()
     {
         $this->storage->unsetData();
         return $this;
     }
 
     public function getCookieDomain()
     {
         return $this->sessionConfig->getCookieDomain();
     }
 
     public function getCookiePath()
     {
         return $this->sessionConfig->getCookiePath();
     }
 
     public function getCookieLifetime()
     {
         return $this->sessionConfig->getCookieLifetime();
     }
 
     public function setSessionId($sessionId)
     {
         $this->_addHost();
         if ($sessionId !== null && preg_match('#^[0-9a-zA-Z,-]+$#', $sessionId)) {
             session_id($sessionId);
         }
         return $this;
     }
 
     public function getSessionIdForHost($urlHost)
     {
         $httpHost = $this->request->getHttpHost();
         if (!$httpHost) {
             return '';
         }
 
         $urlHostArr = explode('/', $urlHost, 4);
         if (!empty($urlHostArr[2])) {
             $urlHost = $urlHostArr[2];
         }
         $urlPath = empty($urlHostArr[3]) ? '' : $urlHostArr[3];
 
         if (!isset(self::$urlHostCache[$urlHost])) {
             $urlHostArr = explode(':', $urlHost);
             $urlHost = $urlHostArr[0];
             $sessionId = $httpHost !== $urlHost && !$this->isValidForHost($urlHost) ? $this->getSessionId() : '';
             self::$urlHostCache[$urlHost] = $sessionId;
         }
 
         return $this->isValidForPath($urlPath) ? self::$urlHostCache[$urlHost] : $this->getSessionId();
     }
 
     public function isValidForHost($host)
     {
         $hostArr = explode(':', $host);
         $hosts = $this->_getHosts();
         return !empty($hosts[$hostArr[0]]);
     }
 
     public function isValidForPath($path)
     {
         $cookiePath = trim($this->getCookiePath(), '/') . '/';
         if ($cookiePath == '/') {
             return true;
         }
 
         $urlPath = trim($path, '/') . '/';
         return strpos($urlPath, $cookiePath) === 0;
     }
 
     protected function _addHost()
     {
         $host = $this->request->getHttpHost();
         if (!$host) {
             return $this;
         }
 
         $hosts = $this->_getHosts();
         $hosts[$host] = true;
         $_SESSION[self::HOST_KEY] = $hosts;
         return $this;
     }
 
     protected function _getHosts()
     {
         return $_SESSION[self::HOST_KEY] ?? [];
     }
 
     protected function _cleanHosts()
     {
         unset($_SESSION[self::HOST_KEY]);
         return $this;
     }
 
     public function regenerateId()
     {
         if (headers_sent()) {
             return $this;
         }
 
         if ($this->isSessionExists()) {
             // Regenerate the session
             session_regenerate_id();
             $newSessionId = session_id();
             $_SESSION['new_session_id'] = $newSessionId;
 
             // Set destroy timestamp
             $_SESSION['destroyed'] = time();
 
             // Write and close current session;
             session_commit();
 
             // Called after destroy()
             $oldSession = $_SESSION;
 
             // Start session with new session ID
             session_id($newSessionId);
             session_start();
             $_SESSION = $oldSession;
 
             // New session does not need them
             unset($_SESSION['destroyed']);
             unset($_SESSION['new_session_id']);
         } else {
             session_start();
         }
 
         $this->storage->init(isset($_SESSION) ? $_SESSION : []);
 
         if ($this->sessionConfig->getUseCookies()) {
             $this->clearSubDomainSessionCookie();
         }
         return $this;
     }
 
     protected function clearSubDomainSessionCookie()
     {
         foreach (array_keys($this->_getHosts()) as $host) {
             // Delete cookies with the same name for parent domains
             if ($this->sessionConfig->getCookieDomain() !== $host) {
                 $metadata = $this->cookieMetadataFactory->createPublicCookieMetadata();
                 $metadata->setPath($this->sessionConfig->getCookiePath());
                 $metadata->setDomain($host);
                 $metadata->setSecure($this->sessionConfig->getCookieSecure());
                 $metadata->setHttpOnly($this->sessionConfig->getCookieHttpOnly());
                 $this->cookieManager->deleteCookie($this->getName(), $metadata);
             }
         }
     }
 
     public function expireSessionCookie()
     {
         if (!$this->sessionConfig->getUseCookies()) {
             return;
         }
 
         $metadata = $this->cookieMetadataFactory->createPublicCookieMetadata();
         $metadata->setPath($this->sessionConfig->getCookiePath());
         $metadata->setDomain($this->sessionConfig->getCookieDomain());
         $metadata->setSecure($this->sessionConfig->getCookieSecure());
         $metadata->setHttpOnly($this->sessionConfig->getCookieHttpOnly());
         $this->cookieManager->deleteCookie($this->getName(), $metadata);
         $this->clearSubDomainSessionCookie();
     }
 
     private function initIniOptions()
     {
         $result = ini_set('session.use_only_cookies', '1');
         if ($result === false) {
             $error = error_get_last();
             throw new \InvalidArgumentException(
                 sprintf('Failed to set ini option session.use_only_cookies to value 1. %s', $error['message'])
             );
         }
 
         foreach ($this->sessionConfig->getOptions() as $option => $value) {
             if ($option=='session.save_handler') {
                 continue;
             } else {
                 $result = ini_set($option, $value);
                 if ($result === false) {
                     $error = error_get_last();
                     throw new \InvalidArgumentException(
                         sprintf('Failed to set ini option "%s" to value "%s". %s', $option, $value, $error['message'])
                     );
                 }
             }
         }
     }
 }
