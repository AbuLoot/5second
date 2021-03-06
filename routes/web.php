<?php

Route::redirect('/admin', '/'.app()->getLocale().'/admin');

// Joystick Administration
Route::group(['prefix' => '{lang}/admin', 'middleware' => ['auth', 'role:admin|manager']], function () {

    Route::get('/', 'Joystick\AdminController@index');
    Route::get('filemanager', 'Joystick\AdminController@filemanager');
    Route::get('frame-filemanager', 'Joystick\AdminController@frameFilemanager');

    Route::resources([
        'categories' => 'Joystick\CategoryController',
        'pages' => 'Joystick\PageController',
        'section' => 'Joystick\SectionController',
        'posts' => 'Joystick\PostController',
        'products' => 'Joystick\ProductController',
        'slides' => 'Joystick\SlideController',
        'cards' => 'Joystick\CardController',
        'orders' => 'Joystick\OrderController',
        'options' => 'Joystick\OptionController',
        'modes' => 'Joystick\ModeController',
        'companies' => 'Joystick\CompanyController',
        'regions' => 'Joystick\RegionController',
        'roles' => 'Joystick\RoleController',
        'users' => 'Joystick\UserController',
        'permissions' => 'Joystick\PermissionController',
        'languages' => 'Joystick\LanguageController',
    ]);

    Route::get('categories-actions', 'Joystick\CategoryController@actionCategories');
    Route::get('companies-actions', 'Joystick\CompanyController@actionCompanies');

    Route::get('products-actions', 'Joystick\ProductController@actionProducts');
    Route::get('products-search', 'Joystick\ProductController@search');
    Route::get('products-category/{id}', 'Joystick\ProductController@categoryProducts');
    Route::get('products/{id}/comments', 'Joystick\ProductController@comments');
    Route::get('products/{id}/destroy-comment', 'Joystick\ProductController@destroyComment');

    Route::get('apps', 'Joystick\AppController@index');
    Route::get('apps/{id}', 'Joystick\AppController@show');
    Route::delete('apps/{id}', 'Joystick\AppController@destroy');
});

Route::redirect('/', '/'.app()->getLocale());
Route::redirect('/home', '/'.app()->getLocale().'/home');

// Site
Route::group(['prefix' => '{lang}'], function () {

    // Authentication routes... ->middleware('guest')
    Route::get('cs-login', 'Auth\AuthCustomController@getLogin');
    Route::post('cs-login', 'Auth\AuthCustomController@postLogin');

    // Registration routes...
    Route::get('cs-register', 'Auth\AuthCustomController@getRegister');
    Route::post('cs-register', 'Auth\AuthCustomController@postRegister');
    // Route::get('confirm/{token}', 'Auth\AuthCustomController@confirm');

    // Registration routes...
    Route::get('cs-login-and-register', 'Auth\AuthCustomController@getLoginAndRegister');

    Auth::routes();

    // Profile
    Route::resource('my-profile', 'ProfileController')->except(['create', 'show', 'store', 'destroy']);
    Route::resource('my-companies', 'CompanyController');
    Route::resource('my-ads', 'ProductController');
    // Route::get('card-selection', 'ProfileController@cardSelection');
    // Route::get('set-card/{type}', 'ProfileController@setCard');
    Route::get('set-services', 'ProfileController@setServices');
    Route::get('my-apps', 'ProfileController@myApps');
    Route::get('statistics', 'ProfileController@statistics');

    // Balance and Payment
    Route::get('my-balance', 'ProfileController@balance');
    Route::post('top-up-balance', 'ProfileController@topUpBalance');
    Route::get('payment', 'ProfileController@payment');
    Route::get('activate-card', 'ProfileController@activateCard');

    // News
    Route::get('i/news', 'NewsController@news');
    Route::get('news/{page}', 'NewsController@newsSingle');
    Route::post('comment-news', 'NewsController@saveComment');

    // Pages
    // Route::get('/', 'PageController@index');
    Route::get('i/catalog/{condition?}', 'PageController@catalog');
    Route::get('i/contacts', 'PageController@contacts');
    Route::get('i/{page}', 'PageController@page');

    // Shop
    Route::get('/', 'ShopController@index');
    Route::get('brand/{company}', 'ShopController@brandProducts');
    Route::get('brand/{company}/{category}/{id}', 'ShopController@brandCategoryProducts');
    Route::get('{category}/c-{id}', 'ShopController@categoryProducts');
    Route::get('{category}/{subcategory}/c-{id}', 'ShopController@subCategoryProducts');
    Route::get('{product}/p-{id}', 'ShopController@product');
    Route::post('comment-product', 'ShopController@saveComment');

    // Input
    Route::get('search', 'InputController@search');
    Route::get('search-ajax', 'InputController@searchAjax');
    Route::get('set-region', 'InputController@setRegion');
    Route::post('send-app', 'InputController@sendApp');
    Route::post('filter-products', 'InputController@filterProducts');

    // Comments
    Route::post('review', 'CommentController@saveReview');
    // Route::post('comment', 'CommentController@saveComment');
});

// Cart Actions
// Route::get('cart', 'CartController@cart');
// Route::get('add-to-cart/{id}', 'CartController@addToCart');
// Route::get('remove-from-cart/{id}', 'CartController@removeFromCart');
// Route::get('clear-cart', 'CartController@clearCart');
// Route::post('store-order', 'CartController@storeOrder');
// Route::get('destroy-from-cart/{id}', 'CartController@destroy');

// Favourite Actions
// Route::get('favorite', 'FavouriteController@getFavorite');
// Route::get('toggle-favourite/{id}', 'FavouriteController@toggleFavourite');

Route::get('paybox/{amount}/{id}', 'PaymentController@PayBox');
Route::post('paybox/result', 'PaymentController@PayBoxResult')->name('PayBoxResult');
