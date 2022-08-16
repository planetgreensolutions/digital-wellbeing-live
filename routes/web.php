<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::group(['prefix' => Config::get('app.admin_prefix'), 'namespace' => 'Admin'], function () {
    Route::match(array('GET', 'POST'), '/', 'LoginController@index');
    Route::match(array('GET', 'POST'), '/login', 'LoginController@index')->name('login');
    Route::match(array('GET', 'POST'), '/create', array('uses' => 'LoginController@create_admin_account'));
});

Route::group(['prefix' => Config::get('app.admin_prefix'), 'namespace' => 'Admin', 'middleware' => ['auth', 'IsAdmin', 'XSS']], function () {

    Route::group(['middleware' => ['ForcePasswordChange']], function () {

        Route::match(array('GET'), '/audit_logs', 'AuditController@index')->name('admin_audit_logs');

        //Category Manager
        Route::match(array('GET', 'POST'), '/category_manager', 'CategoryController@index');
        Route::match(array('GET', 'POST'), '/category_manager/create', 'CategoryController@create');
        Route::match(array('GET', 'POST'), '/category_manager/update/{id}', 'CategoryController@update');
        Route::get('/category_manager/delete/{id}', 'CategoryController@delete');
        Route::get('/category_manager/changestatus/{id}', 'CategoryController@changestatus');

        /* File Browser & Uploader - CKEditor */
        Route::match(array('GET', 'POST'), 'file_browser_ckeditor', 'FileManagerController@file_browser_ckeditor');
        Route::match(array('GET', 'POST'), 'file_upload_ckeditor', 'FileManagerController@file_upload_ckeditor');
        Route::match(array('GET', 'POST'), 'clean_stale_entries', 'FileManagerController@clean_stale_entries');

        Route::group(['prefix' => 'registration'], function () {
            Route::match(array('GET', 'POST'), '', 'RegistrationController@index')->name('register-list');
            Route::match(array('GET', 'POST'), 'download/user-submission', 'RegistrationController@download_user_submission')->name('download_user_submission');
            Route::match(array('GET', 'POST'), 'download', 'RegistrationController@download_registration')->name('download_registration');
        });

        // Use this route for all form registrations
        Route::match(['GET', 'POST'], 'registrations/{formType}/{formId?}', 'FormSubmissionsController@index')->name('registrations');
        Route::match(['GET', 'POST'], 'export-registrations/{formType}/{formId?}', 'FormSubmissionsController@download')->name('export-registrations');

        /* Exporting */
        Route::group(['prefix' => 'export-data'], function () {
            Route::match(array('GET', 'POST'), '/{modelslug}', 'ExportController@index')->name('export_data');
        });
        /* Exporting */

        Route::get('dashboard', 'UsersController@dashboard')->name('admin_dashboard');

        /***
                    COMMON AJAX FILE UPLOAD CONTROL (only uploads and returns file name image and file are supported) ,
                    GOES AS POST META TEXT FIELD IN DB
                ***/

        Route::match(array('GET', 'POST'), 'admin_fileupload', 'PostCollectionController@fileupload');
        Route::match(array('GET', 'POST'), 'admin_filedelete/{fileName}', 'PostCollectionController@general_filedelete');
        Route::match(array('GET', 'POST'), 'admin_filedownload/{fileName}', 'PostCollectionController@general_filedownload');

        /* Route::match(array('GET','POST'),'/image-gallery', 'GalleryController@image_gallery_index');
                Route::match(array('GET','POST'),'/image-gallery/get_old_files/', 'GalleryController@get_old_files');
                Route::match(array('GET','POST'),'/image-gallery/file-upload/', 'GalleryController@file_upload');
                Route::match(array('GET','POST'),'/image-gallery/videoEdit/{catID}', 'GalleryController@image_gallery');
                Route::match(array('GET','POST'),'/image-gallery/create-category', 'GalleryController@create_category');
                Route::match(array('GET','POST'),'/image-gallery/update-category/{catID}', 'GalleryController@update_category');
                Route::match(array('GET','POST'),'/image-gallery/category-list', 'GalleryController@list_category');

                Route::match(array('GET','POST'),'/image-gallery/download/{imagename}', 'GalleryController@download_image');
                Route::get('/image-gallery/delete/{catid}', 'GalleryController@delete_gallery_image'); */

        /* Post Collections */
        Route::match(array('GET', 'POST'), 'post/{slug}', 'PostCollectionController@index')->name('post_index');
        Route::match(array('GET', 'POST'), 'post/{slug}/add', 'PostCollectionController@create')->name('post_create');
        Route::match(array('GET', 'POST'), 'post/{slug}/edit/{id}', 'PostCollectionController@edit')->name('post_edit');
        Route::match(array('GET', 'POST'), 'post/{slug}/changestatus/{id}/{status}', 'PostCollectionController@changestatus')->name('post_change_status');
        Route::match(array('GET', 'POST'), 'post/{slug}/delete/{id}', 'PostCollectionController@delete')->name('post_delete');
        Route::match(array('GET', 'POST'), 'post/{slug}/remove_meta_attachment/{field}/{about_id}', 'PostCollectionController@removeMetaAttachment');

        Route::match(array('GET', 'POST'), 'post_media/save_youtube_video', 'PostMediaController@save_youtube_video')->name('save_youtube_video');
        Route::match(array('GET', 'POST'), 'post_media/update_priority/', 'PostMediaController@update_priority')->name('post_media_update_priority');
        Route::match(array('GET', 'POST'), 'post_media/update_text/', 'PostMediaController@update_text')->name('post_media_update_text');

        Route::match(array('GET', 'POST'), 'post_media/{slug}', 'PostMediaController@index')->name('post_media_index');
        Route::match(array('GET', 'POST'), 'post_media/{slug}/add', 'PostMediaController@create')->name('post_media_create');
        Route::match(array('GET', 'POST'), 'post_media_download/{id}', 'PostMediaController@post_media_download');
        Route::match(array('GET', 'POST'), 'post_media/delete/{id}', 'PostMediaController@delete')->name('post_media_delete');

        //Menu manager
        Route::match(array('GET', 'POST'), '/menu_manager', 'MenuController@index')->name('menu_manager');
        Route::match(array('GET', 'POST'), '/menu_manager/create', 'MenuController@create')->name('create_menu');
        Route::match(array('GET', 'POST'), '/menu_manager/update/{id}', 'MenuController@update')->name('edit_menu');
        Route::match(array('GET', 'POST'), '/menu_manager/delete/{id}', 'MenuController@delete')->name('delete_menu');
        Route::match(array('GET', 'POST'), '/menu_manager/sort_menu', 'MenuController@sort_menu')->name('sort_menu');
        // Route::get('/menu_manager/delete/{id}', 'MenuController@delete');
        Route::get('/menu_manager/changestatus/{id}', 'MenuController@changestatus')->name('menu_status');

        /*Users*/
        Route::get('/users', 'UsersController@index')->name('users');
        Route::match(array('GET', 'POST'), '/users/create', 'UsersController@create')->name('user_create');
        Route::match(array('GET', 'POST'), '/users/edit/{id}', 'UsersController@edit')->name('user_edit');
        Route::get('/users/delete/{id}', 'UsersController@delete')->name('user_delete');
        Route::get('/users/changestatus/{id}/{status}', 'UsersController@changestatus')->name('user_change_status');

        /*User Permissions*/
        Route::match(array('GET', 'POST'), 'permissions', 'PermissionsController@index');
        Route::match(array('GET', 'POST'), 'permissions/create', 'PermissionsController@create');
        Route::match(array('GET', 'POST'), 'permissions/edit/{id}', 'PermissionsController@edit');
        Route::match(array('GET', 'POST'), 'permissions/delete/{id}', 'PermissionsController@delete');

        /*Roles*/
        Route::match(array('GET', 'POST'), 'roles', 'RolesController@index');
        Route::match(array('GET', 'POST'), 'roles/create', 'RolesController@create');
        Route::match(array('GET', 'POST'), 'roles/edit/{id}', 'RolesController@edit');
        Route::match(array('GET', 'POST'), 'roles/delete/{id}', 'RolesController@delete');

        //Settings
        Route::match(array('GET', 'POST'), '/setting', 'SettingController@index');

        //Country
        Route::match(array('GET', 'POST'), '/country', 'CountryController@index');
        Route::match(array('GET', 'POST'), '/country/create', 'CountryController@create');
        Route::match(array('GET', 'POST'), '/country/edit/{id}', 'CountryController@update');
        Route::get('/country/delete/{id}', 'CountryController@delete');
        Route::get('/country/changestatus/{id}/{status}', 'CountryController@changestatus');

        //contact details
        Route::match(array('GET', 'POST'), 'contact-list', 'RegistrationController@contact_details');
        Route::match(array('GET', 'POST'), 'contact-list/download', 'RegistrationController@contact_details_download')->name('contact-download');

        //report details
        Route::match(array('GET', 'POST'), 'report-list', 'RegistrationController@report_details');
        Route::match(array('GET', 'POST'), 'report-list/download', 'RegistrationController@report_details_download')->name('report-download');

        //import post data
        Route::match(array('GET', 'POST'), '/import-post-records/{slug}', 'PostCollectionController@importPostRecords')->name('import-post-records');
    });

    Route::match(array('POST'), 'upload-file', 'FileController@upload');

    Route::match(array('GET', 'POST'), '/change_password', 'UsersController@changePassword')->name('admin_change_password');
    //Logout
    Route::get('/logout', 'LoginController@logout');
});

Route::get('/test', 'HomeController@test');
Route::get('/language/{lang}', 'HomeController@setlanguage')->name('set_language');
Route::match(array('GET', 'POST'), '/', 'HomeController@index')->name('home');
Route::match(array('GET'), '/page-not-found', 'HomeController@page_not_found');
Route::match(array('GET'), '/service-not-available', 'HomeController@service_not_available');

Route::group(array('prefix' => '{sitelang}', 'middleware' => ['XSS']), function () {

    Route::match(array('GET', 'POST'), '/', 'HomeController@index');
    Route::match(array('GET', 'POST'), '/home', 'HomeController@index');
    Route::match(array('GET', 'POST'), '/search', 'ContentController@search')->name('search');
    Route::match(array('GET', 'POST'), '/contact-us', 'ContactController@index')->name('contact');
    Route::match(array('GET', 'POST'), '/council-member/{member_id}', 'HomeController@fetchCouncilMember')->name('council-member');
    Route::match(array('GET', 'POST'), '/elderly-people-videos/{search_keywords}', 'HomeController@fetchElderlyPeopleVideos')->name('elderly-people-videos');

    // Certificate download
    Route::match(array('GET', 'POST'), '/charter-pledge-certificate/{cpr_hash}', 'HomeController@charterPledgeCertificate')->name('charter-pledge-certificate');

    Route::match(array('GET', 'POST'), '/view-charter-certificate', 'HomeController@viewCharterPledgeCertificate')->name('view-charter-certificate');
    Route::post('/check-if-registered', 'HomeController@checkIfRegistered')->where('lang', 'en|ar')->name('check-if-registered');

    //
    Route::match(array('GET'), '/{alias}/article/{subalias}', 'ContentController@articleDetails');
    Route::match(array('GET'), '/{alias}/blog/{subalias}', 'ContentController@blogDetails');

    Route::match(array('GET'), '/{alias}/article/tag/{tagalias}', 'ContentController@articleByTags');

    //report
    Route::match(array('GET', 'POST'), '/report', 'ContactController@report')->name('report');


    /*ContentController Match Everything else*/
    Route::match(array('GET', 'POST'), '/{alias}/{subalias}', 'ContentController@index')->name('page_details')->where('alias', '^(?!translator).*$');
    Route::match(array('GET', 'POST'), '/{alias}', 'ContentController@index')->name('page')->where('alias', '^(?!translator).*$');

    /*ContentController Match Everything else*/
});
