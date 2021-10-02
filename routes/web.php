<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\ProductAttributeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\cmsController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\RattingController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\indexController;
use App\Http\Controllers\Frontend\ProductController as FrontendProductController;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\AddressController;
use App\Http\Controllers\Frontend\CouponController as FrontendCouponController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\OrdersController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\CmsController as FrontendCmsController;
use App\Http\Controllers\Frontend\RatingController;
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
use App\Models\Category;
use App\Models\CMS;

Route::get('/', function () {
    return view('frontend.pages.index');
});

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => '/admin' ,'as'=>'admin.'] , function () {
    Route::match(['get', 'post'], '/',[AdminController::class ,'login'])->name('login');

    Route::group(['middleware'=>'admin'], function () {
        Route::get('dashboard',[AdminController::class ,'index'])->name('dashboard');
        Route::get('settings',[AdminController::class ,'settings'])->name('settings');
        Route::post('check-pswd',[AdminController::class ,'checkPassword'])->name('pswd');
        Route::post('update-pswd',[AdminController::class ,'UpdatePassword'])->name('update.password');
        Route::get('logout',[AdminController::class ,'logout'])->name('logout');
        Route::match(['get', 'post'], '/update/info',[AdminController::class ,'UpdateInfo'])->name('update.info');
        Route::get('admin-subadmin',[AdminController::class ,'AdminRole'])->name('AdminRole');
        Route::post('update-admin-status',[AdminController::class, 'updateAdminStatus'])->name('updateAdminStatus');
        Route::match(['get', 'post'], '/add-admin',[AdminController::class, 'AddAdmin']);
        Route::match(['get', 'post'], '/edit-admin/{id}',[AdminController::class, 'EditAdmin']);
        Route::match(['get', 'post'], '/change-role/{id}',[AdminController::class, 'ChangeRole']);
        // Other settings routes
        Route::match(['get', 'post'], '/other-settings/{id}',[AdminController::class, 'otherSettings']);
        Route::get('/ratting/index',[RattingController::class ,'Index'])->name('Index');
        Route::post('update-rating-status',[RattingController::class, 'updateRatingStatus']);
        
    });
    // Section group

    Route::get('section/index',[SectionController::class,'index'])->name('section.index');
    Route::post('update-section-status',[SectionController::class,'updateSectionStatus'])->name('updateSectionStatus');
    Route::get('category',[CategoryController::class,'category'])->name('category.index');
    Route::post('update-category-status',[CategoryController::class,'updateCategoryStatus'])->name('updateCategoryStatus');
    Route::get('add-category',[CategoryController::class, 'addCategory'])->name('AddCategory');
    Route::post('create-category',[CategoryController::class, 'createCategory'])->name('createCategory');
    Route::post('append-category-level',[CategoryController::class, 'appendCategoryLevel']);
    Route::get('edit-category/{id}',[CategoryController::class, 'EditCategory'])->name('edit.category');
    Route::post('update-category/{id}',[CategoryController::class, 'updateCategory'])->name('category.update');
    Route::get('delete-category-image/{id}',[CategoryController::class, 'DeleteCategoryImage'])->name('categoryImage');
    Route::get('brands',[BrandController::class,'index'])->name('brands.index');
    Route::post('update-brands-status',[BrandController::class, 'updateBrandsStatus'])->name('updateBrandsStatus');
    Route::post('brands-store',[BrandController::class, 'StoreBrands'])->name('brands.store');
    Route::post('brands-update',[BrandController::class, 'UpdateBrands'])->name('brands.update');
    Route::get('banner/index',[BannerController::class, 'index'])->name('banner.index');
    Route::get('banner/Create',[BannerController::class, 'create'])->name('create.banner');
    Route::post('update-banner-status',[BannerController::class, 'updateBannerStatus'])->name('updateBannerStatus');
    Route::post('store/banner',[BannerController::class, 'store'])->name('store.banner');
    Route::get('banner/edit/{id}',[BannerController::class, 'edit'])->name('edit.banner');
    Route::post('update/banner/{id}',[BannerController::class, 'update'])->name('update.banner');

     // for Coupon code
     Route::get('/coupon/index',[CouponController::class ,'index']);

    //  Update coupon status
    Route::post('update-coupon-status',[CouponController::class, 'updateCouponStatus']);

    // Create coupon
    Route::get('/coupon/create',[CouponController::class, 'createCoupon']);
    Route::post('/coupon/store',[CouponController::class, 'storeCoupon'])->name('store.coupon');
    Route::get('/coupon/edit/{id}',[CouponController::class, 'editCoupon']);
    Route::post('/coupon/update/{id}',[CouponController::class, 'updateCoupon'])->name('update.coupon');
    Route::get('/order/index/',[OrderController::class, 'Index'])->name('order.index');
    Route::get('/order/view/{id}',[OrderController::class, 'View']);
    Route::get('/order/invoice/{id}',[OrderController::class, 'Invoice']);
    Route::post('/update-order-status',[OrderController::class, 'UpdateOrderStatus']);
    Route::get('/print/invoice/{id}',[OrderController::class, 'PrintPdf']);
    Route::get('/shipping/index',[ShippingController::class, 'Index']);
    Route::post('/update-shipping-status',[ShippingController::class, 'UpdateShippingStatus']);
    Route::match(['get', 'post'], '/shipping/edit/{id}',[ShippingController::class, 'updateShippingCharges']);
    // CMS part routs
    Route::get('/cms/index',[cmsController::class, 'Index']);
    Route::match(['get', 'post'], '/cms/create',[cmsController::class, 'Create']);
    Route::match(['get', 'post'], '/cms/edit/{id}',[cmsController::class, 'Edit']);
    Route::post('/update-cms-status',[cmsController::class, 'UpdateCmsStatus']);
});

Route::group(['prefix' => 'product', 'as'=>'product.'], function () {
     Route::get('index',[ProductController::class,'index'])->name('index');
     Route::post('update-product-status',[ProductController::class,'updateProductsStatus'])->name('updateStatus');
     Route::get('create',[ProductController::class,'createProduct'])->name('create');
     Route::post('store',[ProductController::class,'storeProducts'])->name('store');
     Route::get('edit/{id}',[ProductController::class,'editProduct'])->name('edit');
     Route::post('update/{id}',[ProductController::class,'updateProducts'])->name('update');
     Route::get('/delete-product-image/{id}',[ProductController::class, 'DeleteProductImage'])->name('productImage');
     Route::get('/delete-product-video/{id}',[ProductController::class, 'DeleteProductVideo'])->name('productVideo');
     Route::get('/add-attribute/{id}',[ProductAttributeController::class, 'AddAttribute'])->name('add.attribute');
     Route::post('attribute/store/{id}',[ProductAttributeController::class,'StoreAttribute'])->name('store.attribute');
     Route::post('/edit-attribute/{id}',[ProductAttributeController::class, 'UpdateAttribute'])->name('update.attribute');
     Route::get('/delete-attribute/{id}',[ProductAttributeController::class, 'DeleteAttribute'])->name('DeleteAttribute');
     Route::post('/update-attribute-status',[ProductAttributeController::class, 'updateAttributeStatus'])->name('updateAttributeStatus');
     Route::get('/add-product-images/{id}',[ProductAttributeController::class, 'AddProductImage'])->name('add.image');
     Route::post('/store-product-image/{id}',[ProductAttributeController::class, 'storeProductImage'])->name('store.image');
     Route::post('/update-image-status',[ProductAttributeController::class, 'updateImageStatus'])->name('updateImageStatus');
     Route::get('/delete-images/{id}',[ProductAttributeController::class, 'DeleteProductImages'])->name('productImages');
});

Route::get('delete-category/{id}',[CategoryController::class, 'destroyCategory'])->name('category.destroy');
Route::get('delete-product/{id}',[ProductController::class, 'destroyProduct'])->name('product.destroy');
Route::get('delete-brands/{id}',[BrandController::class, 'destroyBrands'])->name('brands.destroy');
Route::get('delete-banner/{id}',[BannerController::class, 'DeleteBanner'])->name('DeleteBanner');
Route::get('delete-coupon/{id}',[CouponController::class, 'DeleteCoupon']);
Route::get('/delete-cmsInfo/{id}',[cmsController::class, 'DeleteCMS'])->name('DeleteCMS');




Route::namespace('Frontend')->group(function(){
    Route::get('/',[indexController::class, 'index'])->name('index');
    $catUrls=Category::where('status',1)->select('url')->get()->pluck('url')->toArray();
    foreach($catUrls as $url){
        Route::get('/'.$url,[FrontendProductController::class, 'listing'])->name('listing');
    }
    $CmsUrls =CMS::where('status',1)->select('url')->get()->pluck('url')->toArray();
    foreach ($CmsUrls as $CmsUrl) {
        Route::get('/'.$CmsUrl,[FrontendCmsController::class, 'Index'])->name('cmsPages');
    }
    Route::match(['get', 'post'], '/contact',[FrontendCmsController::class, 'Contact']);


    Route::get('/search',[FrontendProductController::class ,'listing']);
    Route::get('/single-product/{id}',[FrontendProductController::class, 'singleProduct'])->name('single.product');
    Route::post('/get-product-price',[FrontendProductController::class,'getProductPrice']);
    Route::post('/add-to-cart',[CartController::class, 'addToCart']);
    Route::get('/all-cart',[CartController::class, 'showCart'])->name('cart');
    Route::post('/update-cart-item-quantity',[CartController::class,'UpdateCartItemQty']);
    Route::post('/delete-cart-item',[CartController::class,'DeleteCartItem']);
    // User Login/Register routes
    Route::get('/login-register',[UserController::class,'loginRegister'])->name('login');
    Route::post('/login',[UserController::class,'UserLogin']);
    Route::post('/register',[UserController::class,'UserRegister']);
    Route::get('/logout',[UserController::class,'logout']);
    Route::post('/submit-rate',[RatingController::class, 'submitRate']);
    Route::middleware(['auth'])->group(function () {
        // Check email validation for login or register
        Route::match(['get', 'post'],'/check-email',[UserController::class,'checkEmail']);
        // confirm email
        Route::match(['get', 'post'],'/confirm/{code}',[UserController::class,'confirmAccount']);
        // My Account
        Route::match(['get', 'post'], '/my_account',[UserController::class,'MyAccount']);
        // Update user password
        Route::match(['get', 'post'], '/update-user-password', [UserController::class, 'UpdateUserPassword']);
        // Apply coupon code
        Route::post('/apply-coupon',[FrontendCouponController::class,'applyCoupon']);
        Route::match(['get', 'post'],'/checkout',[CheckoutController::class,'Checkout']);

        Route::get('/thanks',[CheckoutController::class,'Thanks']);
        Route::get('/orders',[OrdersController::class,'Orders']);
        Route::get('/single_order/{id}',[OrdersController::class,'SingleOrder']);
        Route::get('/paypal',[CheckoutController::class,'Paypal']);
    });
    // Check user password correct or not
    Route::post('/check-current-password',[UserController::class, 'CheckCurrentPassword']);
    // Forgot Password
    Route::match(['get', 'post'],'/forgot-password',[UserController::class,'forgotPassword']);
    Route::match(['get', 'post'],'/add-delivery-address',[AddressController::class,'addAddress']);
    Route::match(['get', 'post'],'/edit-address/{id}',[AddressController::class,'EditAddress']);
    Route::get('/delete-address/{id}',[AddressController::class,'DeleteAddress']);

});
