<?php

return [
    'parent'=> 'mm_parent_id',
    'primary_key' => 'mm_id',
    'generate_url'   => true,
    'childNode' => 'child',
    'body' => [
        'mm_id',
        'mm_parent_id',
		'mm_title',
		'mm_title_arabic',
		'mm_icon_class',
		'mm_icon_file',
		'mm_large_title',
		'mm_large_title_arabic', 
		'mm_show_in_main_menu',
		'mm_show_in_footer_menu',
		'mm_show_in_mobile_menu',
		'mm_is_hash_link',
		'mm_is_hash_link_in_home_only',
		'mm_priority',
		'mm_status',
		'mm_created_by',
		'mm_updated_by',
		'mm_status'
    ],
    'html' => [
        'label' => 'mm_title',
        'label_arabic' => 'mm_title_arabic',
        'href'  => 'mm_slug',
        // 'aria-level'  => 0,
    ],
	/* 'ul' => [
		'role' =>'menubar',
		'class' =>'nav navbar-nav mainNav',
	],
	'li' => [
		'class' => '',
		'aria-level' => '',
		'data-lang' => '',
		'data-id' => '',
	],
	'a' => [
		'class' => '',
		'data-href' => 'mm_slug',
	], */
    'dropdown' => [
        'prefix' => '',
        'label' => 'mm_title',
        'value' => 'mm_id'
    ]
];
