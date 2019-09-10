$(document).ready(function(){

    // $("#menu").mmenu();

    $('.block-title').click(function(){
        $('.block-content').toggle(100);
        $('.filter-options').toggle(20);
        return false;
    });


    $('nav#menu').mmenu({
        extensions	: [ 'theme-dark' ],
        setSelected	: true,
        counters	: true,
        searchfield : {
            placeholder		: 'Part Number Search'
        },
        navbars		: [
            {
                "position": "bottom",
                "content": [
                    "<a class=\"addthis_button_compact at300m\" href=\"#\"><img src=\"/pub/images/share.jpg\" alt=\"Share\" title=\"Share\"></a>",
                    "<a class='fa fa-envelope' href='https://power.murata.com/en/products/contact.html'></a>",
                    "<a class='fa fa-print' href=\"javascript:window.print()\"></a>"
                ]
            },
            {
                content		: [ 'searchfield' ]
            }, {
                type		: 'tabs',
                content		: [
                    '<a href="#panel-menu"> <span>Menu</span></a>',
                    '<a href="#panel-account"><span>Global</span></a>',
                ]
            }, {
                content		: [ 'prev', 'breadcrumbs', 'close' ]
            },
        ]
    }, {
        searchfield : {
            clear 		: true
        },
        navbars		: {
            breadcrumbs	: {
                removeFirst	: true
            }
        }
    });

});
