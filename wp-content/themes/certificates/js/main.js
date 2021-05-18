// custom script

(function($) {
    $(document).ready(function() {

        $('.menu-btn').on('click', function() {
            $(this).toggleClass('active');
            $('header').toggleClass('active');
        });

        $('.popup-form-content').mousedown( function(e) {
            if (e.target !== this)
                return;
            
            $(this).removeClass('active');
        });

        let keywords = {
            ac: "active",
            fi: "fadeIn",
            bi: "bounceIn",
            fir: "fadeInRight",
            fiu: "fadeInUp",
            fil: "fadeInLeft",
            fid: "fadeInDown",
            ri: "rotateIn",
            riur: "rotateInUpRight",
            sid: "slideInDown",
            sil: "slideInLeft",
            sir: "slideInRight",
            siu: "slideInUp",
            zi: "zoomIn",
            jitb: "jackInTheBox",
        };

        $(window).scroll( function() {
            $('.animated').each( function () {
                let target = $(this);
                for (const key in keywords) {
                    if ( isOnScreen(target) && target.hasClass(key) ) {
                        target.addClass(keywords[key]);
                    }
                }
            });
        });
    
        function isOnScreen(elem) {
            if ( elem.length == 0 )
                return;

            let $window = $(window)
                viewport_top = $window.scrollTop()
                viewport_height = $window.height()
                viewport_bottom = viewport_top + viewport_height
                $elem = $(elem)
                top = $elem.offset().top
                height = $elem.height()
                bottom = top + height
        
            return (top >= viewport_top && top < viewport_bottom) ||
            (bottom > viewport_top && bottom <= viewport_bottom) ||
            (height > viewport_height && top <= viewport_top && bottom >= viewport_bottom)
        }

    });

})( jQuery );