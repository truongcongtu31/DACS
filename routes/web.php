<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FeedBackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SlideController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Verify email
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

//End verify

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//User
Route::prefix('user')->group(function () {
    Route::get('/home', [UserController::class, 'index'])->name('home');
    Route::get('/home/product-detail/{id?}', [HomeController::class, 'showProductDetail'])->name('product.show');
    Route::get('/shop', [ProductController::class, 'getProductByFilter'])->name('shop');
    Route::get('/search', [ProductController::class, 'searchProduct'])->name('shop.search');
    Route::get('/product-detail', [ProductController::class, 'showProductDetail'])->name('product-detail');
    Route::get('/feedback-ajax', [FeedbackController::class, 'showFeedbackAjax'])->name('feedback.show');
    Route::post('/add-feedback', [FeedbackController::class, 'store'])->name('feedback.add');
    Route::get('/blog', [UserController::class, 'getBlog'])->name('blog');
    Route::get('/blog-detail/{id}', [UserController::class, 'getBlogDetail'])->name('blog-detail');
    Route::get('/show-comment-ajax', [CommentController::class, 'showCommentAjax'])->name('show-comment-ajax');
    Route::post('/add-comment', [CommentController::class, 'addComment'])->name('add-comment');
    Route::get('/about', [UserController::class, 'getAbout'])->name('about');
    Route::get('/contact', [UserController::class, 'getContact'])->name('contact');
    Route::get('/cart', [UserController::class, 'getCart'])->name('cart');
    Route::get('/add-to-cart/{id?}', [CartController::class, 'addToCart'])->name('add-to-cart');
    Route::get('update-cart', [CartController::class, 'updateCart'])->name('update-cart');
    Route::get('delete-cart', [CartController::class, 'deleteCart'])->name('delete-cart');
    Route::get('/get-modal-cart', [CartController::class, 'getModalCart'])->name('get-modal-cart');
    Route::get('/get-cart', [CartController::class, 'getCart'])->name('get-cart');


});

//Order
Route::middleware(['auth', 'role:user', 'verified'])->prefix('order')->group(function () {
    Route::post('/check-out-order', [OrderController::class, 'addOrder'])->name('check-out');
    Route::get('/', [OrderController::class, 'showOrder'])->name('order-show');
    Route::post('/order/delete/{id?}', [OrderController::class, 'destroy'])->name('order.delete');
    Route::post('/order/status/{id?}', [OrderController::class, 'changeStatus'])->name('order.status');
    Route::get('/order-detail/{id?}', [OrderController::class, 'showOrderDetail'])->name('order.detail.show');
});


//Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::prefix('/admin')->group(function () {

        Route::get('/', [AdminController::class, 'index'])->name('homeAdmin');

        //admin/products
        Route::prefix('/product')->group(function () {
            Route::get('/add', [ProductController::class, 'create'])->name('addproduct');
            Route::post('/add', [ProductController::class, 'store'])->name('product.post-add');
            Route::get('/list', [ProductController::class, 'show'])->name('listproduct');
            Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
            Route::post('/update', [ProductController::class, 'update'])->name('product.post-edit');
            Route::get('/delete/{id}', [ProductController::class, 'destroy'])->name('product.delete');
            Route::get('/searchproduct', [ProductController::class, 'getSearchProduct'])->name('searchproduct');
        });
        //admin/category
        Route::prefix('/category')->group(function () {
            Route::get('/add', [CategoryController::class, 'create'])->name('addcategory');
            Route::post('/add', [CategoryController::class, 'store'])->name('category.post-add');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
            Route::post('/update', [CategoryController::class, 'update'])->name('category.post-edit');
            Route::get('/delete/{id}', [CategoryController::class, 'destroy'])->name('category.delete');
            Route::get('/list', [CategoryController::class, 'show'])->name('listcategory');
            Route::get('/searchcategory', [CategoryController::class, 'getSearchCategory'])->name('searchcategory');
        });

        //admin/slide
        Route::prefix('/slide')->group(function () {
            Route::get('/add', [SlideController::class, 'create'])->name('addslide');
            Route::post('/add', [SlideController::class, 'store'])->name('slide.post-add');
            Route::get('/edit/{id}', [SlideController::class, 'edit'])->name('slide.edit');
            Route::post('/update', [SlideController::class, 'update'])->name('slide.post-edit');
            Route::get('/delete/{id}', [SlideController::class, 'destroy'])->name('slide.delete');
            Route::get('/list', [SlideController::class, 'show'])->name('listslide');
            Route::get('/searchslide', [SlideController::class, 'getSearchSlide'])->name('searchslide');
        });

        //admin/banner
        Route::prefix('/banner')->group(function () {
            Route::get('/add', [BannerController::class, 'create'])->name('addbanner');
            Route::post('/add', [BannerController::class, 'store'])->name('banner.post-add');
            Route::get('/edit/{id}', [BannerController::class, 'edit'])->name('banner.edit');
            Route::post('/update', [BannerController::class, 'update'])->name('banner.post-edit');
            Route::get('/delete/{id}', [BannerController::class, 'destroy'])->name('banner.delete');
            Route::get('/list', [BannerController::class, 'show'])->name('listbanner');
            Route::get('/searchbanner', [BannerController::class, 'getSearchBanner'])->name('searchbanner');
        });
        //admin/menu
        Route::prefix('/menu')->group(function () {
            Route::get('/add', [MenuController::class, 'create'])->name('addmenu');
            Route::post('/add', [MenuController::class, 'store'])->name('menu.post-add');
            Route::get('/edit/{id}', [MenuController::class, 'edit'])->name('menu.edit');
            Route::post('/update', [MenuController::class, 'update'])->name('menu.post-edit');
            Route::get('/delete/{id}', [MenuController::class, 'destroy'])->name('menu.delete');
            Route::get('/list', [MenuController::class, 'show'])->name('listmenu');
            Route::get('/searchmenu', [MenuController::class, 'getSearchMenu'])->name('searchmenu');
        });
        //admin/blog
        Route::prefix('/blog')->group(function () {
            Route::get('/add', [BlogController::class, 'create'])->name('addblog');
            Route::post('/add', [BlogController::class, 'store'])->name('blog.post-add');
            Route::get('/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
            Route::post('/update', [BlogController::class, 'update'])->name('blog.post-edit');
            Route::get('/delete/{id}', [BlogController::class, 'destroy'])->name('blog.delete');
            Route::get('/list', [BlogController::class, 'show'])->name('listblog');
            Route::get('/searchblog', [BlogController::class, 'getSearchBlog'])->name('searchblog');
        });
        //admin/about
        Route::prefix('/about')->group(function () {
            Route::get('/add', [AboutController::class, 'create'])->name('addabout');
            Route::post('/add', [AboutController::class, 'store'])->name('about.post-add');
            Route::get('/edit/{id}', [AboutController::class, 'edit'])->name('about.edit');
            Route::post('/update/{id?}', [AboutController::class, 'update'])->name('about.post-edit');
            Route::get('/delete/{id}', [AboutController::class, 'destroy'])->name('about.delete');
            Route::get('/list', [AboutController::class, 'show'])->name('listabout');
            Route::get('/searchabout', [AboutController::class, 'getSearchAbout'])->name('searchabout');
        });

        //admin/color
        Route::prefix('/color')->group(function () {
            Route::get('/add', [ColorController::class, 'create'])->name('addcolor');
            Route::post('/add', [ColorController::class, 'store'])->name('color.post-add');
            Route::get('/edit/{id}', [ColorController::class, 'edit'])->name('color.edit');
            Route::post('/update', [ColorController::class, 'update'])->name('color.post-edit');
            Route::get('/delete/{id}', [ColorController::class, 'destroy'])->name('color.delete');
            Route::get('/list', [ColorController::class, 'show'])->name('listcolor');
            Route::get('/searchcolor', [ColorController::class, 'getSearchColor'])->name('searchcolor');
        });
        //admin/comment
        Route::prefix('/comment')->group(function () {
            Route::get('/list', [CommentController::class, 'show'])->name('listcomment');
            Route::get('/delete/{id}', [CommentController::class, 'destroy'])->name('comment.delete');
            Route::get('/searchcomment', [CommentController::class, 'getSearchComment'])->name('searchcomment');
        });
        //admin/feedback
        Route::prefix('/feedback')->group(function () {
            Route::get('/list', [FeedBackController::class, 'show'])->name('listfeedback');
            Route::get('/delete/{id}', [FeedBackController::class, 'destroy'])->name('feedback.delete');
            Route::get('/searchfeedback', [FeedBackController::class, 'getSearchFeedback'])->name('searchfeedback');
        });

    });
});

//Product


require __DIR__ . '/auth.php';
