define(['module', 'Manadev_Core/js/functions/class', 'Manadev_Core/js/Data'],
function(module, class_, Data) {
    return class_(module.id, Data, {
        __constructor: function(data) {
            Data.prototype.__constructor.call(this, data);
            this.state = this.getInitialState();
            this.change_listeners = [];
            this.operation = 'restore';
            this.generated_hashes = [];

            if (this.use_history && window.history && history.pushState && history.replaceState) {
                history.replaceState(this.state, document.title);
                window.addEventListener('popstate', (function(event) {
                    if (!event.state) {
                        return;
                    }

                    if (!this.enabled && event.state.url) {
                        location.href = event.state.url;
                        return;
                    }

                    this.state = event.state;
                    this.notifyListeners();
                    this.operation = 'restore';
                }).bind(this), false);
            }
            else {
                this.operation = 'reset';
                location.hash = '';
                window.addEventListener("hashchange", (function(event) {
                    this.state = this.parseHash();
                    this.notifyListeners();
                    this.operation = 'restore';
                }).bind(this), false);
            }
        },
        getInitialState: function() {
            return {
                url: this.url,
                confirmed_actions: [],
                pending_actions: []
            };
        },
        addAction: function(action, leaveHistoryUnaffected) {
            this.state.pending_actions.push(action);
            this.operation = 'add_action';

            if (leaveHistoryUnaffected) {
                return;
            }

            this.apply(true);
        },

        apply: function(keepCurrentOperation) {
            if (!keepCurrentOperation) {
                this.operation = 'apply';
            }

            if (!this.enabled) {
                this.notifyListeners();
            }
            else if (this.use_history && window.history && history.pushState) {
                history.pushState(this.state, document.title);
                this.notifyListeners();
            }
            else {
                this.generateHash(this.state);
            }
        },

        reset: function (url) {
            this.state = {
                url: url,
                confirmed_actions: this.state.confirmed_actions.concat(this.state.pending_actions),
                pending_actions: []
            };
            this.operation = 'reset';

            if (this.enabled && this.use_history && window.history && history.replaceState) {
                history.replaceState(this.state, document.title, url);
            }

            this.notifyListeners();
            this.operation = 'restore';
        },

        addChangeListener: function(listener) {
            this.change_listeners.push(listener);
        },
        notifyListeners: function() {
            this.change_listeners.forEach(function(listener) {
                listener();
            });
        },

        parseHash: function() {
            var match = location.hash.match(/#ajax-layered-navigation-(\d+)/);

            if (!match) {
                return this.getInitialState();
            }

            if (parseInt(match[1]) > this.generated_hashes.length) {
                return this.getInitialState();
            }

            return JSON.parse(this.generated_hashes[parseInt(match[1]) - 1]);
        },
        generateHash: function (state) {
            this.generated_hashes.push(JSON.stringify(state));
            location.hash = '#ajax-layered-navigation-' + this.generated_hashes.length;
        }
    });
});