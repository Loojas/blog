(function(){
    jQuery(function($)
    {
        var form = jQuery('<div id="lists-form" class="bdaia-shorty-form">\
            <div class="bdaia-sf-inner">\
                <div class="bdaia-sf-row">\
                <table>\
                <tr>\
                <th><label for="lists-content">List items</label></th>\
                <td>\
                <textarea id="list-content" name="content" rows="5" cols="50">A checklist item where your copy can go</textarea>\
                </td>\
                </tr>\
                \
                <tr>\
                <th><label for="lists-sio_type">List type</label></th>\
                <td>\
                <select name="sio_type" id="lists-sio_type">\
					<option value="">- Choose -</option>\
					<option value="star">Star</option>\
					<option value="check">Check</option>\
					<option value="like">Like</option>\
					<option value="dislike">Dislike</option>\
					<option value="asterisk">Asterisk</option>\
					<option value="plus">Plus</option>\
					<option value="minus">Minus</option>\
					<option value="angle">Angle</option>\
					<option value="heart">Heart</option>\
					<option value="denied">Denied</option>\
					<option value="idea">Idea</option>\
					<option value="cross">Cross</option>\
					<option value="files">List 1</option>\
					<option value="notification">List 2</option>\
					<option value="paint">List 3</option>\
					<option value="edit">List 4</option>\
				</select>\
                </td>\
                </tr>\
                \
                <tr>\
                <th><label for="lists-sio_style">Icon Style</label></th>\
                <td>\
                <select name="sio_style" id="lists-sio_style">\
					<option value="">- None -</option>\
					<option value="circles">Circles</option>\
					<option value="square">Square</option>\
				</select>\
                </td>\
                </tr>\
                \
                <tr>\
                <th><label for="lists-sio_bgcolor">Icon Background Color</label><small>circle and square available</small></th>\
                <td><input type="text" id="lists-sio_bgcolor" class="bdaia-input-color" name="sio_bgcolor" /></td>\
                </tr>\
                \
                <tr>\
                <th><label for="lists-sio_txtcolor">Icon Text Color</label></th>\
                <td><input type="text" id="lists-sio_txtcolor" class="bdaia-input-color" name="sio_txtcolor" /></td>\
                </tr>\
                \
                <tr>\
                <th><label for="lists-sio_cio">Custom icon</label><small class="bdaia-sf-info">Use full Font Awesome name <br/> ex: (fa fa-futbol-o)</small></th>\
                <td><input type="text" id="lists-sio_cio" name="sio_cio" /></td>\
                </tr>\
                \
                </table>\
                </div>\
            </div>\
            \
            <div class="bdaia-sf-submit">\
                <input type="button" id="lists-submit" class="button-primary" value="save" name="submit" />\
            </div>\
            </div>'
        );

        var bdaia_shorty_form = form.find('.bdaia-sf-inner');
        bdaia_shorty_form.find('.bdaia-input-color').wpColorPicker();

        form.appendTo('body').hide();
        form.find('#lists-submit').click(function()
        {
            var list = jQuery('#list-content').val();
            var lines = list.split(/\n/);
            var texts = [];
            for (var i=0; i < lines.length; i++) {
                // only push this line if it contains a non whitespace character.
                if (/\S/.test(lines[i])) {
                    texts.push($.trim(lines[i]));
                }
            }

            var options =
            {
                'sio_bgcolor'   : '',
                'sio_type'      : '',
                'sio_txtcolor'  : '',
                'sio_cio'       : '',
                'sio_style'     : ''
            };

            selected = tinyMCE.activeEditor.selection.getContent();
            var shortcode = '[lists';

            for( var index in options )
            {
                var value = bdaia_shorty_form.find('#lists-' + index).val();

                if ( value !== options[index] ) {
                    shortcode += ' ' + index + '="' + value + '"';
                }
            }
            shortcode += ']' +texts+'[/lists]';

            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
            tb_remove();
        });
    });
})();