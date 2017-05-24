(function(){
    jQuery(function()
    {
        var form = jQuery('<div id="tooltip-form" class="bdaia-shorty-form">\
            <div class="bdaia-sf-inner">\
                <div class="bdaia-sf-row">\
                <table>\
                <tr>\
                <th><label for="tooltip-gravity">Direction</label></th>\
                <td>\
                <select name="gravity" id="tooltip-gravity">\
					<option value="nw">Northwest</option>\
					<option value="n">North</option>\
					<option value="ne">Northeast</option>\
					<option value="w">West</option>\
					<option value="e">East</option>\
					<option value="sw">Southwest</option>\
					<option value="s">South</option>\
					<option value="se">Southeast</option>\
				</select>\
                </td>\
                </tr>\
                \
                <tr>\
                <th><label for="tooltip-text">Text title</label></th>\
                <td><input type="text" id="tooltip-text" class="bdaia-input-text" name="text" /></td>\
                </tr>\
                \
                <tr>\
                <th><label for="tooltip-txtcolor">Text color</label></th>\
                <td><input type="text" id="tooltip-txtcolor" class="bdaia-input-color" name="txtcolor" /></td>\
                </tr>\
                \
                </table>\
                </div>\
            </div>\
            \
            <div class="bdaia-sf-submit">\
                <input type="button" id="tooltip-submit" class="button-primary" value="save" name="submit" />\
            </div>\
            </div>'
        );

        var bdaia_shorty_form = form.find('.bdaia-sf-inner');
        bdaia_shorty_form.find('.bdaia-input-color').wpColorPicker();
        form.appendTo('body').hide();
        form.find('#tooltip-submit').click(function()
        {
            var options =
            {
                'gravity'   : '',
                'txtcolor'  : '',
                'text'      : ''
            };

            selected = tinyMCE.activeEditor.selection.getContent();
            var shortcode = '[tooltip';

            for( var index in options )
            {
                var value = bdaia_shorty_form.find('#tooltip-' + index).val();

                if ( value !== options[index] ) {
                    shortcode += ' ' + index + '="' + value + '"';
                }
            }
            shortcode += ']' +selected+'[/tooltip]';

            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
            tb_remove();
        });
    });
})();