/* ==========================================================
 * bc-bootstrap-collection.js
 * http://bootstrap.braincrafted.comn
 * ==========================================================
 * Copyright 2013 Florian Eckerstorfer
 *
 * ========================================================== */


!function ($) {

    "use strict"; // jshint ;_;

    /* COLLECTION CLASS DEFINITION
     * ====================== */

    var add = '[data-add="collection"]',
        Collection = function (el) {
            $(el).on('click', add, this.add);
        }
    ;

    Collection.prototype.add = function (e) {
        var $this = $(this),
            selector = $this.attr('data-collection'),
            $parent
        ;

        $parent = $(selector);

        e && e.preventDefault();

        var collection = $('#'+selector),
            list = collection.find('ul'),
            count = list.find('li').size()
        ;

        var newWidget = collection.attr('data-prototype');
        newWidget = newWidget.replace(/__name__/g, count);
        var newLi = $('<li></li>').html(newWidget);
        newLi.appendTo(list);
    };


    /* COLLECTION PLUGIN DEFINITION
     * ======================= */

    var old = $.fn.collection;

    $.fn.collection = function (option) {
        return this.each(function () {
            var $this = $(this),
                data = $this.data('collection')
            ;
            if (!data) {
                $this.data('collection', (data = new Collection(this)));
            }
            if (typeof option == 'string') {
                data[option].call($this);
            }
        });
    };

    $.fn.collection.Constructor = Collection;


    /* COLLECTION NO CONFLICT
     * ================= */

    $.fn.collection.noConflict = function () {
        $.fn.collection = old;
        return this;
    }


    /* COLLECTION DATA-API
     * ============== */

    $(document).on('click.collection.data-api', add, Collection.prototype.add);

 }(window.jQuery);