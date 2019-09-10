Magento 2 AdminUsefulLinks by Mageside
======================================

####Support
    v1.0.4 - Magento 2.2.* - 2.3.*

####Change list
    v1.0.4 - Links preview fix added
    v1.0.2 - Added Magento 2.3 compatibility
    v1.0.1 - Added Magento EE compatibility;
    v1.0.0 - Start project

####Installation
    1. Download the archive.
    2. Make sure to create the directory structure in your Magento - 'Magento_Root/app/code/Mageside/AdminUsefulLinks'.
    3. Unzip the content of archive (use command 'unzip ArchiveName.zip') 
       to directory 'Magento_Root/app/code/Mageside/AdminUsefulLinks'.
    4. Run the command 'php bin/magento module:enable Mageside_AdminUsefulLinks' in Magento root.
       If you need to clear static content use 'php bin/magento module:enable --clear-static-content Mageside_AdminUsefulLinks'.
    5. Run the command 'php bin/magento setup:upgrade' in Magento root.
    6. Run the command 'php bin/magento setup:di:compile' if you have a single website and store, 
       or 'php bin/magento setup:di:compile-multi-tenant' if you have multiple ones.
    7. Clear cache: 'php bin/magento cache:clean', 'php bin/magento cache:flush'
