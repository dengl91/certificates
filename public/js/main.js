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
            let target = $(this).data('control');
            $('.' + target).toggleClass('active');
        });

        $('[data-navfor]').on('click', function() {
            let index  = $(this).index();
            let target = $(this).data('navfor');
            $('.' + target).eq(index).addClass('active').siblings().removeClass('active');
        });

        // slick

        $('.features__content').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            arrows: false,
            infinite: false,
            responsive: [
                {
                    breakpoint: 980,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1.5
                    }
                }
            ]
        });

        $('.review__content:not([class*=alt])').slick({
            slidesToShow: 2,
            slidesToScroll: 1,
            arrows: true,
            infinite: false
        });

        $('.review__content--alt').slick({
            slidesPerRow: 3,
            rows: 2,
            arrows: true,
            infinite: false
        });

        $('.news__content').slick({
            slidesPerRow: 3,
            rows: 2,
            arrows: true,
            infinite: false,
            dots: true
        });

        $(window).resize( function() {
            if ( $(window).width() < 768 ) {
                if ( !$('.blog__content').hasClass('slick-slider') ) {
                    $('.blog__content').slick({
                        slidesToShow: 1.5,
                        slidesToScroll: 1,
                        arrows: false,
                        infinite: false
                    });
                }
            } else {
                if ( $('.blog__content').hasClass('slick-slider') ) {
                    $('.blog__content').slick('unslick');
                }
            }
        });

        if ( $(window).width() < 768 ) {
            if ( !$('.blog__content').hasClass('slick-slider') ) {
                $('.blog__content').slick({
                    slidesToShow: 1.5,
                    slidesToScroll: 1,
                    arrows: false,
                    infinite: false
                });
            }
        }

        // menu

        $('.menu-btn').on('click', function() {
            $('html, body').animate( {scrollTop: 0}, 0 );
            $('body').toggleClass('unscroll');
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

        // modal

        $('.modal').mousedown( function(e) {
            console.log(e.target);
            if (e.target !== this) return;
            $(this).removeClass('active');
        });

        // search

        $('.search__input').on('keyup', function() {
            let query = $(this).val();
            if ( query.length > 0 ) {
                $(this).siblings('.search__clear').addClass('active');
                $(this).siblings('.search__submit').prop('disabled', false);
            } else {
                $(this).siblings('.search__clear').removeClass('active');
                $(this).siblings('.search__submit').prop('disabled', true);
            }
        });

        $('.search__clear').on('click', function() {
            clearSearch();
        });

        $(window).scroll( function() {
            if ( $(window).scrollTop() == 0 ) {
                $('.modal--search.active').css('transform', 'translateY(0)');
            }
            if ( $(window).scrollTop() > 0 && $(window).scrollTop() < 300 ) {
                $('.modal--search.active').css('transform', 'translateY(-' + $(window).scrollTop() / 2 + 'px)');
            }
            if ( $(window).scrollTop() >= 300 ) {
                if ( $('.modal--search').hasClass('active') ) {
                    $('.modal--search').addClass('swipeup');
                    setTimeout(() => {
                        $('.modal--search').removeClass('swipeup active');
                    }, 600);
                }
            }
        });

        function clearSearch() {
            $('.search__input').val('');
            $('.search__clear').removeClass('active');
            $('.search__submit').prop('disabled', true);
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