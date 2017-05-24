(function(){
    jQuery(function()
    {
        var form = jQuery('<div id="flip-form" class="bdaia-shorty-form">\
            <div class="bdaia-sf-inner">\
                <div class="bdaia-sf-row">\
                <table>\
                <tr>\
                <th><label for="flip-front_content">Flip Front Content</label></th>\
                <td>\
                <textarea id="flip-front_content" rows="5" cols="50"></textarea>\
                </td>\
                </tr>\
                \
                <tr>\
                <th><label for="flip-front_bg">Flip Front Background</label></th>\
                <td><input type="text" id="flip-front_bg" class="bdaia-input-color" name="front_bg" /></td>\
                </tr>\
                \
                <tr>\
                <th><label for="flip-front_txtc">Flip Front Text Color</label></th>\
                <td><input type="text" id="flip-front_txtc" class="bdaia-input-color" name="front_txtc" /></td>\
                </tr>\
                \
                <tr>\
                <th><label for="flip-back_content">Flip Back Content</label></th>\
                <td>\
                <textarea id="flip-back_content" rows="5" cols="50"></textarea>\
                </td>\
                </tr>\
                \
                <tr>\
                <th><label for="flip-back_bg">Flip Back Background</label></th>\
                <td><input type="text" id="flip-back_bg" class="bdaia-input-color" name="back_bg" /></td>\
                </tr>\
                \
                <tr>\
                <th><label for="flip-back_txtc">Flip Back Text Color</label></th>\
                <td><input type="text" id="flip-back_txtc" class="bdaia-input-color" name="back_txtc" /></td>\
                </tr>\
                \
                </table>\
                </div>\
            </div>\
            \
            <div class="bdaia-sf-submit">\
                <input type="button" id="flip-submit" class="button-primary" value="save" name="submit" />\
            </div>\
            </div>'
        );

        var bdaia_shorty_form = form.find('.bdaia-sf-inner');
        bdaia_shorty_form.find('.bdaia-input-color').wpColorPicker();
        form.appendTo('body').hide();
        form.find('#flip-submit').click(function()
        {
            var options = {
                'front_content'   : '',
                'front_bg'        : '',
                'front_txtc'      : '',
                'back_content'    : '',
                'back_bg'         : '',
                'back_txtc'       : ''
            };

            selected = tinyMCE.activeEditor.selection.getContent();
            var shortcode = '[flip';

            for( var index in options )
            {
                var value = bdaia_shorty_form.find('#flip-' + index).val();

                if ( value !== options[index] ) {
                    shortcode += ' ' + index + '="' + value + '"';
                }
            }
            shortcode += ']';

            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
            tb_remove();
        });
    });
})();