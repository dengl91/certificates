// main script

(function($) {
    $(document).ready(function() {

        $('[data-bg]').each(function() {
            let bg_img = $(this).data('bg');
            $(this).css('background-image', 'url(' + bg_img + ')');
        });

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

        $('[data-nav]').on('click', function() {
            let target_class = $(this).attr('class');
            $('.' + target_class).removeClass('active');
            $(this).addClass('active');
        });

        $('[data-navfor]').on('click', function() {
            let index  = $(this).index('[data-navfor]');
            let target = $(this).data('navfor');
            $('.' + target).removeClass('active');
            $('.' + target).eq(index).addClass('active').siblings().removeClass('active');
        });

        if ( $(window).width() < 768 ) {
            $('.cat__tab').on('click', function(e) {
                e.preventDefault();
                $('.cat__tab').removeClass('active');
                $(this).addClass('active');
                let index = $(this).closest('.row').index();
                $('.cat__content').removeClass('active');
                $('.cat__content').eq(index).addClass('active');
            });
        }

        $('.faq__tab').on('click', function(e) {
            e.preventDefault();
            $('.faq__tab').removeClass('active');
            $(this).addClass('active');
            $('.open__content').removeClass('active');
            $(this).closest('.row').find('.open__content').addClass('active');
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
                        slidesToShow: 1,
                        centerMode: true
                    }
                }
            ]
        });

        $('.review__content:not([class*=alt])').slick({
            slidesToShow: 2,
            slidesToScroll: 1,
            arrows: true,
            infinite: false,
            responsive: [
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 1
                    }
                }
            ]
        });

        $('.review__content--alt').slick({
            slidesPerRow: 3,
            rows: 2,
            arrows: true,
            infinite: false,
            adaptiveHeight: true,
            responsive: [
                {
                    breakpoint: 1080,
                    settings: {
                        slidesPerRow: 2
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesPerRow: 1
                    }
                }
            ]
        });
        $('.review__content').on('beforeChange', function(event, slick, currentSlide, nextSlide) {
            $('.review__current').text(nextSlide + 1);
        });

        $('.review__max').text($('.slick-slide').length);

        $(window).resize( function() {
            $('.review__max').text($('.slick-slide').length);
            if ( $(window).width() < 768 ) {
                if ( !$('.blog__content').hasClass('slick-slider') ) {
                    $('.blog__content').slick({
                        slidesToShow: 1,
                        slidesToScroll: 1,
                        arrows: false,
                        infinite: false,
                        centerMode: true
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
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    arrows: false,
                    infinite: false,
                    centerMode: true
                });
            }
        }

        // menu

        $('.menu-btn').on('click', function() {
            $('html, body').animate( {scrollTop: 0}, 0 );
            $('body').toggleClass('unscroll');
        });

        // form validation

        document.querySelectorAll('input[name=phone]').forEach(input => {
            var maskOptions = {
                mask: '+375 (00) 000-00-00',
                lazy: true
            } 
            var mask = new IMask(input, maskOptions);
        });

        $('form input[type=submit]').on('click', function(e) {
            $(this).closest('form').find('[required]').each(function() {
                if ( !$(this).val() || $(this).val().indexOf('_') >= 0 ) {
                    e.preventDefault();
                    $(this).addClass('alert');
                    $(this).next('[class*=hint]').addClass('active');
                }
            });
        });

        $('input[type=text]').keyup( function() {
            $(this).removeClass('alert');
            $(this).next('[class*=hint]').removeClass('active');
        });

        $('input[name=username]').keyup( function() {
            $(this).val( $(this).val().replace(/[^а-яА-Яa-zA-Z ]/g,'') );
        });

        // request form

        $('.request-form').on('submit', function(e) {
            e.preventDefault();
            console.log('Sent');
            $.ajax({
                type: "POST",
                url: '/wp-content/themes/certificates/mail-order-call.php',
                data: $(this).serialize()
            }).done(function(result) {
                alert('Спасибо! Мы свяжемся с вами в ближайшее время');
            }).fail(function() {
                alert('Произошла ошибка');
            });
        });

        // Lazy and counters

        document.addEventListener('scroll', (evt) => {
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
        }, {
            capture: true,
            passive: true
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
            if (e.target !== this) return;
            $(this).removeClass('active');
        });

        $('.modal__close').on('click', function() {
            $(this).closest('.modal').removeClass('active');
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