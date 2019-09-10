define([
    'jquery',
    'Manadev_Core/js/vars/session',
    'jquery/ui'
], function($, session) {
    var state = {};

    $.widget('mana.manadevCategoryTreeFilter', {
        _getStateKey: function() {
            return this.element[0].id + '_' + this.options.default_state;
        },

        _getState: function() {
            return this.state;
        },

        _setState: function(state) {
            this.state = state;
            $(this.element).find(".mana-tree-item").each(function(index, div) {
                var li = $(div).parent();
                if (this.state[li.data('tree-id')]) {
                    if (this.options.default_state == 'collapse') {
                        this.expand(li);
                    }
                    else {
                        this.collapse(li);
                    }
                }
            }.bind(this));
        },


        _saveStateInSession: function() {
            session.save(this._getStateKey(), this._getState());
        },

        _restoreStateFromSession: function() {
            var state;

            try {
                state = session.restore(this._getStateKey());
                if (state) {
                    this._setState(state);
                }
            }
            catch (e) {
            }
        },

        _saveStateInMemory: function() {
            state[this._getStateKey()] = this._getState();
        },

        _restoreStateFromMemory: function() {
            if (state[this._getStateKey()]) {
                this._setState(state[this._getStateKey()]);
                delete state[this._getStateKey()];
            }
        },

        _create: function() {
            $(document).on('mana-before-replacing-content',
                this._bound_beforeReplacingContent = this._beforeReplacingContent.bind(this));
            $(this.element).find(".mana-tree-item").on('click',
                this._bound_treeItemClicked = this._treeItemClicked.bind(this));

            this.state = {};
            if ($(document).data('mana-replacing-content')) {
                this._restoreStateFromMemory();
            }
            else {
                this._restoreStateFromSession();
            }
        },
        _destroy: function() {
            $(this.element).find(".mana-tree-item").off('click', this._bound_treeItemClicked);
        },

        _treeItemClicked: function(event) {
            var li = $(event.currentTarget).parent();

            if(li.hasClass('mana-collapsed')) {
                this.expand(li, true);
                if (this.options.default_state == 'collapse') {
                    this.state[li.data('tree-id')] = 1;
                }
                else if (this.state[li.data('tree-id')]) {
                    delete this.state[li.data('tree-id')];
                }
                this._saveStateInSession();

            }
            else if(li.hasClass('mana-expanded')) {
                this.collapse(li, true);
                if (this.options.default_state == 'expand') {
                    this.state[li.data('tree-id')] = 1;
                }
                else if (this.state[li.data('tree-id')]) {
                    delete this.state[li.data('tree-id')];
                }
                this._saveStateInSession();
            }
        },

        _beforeReplacingContent: function (event, $containers) {
            if ($containers.has(this.element[0]).length) {
                this._saveStateInMemory();
            }
        },

        expand: function(li, showAnimation) {
            var ul = li.find('ul').first();

            if(showAnimation) {
                ul.slideDown('fast', function() {
                    li.removeClass('mana-collapsed').addClass('mana-expanded');
                });
            } else {
                ul.show();
                li.removeClass('mana-collapsed').addClass('mana-expanded');
            }
        },
        collapse: function(li, showAnimation) {
            showAnimation = showAnimation === undefined ? true: showAnimation;
            var ul = li.find('ul').first();

            if(showAnimation) {
                ul.slideUp('fast', function() {
                    li.removeClass('mana-expanded').addClass('mana-collapsed');
                });
            } else {
                ul.hide();
                li.removeClass('mana-expanded').addClass('mana-collapsed');
            }
        }
    });

    return $.mana.manadevCategoryTreeFilter;
});
