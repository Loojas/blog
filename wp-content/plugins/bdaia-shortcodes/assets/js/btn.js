(function(){
    jQuery(function()
    {
        var form = jQuery('<div id="btn-form" class="bdaia-shorty-form">\
            <div class="bdaia-sf-inner">\
                <div class="bdaia-sf-row">\
                <table>\
                <tr>\
                <th><label for="btn-btntxt">Text</label></th>\
                <td><input type="text" id="btn-btntxt" name="btntxt" /></td>\
                </tr>\
                \
                <tr>\
                <th><label for="btn-btnlink">Link</label></th>\
                <td><input type="text" id="btn-btnlink" name="btnlink" /></td>\
                </tr>\
                \
                <tr>\
                <th><label for="btn-btnsize">Size</label></th>\
                <td>\
                <select name="btnsize" id="btn-btnsize">\
					<option value="small">- Small -</option>\
					<option value="medium">Medium</option>\
					<option value="large">Large</option>\
					<option value="full">Full width</option>\
				</select>\
                </td>\
                </tr>\
                \
                <tr>\
                <th><label for="btn-bgcolor">Background</label></th>\
                <td><input type="text" id="btn-bgcolor" class="bdaia-input-color" name="bgcolor" /></td>\
                </tr>\
                \
                <tr>\
                <th><label for="btn-txtcolor">Text Color</label></th>\
                <td><input type="text" id="btn-txtcolor" class="bdaia-input-color" name="txtcolor" /></td>\
                </tr>\
                \
                <tr>\
                <th><label for="btn-btnnewt">Open link in a new window/tab</label></th>\
                <td><input type="checkbox" checked="checked" value="1" id="btn-btnnewt" name="btnnewt" /></td>\
                </tr>\
                \
                <tr>\
                <th><label for="btn-nofollow">Nofollow</label></th>\
                <td><input type="checkbox" checked="checked" value="1" id="btn-nofollow" name="nofollow" /></td>\
                </tr>\
                \
                <tr>\
                <th><label for="btn-btnicon">Custom icon</label><small class="bdaia-sf-info">Use full Font Awesome name <br/> ex: (fa fa-futbol-o)</small></th>\
                <td><input type="text" id="btn-btnicon" name="btnicon" /></td>\
                </tr>\
                \
                </table>\
                </div>\
            </div>\
            \
            <div class="bdaia-sf-submit">\
                <input type="button" id="btn-submit" class="button-primary" value="save" name="submit" />\
            </div>\
            </div>'
        );

        var bdaia_shorty_form = form.find('.bdaia-sf-inner');
        bdaia_shorty_form.find('.bdaia-input-color').wpColorPicker();
        form.appendTo('body').hide();
        form.find('#btn-submit').click(function()
        {
            var btntxt = jQuery('#btn-btntxt').val();

            var options =
            {
                'btnlink'   : '',
                'btnsize'   : '',
                'bgcolor'   : '',
                'txtcolor'  : '',
                'btnnewt'   : '',
                'nofollow'  : '',
                'btnicon'   : ''
            };

            selected = tinyMCE.activeEditor.selection.getContent();
            var shortcode = '[btn';

            for( var index in options )
            {
                var value = bdaia_shorty_form.find('#btn-' + index).val();

                if ( value !== options[index] ) {
                    shortcode += ' ' + index + '="' + value + '"';
                }
            }
            shortcode += ']' +btntxt+'[/btn]';

            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
            tb_remove();
        });
    });
})();