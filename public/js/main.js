// main script

(function($) {
    $(document).ready(function() {

        $('[data-toggle]').on('click', function() {
            $(this).toggleClass('active').siblings().removeClass('active');
        });

        $('[data-active]').on('click', function() {
            $(this).toggleClass('active');
        });

        $('[data-control]').on('click', function() {
            let sibling = $(this).data('control');
            $('.' + sibling).toggleClass('active');
        });

        // Lazy and counters
        $(window).scroll( function() {
            $('[data-count]').each(function () {
                let target = $(this);
                if ( isOnScreen(target) && !target.hasClass('counted') ) {
                    countUp(target);
                    target.addClass('counted');
                }
            });
            $('[data-width]').each(function () {
                let target = $(this);
                if ( isOnScreen(target) && !target.hasClass('counted') ) {
                    setWidth(target);
                    target.addClass('counted');
                }
            });
            $('[data-src]').each(function () {
                let target = $(this);
                if ( isOnScreen(target) && !target.hasClass('counted') ) {
                    let src = $(this).data('src');
                    $(this).attr('src', src);
                    target.addClass('counted');
                }
            });
        });

        function countUp(target) {
            let defaultCount = parseFloat(target.text());
            let totalCount = target.data('count');
            let increaser = Math.floor(totalCount / 20);
            defaultCount = defaultCount + increaser;
            if ( totalCount >= defaultCount ) {
                target.text(parseFloat(defaultCount).toFixed());
                setTimeout(() => {
                    countUp(target);
                }, 100);
            } else {
                return;
            }
        }

        function isOnScreen(elem) {
            if ( elem.length == 0 ) {
                return;
            }
            var $window = $(window)
            var viewport_top = $window.scrollTop()
            var viewport_height = $window.height()
            var viewport_bottom = ( viewport_top + viewport_height ) * 1.1
            var $elem = $(elem)
            var top = $elem.offset().top
            var height = $elem.height()
            var bottom = top + height
        
            return (top >= viewport_top && top < viewport_bottom) ||
            (bottom > viewport_top && bottom <= viewport_bottom) ||
            (height > viewport_height && top <= viewport_top && bottom >= viewport_bottom)
        }

        // Tabs

        $('.tab-nav__item').on('click', function() {
            $(this).addClass('active').siblings().removeClass('active');
            let index = $(this).index();
            $(this).closest('section').find('.tab-nav__content').removeClass('active');
            $(this).closest('section').find('.tab-nav__content').eq(index).addClass('active');
        });

        // checkbox

        $('.checkbox').on('click', function() {
            if ( $(this).find('input').is(':checked') ) {
                $(this).find('input').attr('checked', false);
            } else {
                $(this).find('input').attr('checked', true);
            }
        });

    });
})( jQuery );