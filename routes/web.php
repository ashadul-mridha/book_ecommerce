<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
// Frontend Contorller
Route::group(['namespace' => 'Frontend'], function () {
    Route::get('/', 'FrontendController@index');
    Route::get('/search-book', 'FrontendController@search')->name('books.search');
    Route::get('/category', 'FrontendController@category_page')->name('books.category');
    // boimela and best saler page
    Route::get('/boimela', 'BoimelaController@index');
    Route::get('/bookexpress-bestseller', 'BoimelaController@best_saller')->name('book.best_seller');
    Route::get('/search/action', 'FrontendController@live_search')->name('books.live_search');
    Route::get('/book/{id}/{name}', 'FrontendController@book_details');
    Route::get('/book/grid', 'FrontendController@book_grid');
    Route::get('page/{slug}', 'FrontendController@page')->name('page');
    Route::post('/wishlist/{id}/add', 'ProductController@book_wishlist');
    // Author
    Route::get('/book/authors', 'AuthorController@index')->name('books.authors');
    Route::get('/book/author/{id}/details', 'AuthorController@author_details')->name('author.details');

    //category Controller
   // Route::get('/book/subcategory/{id}/details', 'CategoryController@details')->name('author.details');
    // Publisher
    Route::get('/book/publishers', 'PublisherController@index')->name('books.publishers');
    Route::get('/book/publisher/{id}/details', 'PublisherController@publisher_details')->name('publisher.details');
    // All Cart controller
    Route::get('/cart', 'ProductController@cart_view');
    Route::get('/add/to/cart/{id}', 'ProductController@add_to_cart');
    Route::get('/cart/{id}/update', 'ProductController@cart_update');
    Route::delete('/cart/{id}/delete', 'ProductController@cart_delete');
    Route::post('/cart/coupon/{code}', 'ProductController@cart_coupon');
    Route::group(['middleware' => ['auth']], function () {
        // Checkout controller
        Route::get('/checkout', 'CheckoutController@index')->name('checkout');
        Route::post('/checkout', 'CheckoutController@checkout')->name('checkout');
        Route::post('/ajax-city/{id}', 'CheckoutController@ajax_city')->name('ajax.city');
        // Route::get('/payment', 'CheckoutController@payment_view')->name('payment.view');
        Route::post('/checkout/delivery/type', 'CheckoutController@delivery_type');
        Route::get('/confirmation/{id}', 'CheckoutController@confirm_order')->name('confirm.order');
        Route::get('/payment/bkashpayment', 'CheckoutController@bkash_payment')->name('bkash.payment');
        Route::post('/payment/createbkashpayment', 'PaymentController@create_bkash_payment');
        Route::post('/payment/executebkashpayment', 'PaymentController@execute_bkash_payment');
        Route::post('/payment/success', 'PaymentController@payment_success');
    });

    // Route::post('/payment/createbkashpayment', function () {
    //     return 'Hlleo';
    // });
    // Route::post('/payment/executebkashpayment', function () {
    //     return 'Hlleo';
    // });
    // user_info
    Route::group(['middleware' => ['auth']], function () {
        Route::get('/my-section/profile', 'UserAuthController@index')->name('user.deshboard');
        Route::post('/my-section/profile-update', 'UserAuthController@profile_update');
        Route::post('/my-section/email/change/request', 'UserAuthController@email_change_request');
        Route::post('/my-section/email/change', 'UserAuthController@email_change');
        Route::post('/my-section/changePassword', 'UserAuthController@change_password');
        Route::post('/my-section/profile-photo-update', 'UserAuthController@update_photo');
        Route::post('/my-section/create/review', 'UserAuthController@user_ceate_review');
        Route::get('/my-section/orders', 'UserOrderController@index')->name('user.orders');
        Route::post('/order/cancel', 'UserOrderController@order_cancel');
        Route::get('/my-section/wishlist', 'UserOrderController@user_wishlist')->name('user.wishlist');
        Route::post('/my-section/wishlist/{id}/delete', 'UserOrderController@user_wishlist_remove')->name('user.wishlist.remove');
        Route::get('/my-section/reviews', 'UserOrderController@user_review')->name('user.reviews');
    });
});
Route::get('order/cash', function () {
    return view('frontend.cash_on');
});
// Route::get('/cartcontent', function () {
//     return Cart::getContent();
// });
Auth::routes();
Route::get('/seed', 'Frontend\FrontendController@seed');
// Route::get('/home', 'HomeController@index')->name('home');
// Backend Controller
Route::group(['middleware' => ['auth']], function () {
    Route::get('/admin', 'HomeController@index')->name('admin')->middleware(['middleware' => 'permission:manage-admin-area']);
    Route::group(['namespace' => 'Backend', 'prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::resource('roles', 'RolesController')->middleware(['middleware' => 'permission:manage-roles']);
        Route::resource('users', 'UsersController')->middleware(['middleware' => 'permission:manage-users']);
        Route::resource('headers', 'Headers\HeadersController')->middleware(['middleware' => 'permission:manage-headers']);
        Route::resource('menus', 'Headers\MenusController')->middleware(['middleware' => 'permission:manage-headers']);
        Route::resource('searchs', 'Headers\SearchsController')->middleware(['middleware' => 'permission:manage-headers']);

        Route::resource('banners', 'Banners\BannersController')->middleware(['middleware' => 'permission:manage-banners']);
        Route::resource('companys', 'Companys\CompanysController')->middleware(['middleware' => 'permission:manage-company-slider']);
        Route::resource('footer/first', 'Footers\FooterFirstController')->middleware(['middleware' => 'permission:manage-footers']);
        Route::resource('footer/second', 'Footers\FooterSecondController')->middleware(['middleware' => 'permission:manage-footers']);
        Route::resource('footer/third', 'Footers\FooterThirdController')->middleware(['middleware' => 'permission:manage-footers']);
        Route::resource('footer/fourth', 'Footers\FooterFourthController')->middleware(['middleware' => 'permission:manage-footers']);
        Route::resource('homepagecategory', 'HomePageCategoryController')->middleware(['middleware' => 'permission:manage-home-page|manage-all-page']);
        Route::resource('categoryboimela', 'BoimelaController')->middleware(['middleware' => 'permission:manage-boimela-categories|manage-boimela']);
        Route::group(['namespace' => 'Book', 'prefix' => 'books'], function () {
            Route::resource('categories', 'Category\CategoryController')->middleware(['middleware' => 'permission:manage-categories']);
            Route::resource('subcategories', 'Category\SubCatController')->middleware(['middleware' => 'permission:manage-subcategories|manage-categories']);
            Route::resource('authors', 'Author\AuthorController')->middleware(['middleware' => 'permission:manage-authors']);
            Route::resource('publishers', 'Publisher\PublisherController')->middleware(['middleware' => 'permission:manage-publishers']);
            Route::resource('books', 'BookController')->middleware(['middleware' => 'permission:manage-books']);
            Route::resource('coupons', 'CouponController')->middleware(['middleware' => 'permission:manage-coupons']);
        });

        // Route::resource('permissions', 'Backend\PermissionsController');
        Route::resource('orders', 'OrderController')->middleware(['middleware' => 'permission:manage-order']);
        Route::get('cancels/orders', 'OrderController@orders_cancels')->middleware(['middleware' => 'permission:manage-order']);
        Route::get('cancels/orders/{id}', 'OrderController@order_cancel_view')->middleware(['middleware' => 'permission:manage-order']);
        // ads route
        Route::resource('adsheader', 'Ads\HeaderAdsController')->middleware(['middleware' => 'permission:manage-ads']);
        Route::resource('adsbanner', 'Ads\BannerAdsController')->middleware(['middleware' => 'permission:manage-ads']);
        Route::resource('adsbottom', 'Ads\BottomAdsController')->middleware(['middleware' => 'permission:manage-ads']);
        // pdf
        Route::get('invoice-view/{id}', 'PDFController@invoice_view')->name('invoice.view')->middleware(['middleware' => 'permission:manage-order']);
        Route::get('invoice-pdf/{id}', 'PDFController@invoice_pdf')->name('invoice.pdf')->middleware(['middleware' => 'permission:manage-order']);
        Route::resource('pages', 'Page\DynamicPageController')->middleware(['middleware' => 'permission:manage-all-page']);
        Route::resource('login-pages', 'LoginPageController')->middleware(['middleware' => 'permission:manage-admin-area']);
    });
    // ->middleware(['middleware' => 'role:writer'])
});
