(function(){
    jQuery(function()
    {
        var form = jQuery('<div id="dropcap-form" class="bdaia-shorty-form">\
            <div class="bdaia-sf-inner">\
                <div class="bdaia-sf-row">\
                <table>\
                <tr>\
                <th><label for="dropcap-style">Style</label><small class="bdaia-sf-info">Dropcap Style</small></th>\
                <td>\
                <select name="style" id="dropcap-style">\
					<option value="">- Style -</option>\
					<option value="dropcap1">Dropcap 1</option>\
					<option value="dropcap2">Dropcap 2</option>\
					<option value="dropcap3">Dropcap 3</option>\
				</select>\
                </td>\
                </tr>\
                \
                <tr>\
                <th><label for="dropcap-bgcolor">Background</label><small class="bdaia-sf-info">Dropcap background color</small></th>\
                <td><input type="text" id="dropcap-bgcolor" class="bdaia-input-color" name="bgcolor" /></td>\
                </tr>\
                \
                <tr>\
                <th><label for="dropcap-txtcolor">Text</label><small class="bdaia-sf-info">Dropcap Text color</small></th>\
                <td><input type="text" id="dropcap-txtcolor" class="bdaia-input-color" name="txtcolor" /></td>\
                </tr>\
                \
                </table>\
                </div>\
            </div>\
            \
            <div class="bdaia-sf-submit">\
                <input type="button" id="dropcap-submit" class="button-primary" value="save" name="submit" />\
            </div>\
            </div>'
        );

        var bdaia_shorty_form = form.find('.bdaia-sf-inner');
        bdaia_shorty_form.find('.bdaia-input-color').wpColorPicker();
        form.appendTo('body').hide();
        form.find('#dropcap-submit').click(function()
        {
            var options =
            {
                'bgcolor'   : '',
                'txtcolor'  : '',
                'style'     : ''
            };

            selected = tinyMCE.activeEditor.selection.getContent();
            var shortcode = '[dropcap';

            for( var index in options )
            {
                var value = bdaia_shorty_form.find('#dropcap-' + index).val();

                if ( value !== options[index] ) {
                    shortcode += ' ' + index + '="' + value + '"';
                }
            }
            shortcode += ']' +selected+'[/dropcap]';

            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
            tb_remove();
        });
    });
})();