<?php

return [
    'parent'=> 'category_parent_id',
    'primary_key' => 'category_id',
    'generate_url'   => true,
    'childNode' => 'child',
    'body' => [
		'category_id',
		'category_title',
		'category_slug',
    ],
    'html' => [
        'label' => 'category_title',
		'label_arabic' => 'category_title_arabic',
		'href'  => 'category_slug'
    ],
    'dropdown' => [
        'prefix' => '-',
		'label' => 'category_title',
		'value' => 'category_id',
		'attr' =>[
			'class'=>'form-control'
		]
    ]
];
