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

use Illuminate\Support\Facades\Route;


/**
 * Admin routes
 */
Route::group(['prefix' => 'admin', 'middleware' => ['employee'], 'as' => 'admin.'], function () {
    Route::namespace('Admin')->group(function () {
        Route::namespace('Products')->group(function () {
            Route::resource('products', 'ProductController');
            Route::put('api/update-product-order/{id}', 'ProductController@updateSortOrder');
            Route::get('remove-image-product', 'ProductController@removeImage')->name('product.remove.image');
            Route::get('remove-image-thumb', 'ProductController@removeThumbnail')->name('product.remove.thumb');
            Route::get('duplicate-product', 'ProductController@duplicateProduct')->name('product.duplicate');
        });

        Route::namespace('Categories')->group(function () {
            Route::resource('categories', 'CategoryController');
            Route::put('api/update-category-order/{id}', 'CategoryController@updateSortOrder');
            Route::get('remove-image-category', 'CategoryController@removeImage')->name('category.remove.image');
        });
        Route::namespace('Orders')->group(function () {
            Route::resource('orders', 'OrderController');
            Route::resource('order-statuses', 'OrderStatusController');
            Route::get('orders/{id}/invoice', 'OrderController@generateInvoice')->name('orders.invoice.generate');
        });

        Route::namespace('OrderShipments')->group(function () {
            Route::resource('order-shipments', 'OrderShipmentController');
        });

        Route::namespace('Checkouts')->group(function () {
            Route::resource('checkouts', 'CheckoutController');
        });

        Route::namespace('Brands')->group(function () {
            Route::resource('brands', 'BrandController');
        });

        Route::namespace('Attributes')->group(function () {
            Route::resource('attributes', 'AttributeController');
        });

        Route::namespace('ProductAttributes')->group(function () {
            Route::resource('product-attributes', 'ProductAttributeController');
        });

        Route::resource('couriers', 'Couriers\CourierController');
        Route::resource('attributes.values', 'Attributes\AttributeValueController');

        Route::namespace('Wishlist')->group(function () {
            Route::resource('wishlist', 'WishlistControllerAdmin');
        });
    });
});


/**
 * Frontend routes
 */
Route::namespace('Auth')->group(function () {
    Route::get('cart/login', 'CartLoginController@showLoginForm')->name('cart.login');
    Route::post('cart/login', 'CartLoginController@login')->name('cart.login');
    Route::resource('wishlist', 'WishlistController');
});

Route::namespace('Front')->group(function () {
    Route::group(['middleware' => ['auth', 'web']], function () {
        Route::namespace('Payments')->group(function () {
            Route::post('bank-transfer', 'BankTransferController@store')->name('bank-transfer.store');
            Route::post('credit-card', 'CreditCardPaymentsController@store')->name('creditcard.store');
            Route::post('efecty', 'EfectyController@store')->name('efecty.store');
            Route::post('baloto', 'BalotoController@store')->name('baloto.store');
            Route::post('pse', 'PsePaymentsController@store')->name('pse.store');
        });

        Route::get('accounts', 'AccountsController@index')->name('accounts');
        Route::get('thankupage_bancolombia', 'ThankUPageBancolombiaController@index')->name('thankupage_bancolombia');
        Route::get('thankupage_payu', 'ThankUPagePayUController@index')->name('thankupage_payu');
        Route::get('thankupage_efecty', 'ThankUPageEfectyController@index')->name('thankupage_efecty');
        Route::get('thankupage_baloto', 'ThankUPageBalotoController@index')->name('thankupage_baloto');
        Route::get('thankupage_pse', 'ThankUPagePseController@index')->name('thankupage_pse');

        Route::get('checkout', 'CheckoutController@index')->name('checkout.index');
        Route::post('checkout', 'CheckoutController@store')->name('checkout.store');
        Route::get('checkout/execute', 'CheckoutController@executePayPalPayment')->name('checkout.execute');
        Route::post('checkout/execute', 'CheckoutController@charge')->name('checkout.execute');
        Route::get('checkout/cancel', 'CheckoutController@cancel')->name('checkout.cancel');
        Route::get('checkout/success', 'CheckoutController@success')->name('checkout.success');
        Route::resource('customer.address', 'CustomerAddressController');
        Route::get('/api/getCountry/{id}/province', 'CheckoutController@getCountry')->name('checkout.getCountry');
        Route::get('/api/getProvince/{id}/city', 'CheckoutController@getProvince')->name('checkout.getProvince');
    });
    Route::resource('cart', 'CartController');
    Route::resource('wishlist', 'WishlistController');
    Route::get('api/getCart/', 'CartController@getCart')->name('front.get.cart');
    Route::get('category/{slug}', 'CategoryController@getCategory')->name('front.category.slug');
    Route::get('outlet', 'ProductController@outlet')->name('outlet');
    Route::get('search', 'ProductController@search')->name('search.product');
    Route::get('{product}', 'ProductController@show')->name('front.get.product');
    Route::get("search", 'ProductController@search')->name('search.product');
    Route::get("{product}", 'ProductController@show')->name('front.get.product');
    Route::get('api/getWishlist/', 'WishlistController@getWishlist');
});
