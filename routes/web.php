<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\AdminProfileController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\LanguageController;
use App\Http\Controllers\Frontend\ProductDetailsController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\User\WishlistController;
use App\Http\Controllers\User\CartPageController;
use App\Models\User;
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

// group routes start with admin/.... redirect to admin/dashboard
Route::group(['prefix' => 'admin', 'middleware' => ['admin:admin']], function() {
   Route::get('/login', [AdminController::class, 'loginForm']);
   Route::post('/login', [AdminController::class, 'store'])->name('admin.login');
});

// admin auth
Route::middleware(['auth:sanctum,admin', 'verified'])->get('/admin/dashboard', function () {
    return view('admin.index');
//    user need to log in as admin in order to access admin/dashboard
})->name('dashboard')->middleware('auth:admin');

// user auth
Route::middleware(['auth:sanctum,web', 'verified'])->get('/dashboard', function () {
    $id = Auth::user()->id;
    $user = User::find($id);
    return view('dashboard', compact('user'));
})->name('dashboard');
// USER all routes
Route::get('/', [IndexController::class, 'index']);
Route::get('/user/logout', [IndexController::class, 'UserLogout'])->name('user.logout');
Route::get('/user/profile', [IndexController::class, 'UserProfile'])->name('user.profile');
Route::post('/user/profile/store', [IndexController::class, 'UserProfileStore'])->name('user.profile.store');
Route::get('/user/change/password', [IndexController::class, 'UserChangePassword'])->name('change.password');
Route::post('/user/password/update', [IndexController::class, 'UserPasswordUpdate'])->name('user.password.update');


// group route with middleware
Route::middleware(['auth:admin'])->group(function() {
    // admin all route
    Route::get('admin/logout', [AdminController::class, 'destroy'])->name('admin.logout');
    Route::get('admin/profile/{id}', [AdminProfileController::class, 'AdminProfile']);
    Route::get('admin/profile/edit/{id}', [AdminProfileController::class, 'EditAdminProfile']);
    Route::post('admin/profile/store/{id}', [AdminProfileController::class, 'StoreAdminProfile']);
    Route::get('admin/change/password', [AdminProfileController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('update/change/password/{id}', [AdminProfileController::class, 'UpdateChangePassword']);

    // Admin Brand All Route
    Route::prefix('brand')->group(function() {
        Route::get('/view', [BrandController::class, 'BrandView'])->name('all.brand');
        Route::post('/store', [BrandController::class, 'BrandStore'])->name('brand.store');
        Route::get('/edit/{id}', [BrandController::class, 'BrandEdit'])->name('brand.edit');
        Route::post('/update', [BrandController::class, 'BrandUpdate'])->name('brand.update');
        Route::get('/delete/{id}', [BrandController::class, 'BrandDelete'])->name('brand.delete');
    });

    // Admin Category All Route
    Route::prefix('category')->group(function() {
        Route::get('/view', [CategoryController::class, 'CategoryView'])->name('all.category');
        Route::post('/store', [CategoryController::class, 'CategoryStore'])->name('category.store');
        Route::get('/edit/{id}', [CategoryController::class, 'CategoryEdit'])->name('category.edit');
        Route::post('/update/{id}', [CategoryController::class, 'CategoryUpdate'])->name('category.update');
        Route::get('/delete/{id}', [CategoryController::class, 'CategoryDelete'])->name('category.delete');

//    Admin Subcategory All Routes
        Route::get('/sub/view', [SubCategoryController::class, 'SubCategoryView'])->name('all.subcategory');
        Route::post('/sub/store', [SubCategoryController::class, 'SubCategoryStore'])->name('subcategory.store');
        Route::get('sub/edit/{id}', [SubCategoryController::class, 'SubCategoryEdit'])->name('subcategory.edit');
        Route::post('/sub/update', [SubCategoryController::class, 'SubCategoryUpdate'])->name('subcategory.update');
        Route::get('/sub/delete/{id}', [SubCategoryController::class, 'SubCategoryDelete'])->name('subcategory.delete');

//    Admin SubSubcategory All Routes
        Route::get('/sub/sub/view', [SubCategoryController::class, 'SubSubCategoryView'])->name('all.subsubcategory');
        Route::get('/subcategory/ajax/{category_id}', [SubCategoryController::class, 'GetSubCategory']);
        Route::get('/sub-subcategory/ajax/{subcategory_id}', [SubCategoryController::class, 'GetSubSubCategory']);
        Route::post('/sub/sub/store', [SubCategoryController::class, 'SubSubCategoryStore'])->name('subsubcategory.store');
        Route::get('/sub/sub/edit/{id}', [SubCategoryController::class, 'SubSubCategoryEdit'])->name('subsubcategory.edit');
        Route::post('/sub/sub/update', [SubCategoryController::class, 'SubSubCategoryUpdate'])->name('subsubcategory.update');
        Route::get('/sub/sub/delete/{id}', [SubCategoryController::class, 'SubSubCategoryDelete'])->name('subsubcategory.delete');

    });

    // Admin Product All Route
    Route::prefix('product')->group(function() {
        Route::get('/add', [ProductController::class, 'AddProduct'])->name('add.product');
        Route::post('/store', [ProductController::class, 'StoreProduct'])->name('product-store');
        Route::get('/manage', [ProductController::class, 'ManageProduct'])->name('manage-product');
        Route::get('/edit/{id}', [ProductController::class, 'EditProduct'])->name('product.edit');
        Route::post('/data/update', [ProductController::class, 'ProductDataUpdate'])->name('product-update');
        Route::post('/image/update', [ProductController::class, 'MultiImageUpdate'])->name('update-product-image');
        Route::post('/thumbnail/update', [ProductController::class, 'ThumbnailImageUpdate'])->name('update-product-thumbnail');
        Route::post('/images/add/{productId}', [ProductController::class, 'addImagesOnEditPage'])->name('add.product.images');
        Route::get('/multiimg/delete/{id}', [ProductController::class, 'MultiImageDelete'])->name('product.multiimg.delete');
        Route::get('/inactive/{id}', [ProductController::class, 'InactiveProduct'])->name('product.inactive');
        Route::get('/active/{id}', [ProductController::class, 'ActiveProduct'])->name('product.active');
        Route::get('/detail/{id}', [ProductController::class, 'showProductDetails'])->name('product.detail');
        Route::get('/delete/{id}', [ProductController::class, 'deleteProduct'])->name('product.delete');
    });

    // Admin Slider All Route
    Route::prefix('slider')->group(function() {
        Route::get('/view', [SliderController::class, 'viewSlider'])->name('manage.slider');
        Route::post('/store', [SliderController::class, 'storeSlider'])->name('slider.store');
        Route::get('/edit/{id}', [SliderController::class, 'editSlider'])->name('slider.edit');
        Route::post('/update', [SliderController::class, 'updateSlider'])->name('slider.update');
        Route::get('/delete/{id}', [SliderController::class, 'deleteSlider'])->name('slider.delete');
        Route::get('/inactive/{id}', [SliderController::class, 'inactiveSlider'])->name('slider.inactive');
        Route::get('/active/{id}', [SliderController::class, 'activeSlider'])->name('slider.active');

    });

});

// Frontend All Routes
// Multi Language Routes
Route::get('/language/vietnamese', [LanguageController::class, 'renderVietnamese'])->name('vietnamese.language');
Route::get('/language/english', [LanguageController::class, 'renderEnglish'])->name('english.language');
// Product Details Page URL
Route::get('/product/details/{id}/{slug}', [ProductDetailsController::class, 'showDetails']);

// Frontend Product Tags
Route::get('product/tag/{tag}', [IndexController::class, 'TagWiseProduct']);

// Frontend Subcategory wise Data
Route::get('subcategory/product/{subcate_id}/{slug}', [IndexController::class, 'SubCategoryWiseProduct']);

// Frontend SubSubcategory wise Data
Route::get('subsubcategory/product/{subSubCate_id}/{slug}', [IndexController::class, 'SubSubCategoryWiseProduct']);

// Product View Modal with AJAX
Route::get('/product/view/modal/{id}', [IndexController::class, 'ProductViewAjax']);

// addToCart store data
Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);
// get mini cart
Route::get('/product/mini/cart', [CartController::class, 'GetMiniCart']);
// remove mini cart
Route::get('/minicart/product-remove/{rowId}', [CartController::class, 'RemoveMiniCart']);

// Add to wishlist
Route::post('/add-to-wishlist/{product_id}', [CartController::class, 'AddToWishlist']);

// Wishlist page
Route::group(['prefix' => 'user', 'middleware' => ['user', 'auth'], 'namespace' => 'User'], function() {
    Route::get('/get-wishlist-product', [WishlistController::class, 'GetWishListProduct']);
    Route::get('/wishlist-remove/{id}', [WishlistController::class, 'RemoveWishListProduct']);
    Route::get('/wishlist', [WishlistController::class, 'ViewWishlist'])->name('wishlist');
});


//    my cart manage route
Route::get('/mycart', [CartPageController::class, 'MyCart'])->name('mycart');
Route::get('/user/get-cart-product', [CartPageController::class, 'GetCartProduct']);
Route::get('/user/cart-remove/{rowId}', [CartPageController::class, 'RemoveCartProduct']);
Route::get('/cart-increment/{rowId}', [CartPageController::class, 'CartIncrement']);
Route::get('/cart-decrement/{rowId}', [CartPageController::class, 'CartDecrement']);

// Admin Slider All Route
Route::prefix('coupons')->group(function() {
    Route::get('/view', [CouponController::class, 'CouponView'])->name('manage-coupon');
    Route::post('/store', [CouponController::class, 'CouponStore'])->name('coupon.store');
    Route::get('/edit/{id}', [CouponController::class, 'CouponEdit'])->name('coupon.edit');
    Route::post('/update/{id}', [CouponController::class, 'CouponUpdate'])->name('coupon.update');
    Route::get('/delete/{id}', [CouponController::class, 'CouponDelete'])->name('coupon.delete');

});
