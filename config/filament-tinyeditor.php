<?php

return [
    'version' => [
        'tiny' => '8.0.2',
        'language' => [
            // https://cdn.jsdelivr.net/npm/tinymce-i18n@latest/
            'version' => '25.8.4',
            'package' => 'langs8',
        ],
        'licence_key' => env('TINY_LICENSE_KEY', 'no-api-key'),
    ],
    'provider' => 'cloud', // cloud|vendor
    // 'direction' => 'rtl',

    /**
     * change darkMode: 'auto'|'force'|'class'|'media'|false|'custom'
     */
    'darkMode' => 'auto',

    /** cutsom */
    'skins' => [
        // oxide, oxide-dark, tinymce-5, tinymce-5-dark
        'ui' => 'oxide',

        // dark, default, document, tinymce-5, tinymce-5-dark, writer
        'content' => 'default'
    ],

    'profiles' => [
        'default' => [
            'plugins' => 'advlist autolink lists link image charmap preview anchor searchreplace visualblocks code fullscreen insertdatetime media table help wordcount code',
            'menubar' => false, // отключаем верхнее текстовое меню

            'toolbar' => 'removeformat | bold  |styles  blocks | align | forecolor backcolor | codeformat bullist numlist | table image | undo redo code',

            'custom_configs' => [
                'style_formats_merge' => false,
                'content_style' => '
                    .direction2-card__description { font-size: 1.25rem; font-weight: bold;}
                    .direction2-card__description-small { font-size: 0.875rem; color: #4b5563; }
                ',

                'keep_styles' => false,
                'forced_root_block' => 'p',


                'block_unclonable_attributes' => ['class', 'data-line-reveal'],


                'valid_elements' => 'p[class|data-line-reveal],b,strong,i,em,h1,h2,h3,h4,ul,ol,li,a[href|target]',
                    
 
 
    

                'style_formats' => [
                    [
                        'title' => 'Описание Большое',
                        'selector' => 'p',
                        'classes' => 'direction2-card__description',
                        'attributes' => [
                            'data-line-reveal' => 'true'
                        ],
                        'toggle' => true,
                    ],
                    [
                        'title' => 'Описание маленькое',
                        'selector' => 'p',
                        'classes' => 'direction2-card__description-small',
                        'attributes' => [
                            'data-line-reveal' => 'true'
                        ],
                        'toggle' => true,
                    ],
                    [
                        'title' => 'Inline',  
                        'items' => [
                            ['title' => 'Bold', 'icon' => 'bold', 'format' => 'bold'],
                            ['title' => 'Italic', 'icon' => 'italic', 'format' => 'italic'],
                            ['title' => 'Underline', 'icon' => 'underline', 'format' => 'underline'],
                            ['title' => 'Strikethrough', 'icon' => 'strikethrough', 'format' => 'strikethrough'],
                            ['title' => 'Superscript', 'icon' => 'superscript', 'format' => 'superscript'],
                            ['title' => 'Subscript', 'icon' => 'subscript', 'format' => 'subscript'],
                            ['title' => 'Code', 'icon' => 'code', 'format' => 'code']
                        ]
                    ],
 
                    [
                        'title' => 'Align', // Выравнивание внутри папки
                        'items' => [
                            ['title' => 'Left', 'icon' => 'align-left', 'format' => 'alignleft'],
                            ['title' => 'Center', 'icon' => 'align-center', 'format' => 'aligncenter'],
                            ['title' => 'Right', 'icon' => 'align-right', 'format' => 'alignright'],
                            ['title' => 'Justify', 'icon' => 'align-justify', 'format' => 'alignjustify']
                        ]
                    ]
                ],
            ],

        ],
        'simple' => [
            'plugins' => 'autoresize directionality emoticons link wordcount',
            'toolbar' => 'removeformat | bold italic | rtl ltr | numlist bullist | link emoticons',
            'upload_directory' => null,
        ],

        'minimal' => [
            'plugins' => 'link wordcount',
            'toolbar' => 'bold italic link numlist bullist',
            'upload_directory' => null,
        ],

        'full' => [
            'plugins' => 'accordion autoresize codesample directionality advlist autolink link image lists charmap preview anchor pagebreak searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media table emoticons help',
            'toolbar' => 'undo redo removeformat | fontfamily fontsize fontsizeinput font_size_formats styles | bold italic underline | rtl ltr | alignjustify alignright aligncenter alignleft | numlist bullist outdent indent accordion | forecolor backcolor | blockquote table toc hr | image link anchor media codesample emoticons | visualblocks print preview wordcount fullscreen help',
            'upload_directory' => null,
        ],
    ],

    /**
     * this option will load optional language file based on you app locale
     * example:
     * languages => [
     *      'fa' => 'https://cdn.jsdelivr.net/npm/tinymce-i18n@25.8.4/langs7/fa.min.js',
     *      'es' => 'https://cdn.jsdelivr.net/npm/tinymce-i18n@25.8.4/langs7/es.min.js',
     *      'ja' => asset('assets/ja.min.js')
     * ]
     */
    'languages' => [],

    'extra' => [
        'toolbar' => [
            // 'fontsize' => '10px 12px 13px 14px 16px 18px 20px',
            // 'fontfamily' => 'Tahoma=tahoma,arial,helvetica,sans-serif;',
            // 'content_style' => 'body { font-family: "Tahoma", sans-serif; }',
        ]
    ]
];
