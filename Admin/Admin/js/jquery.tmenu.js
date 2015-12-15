
(function ($) {
    var defaultOptions = {
        'width': 'auto'
    };

    var $menu = null;

    $.fn.tmenu = function (options) {
        var opt = $.extend(defaultOptions, options);

        return this.each(function (index, elem) {
            var $elem = $(elem);

            $elem.parent().css({
                'position': 'relative'
            });

            $elem.siblings('ul').css({
                'position': 'absolute',
                'left': '-95px',
                'top': '27.1px',
                'margin': '0px',
                'padding': '0px',
                'background': '#E1E1E1',
                'width': opt.width
            }).hide();
            
            $elem.click(function (event) {
                event.preventDefault();

                if ($menu != null) {
                    $menu.hide();
                }

                var $this = $(this);
                var $ul = $this.siblings('ul');
                $ul.show();
                $menu = $ul;
                event.stopImmediatePropagation();
            });
        });
    };
    
    $(document).on('click', 'body', function (event) {
         if ($menu != null) {
            $menu.hide();
            $menu = null;
         }
    });

})(jQuery);
