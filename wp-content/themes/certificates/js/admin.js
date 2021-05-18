// admin script

(function($) {

    $(document).ready(function() {

        // custom-link-in-toolbar.js
        // wrapped into IIFE - to leave global space clean.
        ( function( window, wp ) {

            // just to keep it cleaner - we refer to our link by id for speed of lookup on DOM.
            var link_id = 'custom_wp_link';

            // prepare our custom link's html.
            var link_html = '<a id="' + link_id + '" class="custom_wp_link components-button is-tertiary" onclick="history.back()">Вернуться назад</a>';

            // check if gutenberg's editor root element is present.
            var editorEl = document.getElementById( 'editor' );
            if( !editorEl ) { // do nothing if there's no gutenberg root element on page.
                return;
            }

            var unsubscribe = wp.data.subscribe( function () {
                setTimeout( function () {
                    if ( !document.getElementById( link_id ) ) {
                        var toolbalEl = editorEl.querySelector( '.edit-post-header__toolbar' );
                        if( toolbalEl instanceof HTMLElement ){
                            toolbalEl.insertAdjacentHTML( 'beforeend', link_html );
                        }
                    }
                }, 1 )
            } );

        } )( window, wp )

    });
    
    $(document).ajaxComplete(function() {

        $('.acf-block-preview').on('click', 'a', function(e) {
            e.preventDefault();
        });

        $('[data-src]').each(function () {
            let target = $(this);
            let src = $(this).data('src');
            $(this).attr('src', src);
            target.addClass('counted');
        });

        $('[data-editable]').each(function() {
            $(this).attr('contenteditable', true);
        });

        $('[data-editable]').on('blur', function() {    
            let string = $(this).text();
            let target = $(this).data('name');
            $('.acf-block-panel').find('.acf-field[data-name=' + target + '] :input').val(string).trigger('change');
        });
        
    });

})( jQuery );