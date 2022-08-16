<?php
Route::group(['prefix' => Config::get('app.admin_prefix'), 'namespace' => 'Pgs\Translator', 'middleware' => ['web','auth','IsAdmin']], function() {
    Route::group(['prefix' => 'translator'], function() {		
		Route::match(array('GET'), '/', 'TranslatorController@index')->name('translate_index');
		Route::match(array('POST','GET'), '/create', 'TranslatorController@create')->name('create_translation');
		Route::match(array('GET'), '/update', 'TranslatorController@update')->name('update_translation');
		Route::match(array('GET'), '/delete/{id}', 'TranslatorController@delete')->name('delete_translation');
		
	});
});