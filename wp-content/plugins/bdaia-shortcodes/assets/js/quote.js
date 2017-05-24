(function(){
    jQuery(function()
    {
        var form = jQuery('<div id="blockquotes-form" class="bdaia-shorty-form">\
            <div class="bdaia-sf-inner">\
                <div class="bdaia-sf-row">\
                <table>\
                <tr>\
                <th><label for="blockquotes-quotes_style">Style</label></th>\
                <td>\
                <select name="quotes_style" id="blockquotes-quotes_style">\
					<option value="">- Choose -</option>\
					<option value="bquotes">Blockquotes</option>\
					<option value="bpull">Pullquotes</option>\
				</select>\
                </td>\
                </tr>\
                \
                <tr>\
                <th><label for="blockquotes-quotes_pos">Position</label></th>\
                <td>\
                <select name="quotes_pos" id="blockquotes-quotes_pos">\
					<option value="">- Choose -</option>\
					<option value="left">Left</option>\
					<option value="center">Center</option>\
					<option value="right">Right</option>\
				</select>\
                </td>\
                </tr>\
                \
                </table>\
                </div>\
            </div>\
            \
            <div class="bdaia-sf-submit">\
                <input type="button" id="blockquotes-submit" class="button-primary" value="save" name="submit" />\
            </div>\
            </div>'
        );

        var bdaia_shorty_form = form.find('.bdaia-sf-inner');
        bdaia_shorty_form.find('.bdaia-input-color').wpColorPicker();
        form.appendTo('body').hide();
        form.find('#blockquotes-submit').click(function()
        {
            var options =
            {
                'quotes_style'  : '',
                'quotes_pos'    : ''
            };

            selected = tinyMCE.activeEditor.selection.getContent();
            var shortcode = '[quotes';

            for( var index in options )
            {
                var value = bdaia_shorty_form.find('#blockquotes-' + index).val();

                if ( value !== options[index] ) {
                    shortcode += ' ' + index + '="' + value + '"';
                }
            }
            shortcode += ']' +selected+'[/quotes]';

            tinyMCE.activeEditor.execCommand('mceInsertContent', 0, shortcode);
            tb_remove();
        });
    });
})();