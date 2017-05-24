(function() {
    tinymce.PluginManager.add('bdaia_mce_button', function( editor, url )
    {
        editor.addButton( 'bdaia_mce_button',
            {
                icon        : ' bdaia-shorty-icon ',
                tooltip     : 'shortcodes',
                type        : 'menubutton',
                minWidth    : 210,
                menu        : [
                    {
                        text: 'highlight',
                        onclick : function() {
                            var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 600 < width ) ? 600 : width;
                            W = W - 4;
                            H = H - 4;
                            tb_show( 'Highlight Shortcodes', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=highlight-form' );
                        }
                    },
                    {
                        text: 'tabs',
                        onclick: function() {
                            editor.windowManager.open( {
                                    title: 'Tabs',
                                    width: 300,
                                    height: 60,
                                    body: [
                                        {
                                            type: 'listbox',
                                            name: 'TabType',
                                            label: 'Type',
                                            'values': [
                                                {text: 'Horizontal', value: 'horizontal'},
                                                {text: 'Vertical', value: 'vertical'}
                                            ]
                                        }
                                    ],

                                    onsubmit: function( e ) {
                                        editor.insertContent( '\
                                        [tabs type="'+ e.data.TabType +'"]<br />\
                                            [tabs_head]<br />\
                                                [tab_title] Tab Data #1 [/tab_title]<br />\
                                                [tab_title] Tab Data #1 [/tab_title]<br />\
                                                [tab_title] Tab Data #1 [/tab_title]<br />\
                                            [/tabs_head]<br />\
                                            [tab]<br />\
                                            Tab 1 Your Content\
                                            [/tab]<br />\
                                            [tab]<br />\
                                            Tab 1 Your Content\
                                            [/tab]<br />\
                                            [tab]<br />\
                                            Tab 1 Your Content\
                                            [/tab]<br />\
                                        [/tabs]');
                                    }
                                },
                                {
                                    plugin_url : url
                                });
                        }
                    },
                    {
                        text: 'toggle',
                        onclick: function() {
                            editor.windowManager.open( {
                                title: 'Toggle',
                                body: [
                                    {
                                        type: 'textbox',
                                        name: 'ToggleTitle',
                                        label: 'Toggle Title',
                                        value: ''
                                    },
                                    {
                                        type: 'listbox',
                                        name: 'ToggleState',
                                        label: 'Type',
                                        'values': [
                                            {text: 'Opened', value: 'open'},
                                            {text: 'Close', value: 'close'}
                                        ]
                                    },
                                    {
                                        type: 'textbox',
                                        name: 'ToggleContent',
                                        label: 'Content',
                                        value: '',
                                        multiline: true,
                                        minWidth: 300,
                                        minHeight: 100
                                    }
                                ],
                                onsubmit: function( e ) {
                                    editor.insertContent( '[toggle title="' + e.data.ToggleTitle + '" type="' + e.data.ToggleState + '"]'+ e.data.ToggleContent +'[/toggle]');
                                }
                            });
                        }
                    },
                    {
                        text: 'flipboxes',
                        onclick : function() {
                            var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 600 < width ) ? 600 : width;
                            W = W - 4;
                            H = H - 4;
                            tb_show( 'Flip Boxes Shortcodes', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=flip-form' );
                        }
                    },
                    {
                        text: 'buttons',
                        onclick : function() {
                            var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 600 < width ) ? 600 : width;
                            W = W - 4;
                            H = H - 4;
                            tb_show( 'Buttons Shortcodes', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=btn-form' );
                        }
                    },
                    {
                        text: 'dropcap',
                        onclick : function() {
                            var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 600 < width ) ? 600 : width;
                            W = W - 4;
                            H = H - 4;
                            tb_show( 'Dropcap Shortcodes', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=dropcap-form' );
                        }
                    },
                    {
                        text: 'tooltip',
                        onclick : function() {
                            var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 600 < width ) ? 600 : width;
                            W = W - 4;
                            H = H - 4;
                            tb_show( 'Tooltip Shortcodes', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=tooltip-form' );
                        }
                    },
                    {
                        text: 'listss',
                        onclick : function() {
                            var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 600 < width ) ? 600 : width;
                            W = W - 80;
                            H = H - 80;
                            tb_show( 'Lists Shortcodes', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=lists-form' );
                        }
                    },
                    {
                        text: 'quotes',
                        onclick : function() {
                            var width = jQuery(window).width(), H = jQuery(window).height(), W = ( 600 < width ) ? 600 : width;
                            W = W - 80;
                            H = H - 80;
                            tb_show( 'Blockquotes Shortcodes', '#TB_inline?width=' + W + '&height=' + H + '&inlineId=blockquotes-form' );
                        }
                    },
                    {
                        text: 'clear',
                        onclick : function() {
                            editor.insertContent('[clear]');
                        }
                    },
                    {
                        text: 'padding',
                        onclick: function() {
                            editor.windowManager.open( {
                                title: 'Padding',
                                body: [
                                    {
                                        type: 'textbox',
                                        name: 'left',
                                        label: 'Padding left',
                                        value: '10%'
                                    },
                                    {
                                        type: 'textbox',
                                        name: 'right',
                                        label: 'Padding right',
                                        value: '10%'
                                    }
                                ],
                                onsubmit: function( e ) {
                                    editor.insertContent( '[padding right="'+ e.data.right+ '" left="'+ e.data.left+ '"]' + editor.selection.getContent() + '[/padding]' );
                                }
                            });
                        }
                    },
                    {
                        text: 'divider',
                        onclick: function() {
                            editor.windowManager.open( {
                                title: 'Divider',
                                body: [
                                    {
                                        type: 'listbox',
                                        name: 'style',
                                        label: 'Divider style',
                                        'values': [
                                            {text: 'Divider Shadow', value: 'shadow'},
                                            {text: 'Divider Double', value: 'double'},
                                            {text: 'Divider Single', value: 'single'},
                                            {text: 'Divider Dashed', value: 'dashed'},
                                            {text: 'Divider Dotted', value: 'dotted'}
                                        ]
                                    },
                                    {
                                        type: 'textbox',
                                        name: 'margin_top',
                                        label: 'Divider margin top',
                                        value: '30'
                                    },
                                    {
                                        type: 'textbox',
                                        name: 'margin_bottom',
                                        label: 'Divider marign bottom',
                                        value: '30'
                                    }
                                ],
                                onsubmit: function( e ) {
                                    editor.insertContent( '[divider style="'+ e.data.style+ '" top="'+ e.data.margin_top+ '" bottom="'+ e.data.margin_bottom+ '"]' );
                                }
                            });
                        }
                    },
                    {
                        text: 'columns',
                        menu: [
                            {
                                text: '[1/1]',
                                onclick: function() {
                                    editor.insertContent( '[one_half]Add content here[/one_half][one_half_last]Add content here[/one_half_last]' );
                                }
                            },
                            {
                                text: '[1/1/1]',
                                onclick: function() {
                                    editor.insertContent( '[one_third]Add content here[/one_third][one_third]Add content here[/one_third][one_third_last]Add content here[/one_third_last]' );
                                }
                            },
                            {
                                text: '[1/1/1/1]',
                                onclick: function() {
                                    editor.insertContent( '[one_fourth]Add content here[/one_fourth][one_fourth]Add content here[/one_fourth][one_fourth]Add content here[/one_fourth][one_fourth_last]Add content here[/one_fourth_last]' );
                                }
                            },
                            {
                                text: '[1/1/1/1/1]',
                                onclick: function() {
                                    editor.insertContent( '[one_fifth]Add content here[/one_fifth][one_fifth]Add content here[/one_fifth][one_fifth]Add content here[/one_fifth][one_fifth]Add content here[/one_fifth][one_fifth_last]Add content here[/one_fifth_last]' );
                                }
                            },
                            {
                                text: '[1/1/1/1/1/1]',
                                onclick: function() {
                                    editor.insertContent( '[one_sixth]Add content here[/one_sixth][one_sixth]Add content here[/one_sixth][one_sixth]Add content here[/one_sixth][one_sixth]Add content here[/one_sixth][one_sixth]Add content here[/one_sixth][one_sixth_last]Add content here[/one_sixth_last]' );
                                }
                            },
                            {
                                text: '[1/3]',
                                onclick: function() {
                                    editor.insertContent( '[one_fourth]Add content here[/one_fourth][three_fourth_last]Add content here[/three_fourth_last]' );
                                }
                            },
                            {
                                text: '[1/5]',
                                onclick: function() {
                                    editor.insertContent( '[one_sixth]Add content here[/one_sixth][five_sixth_last]Add content here[/five_sixth_last]' );
                                }
                            },
                            {
                                text: '[2/1]',
                                onclick: function() {
                                    editor.insertContent( '[two_third]Add content here[/two_third][one_third_last]Add content here[/one_third_last]' );
                                }
                            },

                            {
                                text: '[2/3]',
                                onclick: function() {
                                    editor.insertContent( '[two_fifth]Add content here[/two_fifth][three_fifth_last]Add content here[/three_fifth_last]' );
                                }
                            }

                        ]
                    }
                ]
            });
    });
})();