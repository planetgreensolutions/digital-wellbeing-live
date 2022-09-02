<?php
/***
buttons
========
By default every slug will have all buttons set to true except for delete button.
If u only need to change edit button then you can only provide that e.g: 'about_us'=>['edit'=>false]

hasGallery
==========
Not used, but may be in future

singlePost
==========
for single posts

listing
=========
list page settings 2 parameters pagination( pagination count ) && fields ( Fields to display, by default page title and manage buttons will be displayed )

filter
=========

sorting
========

 ***/
return [

	'about-council' => [
		'buttons' => ['add' => false, 'edit' => true, 'delete' => false, 'status' => true],
		'singlePost' => true,

	],
	'banners' => [
		'buttons' => ['add' => true, 'edit' => true, 'delete' => true, 'status' => true],
		'listing' => [
			'pagination' => 2,
			'fields' => ['post_title', 'post_title_arabic'],
		],
	],

	'gallery' => [
		'buttons' => ['add' => false, 'edit' => true, 'delete' => false, 'status' => true],
		'hasGallery' => true,
		'singlePost' => true,
	],

	'our-events' => [
		'buttons' => ['add' => true, 'edit' => true, 'delete' => true, 'status' => true],
		'hasGallery' => true,
	],

	'news-opinion' => [
		'buttons' => ['add' => true, 'edit' => true, 'delete' => true, 'status' => true],
		'listing' => [
			'pagination' => 2,
			'fields' => ['post_title', 'post_title_arabic'],
		],
	],

	'guides_and_tips' => [
		'buttons' => ['add' => true, 'edit' => true, 'delete' => true, 'status' => true],
		'listing' => [
			'pagination' => 2,
			'fields' => ['post_title', 'post_title_arabic'],
		],
	],

	'contact' => [
		'buttons' => ['add' => false, 'edit' => true, 'delete' => false, 'status' => true],
		'hasGallery' => true,
		'singlePost' => true,
	],

	'about_digital_wellbeing' => [
		'singlePost' => true,
	],

	'elderly-people-banner' => [
		'singlePost' => true,
	],

	'about_us' => [
		'singlePost' => true,
	],

	'about_us_questions' => [
		'buttons' => ['add' => true, 'edit' => true, 'delete' => true, 'status' => true],
		'listing' => [
			'pagination' => 2,
			'fields' => ['post_title', 'post_title_arabic'],
		],
	],

	'charter-pledge-banner' => [
		'singlePost' => true,
	],

	'charter-pledge-popup' => [
		'singlePost' => true,
	],

	'pledge-list' => [
		'buttons' => ['add' => true, 'edit' => true, 'delete' => true, 'status' => true],
		'singlePost' => false,
	],

	'digital_citizenship' => [
		'singlePost' => true,
	],

	'sannif-online' => [
		'singlePost' => true,
	],

	'youtube_gallery' => [
		'buttons' => ['add' => false, 'edit' => true, 'delete' => true, 'status' => true],
		'singlePost' => false,
	],

	'parent_guide_intro' => [
		'singlePost' => true,
	],

	'parent_guides' => [
		'buttons' => ['add' => true, 'edit' => true, 'delete' => true, 'status' => true],
		'listing' => [
			'pagination' => 2,
			'fields' => ['post_title', 'post_title_arabic'],
		],
	],

	'stories' => [
		'buttons' => ['add' => true, 'edit' => true, 'delete' => true, 'status' => true],
		'listing' => [
			'pagination' => 2,
			'fields' => ['post_title', 'post_title_arabic'],
		],
	],

	'educator_guide_intro' => [
		'singlePost' => true,
	],

	'educator_guides' => [
		'buttons' => ['add' => true, 'edit' => true, 'delete' => true, 'status' => true],
		'listing' => [
			'pagination' => 2,
			'fields' => ['post_title', 'post_title_arabic'],
		],
	],

	'digital_laws_in_uae' => [
		'singlePost' => true,
	],

	'brought_to_you_by' => [
		'singlePost' => true,
	],

	'proudly_supported_by' => [
		'singlePost' => true,
	],

	'terms_of_use' => [
		'singlePost' => true,
	],

	'digital_domains' => [
		'buttons' => ['add' => true, 'edit' => true, 'delete' => true, 'status' => true],
		'listing' => [
			'pagination' => 2,
			'fields' => ['post_title', 'post_title_arabic'],
		],
		'hasGallery' => true,
		'hideGalleryLang' => false,
		'hideGalleryText' => true,
		'hideGallerySource' => true,
	],

	'digital_laws_in_uae' => [
		'singlePost' => true,
	],

	'supported_by' => [
		'singlePost' => true,
	],

	'resources' => [
		'buttons' => ['add' => true, 'edit' => true, 'delete' => true, 'status' => true],
		'sorting' => [
			'field' => [
				'post_title' => 'DESC',
				'post_priority' => 'DESC',
			],
		],
		'listing' => [
			'pagination' => 2,
			'fields' => ['post_title', 'category.post_title', 'subCategory.post_title'],
		],
		'filters' => [
			'Title' => [
				'field' => [
					'post_title',
					'post_title_arabic',
				],
				'name' => 'domain_title',
				'type' => 'text',
				'operation' => 'LIKE',
			],
			'Category' => [
				'field' => [
					'post_category_id',
				],
				'name' => 'cat_id',
				'operation' => '=',
				'source' => [
					'model' => 'App\Models\CategoryModel',
					'id' => 'category_id',
					'name' => 'category_title',
					'parent' => null,
				],
				'type' => 'select',
				'operation' => '=',
			],
			'Sub_Category' => [
				'field' => [
					'post_sub_category_id',
				],
				'name' => 'sub_cat_id',
				'operation' => '=',
				'source' => [
					'model' => 'App\Models\CategoryModel',
					'id' => 'category_id',
					'name' => 'category_title',
					'parent' => null,
				],
				'type' => 'select',
				'operation' => '=',
			],

		],
	],

	'determination' => [
		'singlePost' => true,
	],

	'determination_article' => [
		'buttons' => ['add' => true, 'edit' => true, 'delete' => true, 'status' => true],
		'singlePost' => false,
	],

	'determination_blog' => [
		'buttons' => ['add' => true, 'edit' => true, 'delete' => true, 'status' => true],
		'singlePost' => false,
	],	


	'young_people' => [
		'singlePost' => true,
	],

	'young_people_article' => [
		'buttons' => ['add' => true, 'edit' => true, 'delete' => true, 'status' => true],
		'singlePost' => false,
		'hasGallery' => true,
		'hideGalleryLang' => false,
		'hideGalleryText' => true,
		'hideGallerySource' => true,
	],

	'young_people_blog' => [
		'buttons' => ['add' => true, 'edit' => true, 'delete' => true, 'status' => true],
		'singlePost' => false,
	],	
	'young-people-guides' => [
		'buttons' => ['add' => true, 'edit' => true, 'delete' => true, 'status' => true],
		'singlePost' => false,
	],	

	'kid_esafety' => [
		'singlePost' => true,
	],
	'i_want_help_with_article' => [
		'buttons' => ['add' => true, 'edit' => true, 'delete' => true, 'status' => true],
		'listing' => [
			'pagination' => 2,
			'fields' => ['post_title', 'post_title_arabic'],
		],
		'hasGallery' => true,
		'hideGalleryLang' => false,
		'hideGalleryText' => true,
		'hideGallerySource' => true,
	],

];
