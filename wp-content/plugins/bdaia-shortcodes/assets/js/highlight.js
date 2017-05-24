(function(){
    jQuery(function()
    {
        var form = jQuery('<div id="highlight-form" class="bdaia-shorty-form">\
            <div class="bdaia-sf-inner">\
                <div class="bdaia-sf-row">\
                <table>\
                <tr>\
                <th><label for="highlight-bgcolor">Background</label><small class="bdaia-sf-info">Highlight background color</small></th>\
                <td><input type="text" id="highlight-bgcolor" class="bdaia-input-color" name="bgcolor" /></td>\
                </tr>\
                \
                <tr>\
                <th><label for="highlight-txtcolor">Text</label><small class="bdaia-sf-info">Highlight Text color</small></th>\
                <td><input type="text" id="highlight-txtcolor" class="bdaia-input-color" name="txtcolor" /></td>\
                </tr>\
                \
                </table>\
                </div>\
            </div>\
            \
            <div class="bdaia-sf-submit">\
                <input type="button" id="highlight-submit" class="button-primary" value="save" name="submit" />\
            </div>\
            </div>'
        );

        var bdaia_shorty_form = form.find('.bdaia-sf-inner');
        bdaia_shorty_form.find('.bdaia-input-color').wpColorPicker();
        form.appendTo('body').hide();
        form.find('#highlight-submit').click(function()
        {
            var options =
            {
                'bgcolor'   : '',
                'txtcolor'  : ''
            };

            selected = tinyMCE.activeEditor.selection.getContent();
            var shortcode = '[highlight';

            for( var index in options )
            {
                var value = bdaia_shorty_form.find('#highlight-' + index).val();

                if ( value !== options[index] ) {
                    shortcode += ' ' + index + '="' + value + '"';
                }
            }
            shortcode += ']' +selected+'[/highlight]';

            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
            tb_remove();
        });
    });
})();