<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BbsController;
use App\Http\Controllers\Bbs_commentController;

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
Route::group(['middleware' => ['guest']],function () {
    
    Route::get('/', [AuthController::class,'showLogin'])->name('login.show');

    Route::post('login',[AuthController::class,'login'])->name('login');
    
});

Route::group(['middleware' => ['auth']],function (){
    //home
    // Route::get('account_index',function(){
    //     return view('account_index');
    // })->name('account_index');

    Route::get('home',function(){
        return view('home');
    })->name('home');
    
    /*掲示板*/
    
    //BBSTOP画面
    Route::get('/bbs/top', [BbsController::class,'top'])->name('bbs_top');

    //BBS一覧画面
    Route::get('/bbs/index', [BbsController::class,'index'])->name('bbs_index');

    //BBS登録画面
    Route::get('/bbs/create', [BbsController::class,'create'])->name('bbs_create');
    
    //BBS登録
    Route::post('/bbs/store', [BbsController::class,'store'])->name('bbs_store');

    //BBS詳細画面
    Route::get('/bbs/{id}', [BbsController::class,'detail'])->name('bbs_detail');

    //BBS編集画面
    Route::get('/bbs/edit/{id}', [BbsController::class,'edit'])->name('bbs_edit');

    //BBS更新
    Route::post('/bbs/update', [BbsController::class,'update'])->name('bbs_update');

    //BBS削除
    Route::post('/bbs/delete/{id}', [BbsController::class,'delete'])->name('bbs_delete');

    //BBSCOMMENT削除
    Route::post('/bbs/delete/comment/{id}', [BbsController::class,'delete_comment'])->name('bbs_delete_comment');
    
    /*コメント*/

    //BBS登録
    Route::post('/bbs/store/comment', [BbsController::class,'comment_store'])->name('bbs_comment_store');

    //BBSTOP画面
    //Route::get('/bbs/top', [Bbs_commentController::class,'top'])->name('bbs_top');



    /*アカウント*/

    //ログアウト
    Route::post('logout',[AuthController::class,'logout'])->name('logout');

    //アカウント一覧画面
    Route::get('/account/index', [UserController::class,'index'])->name('account_index');

    //アカウント登録画面
    Route::get('/account/create', [UserController::class,'create'])->name('account_create');
    
    //アカウント登録
    Route::post('/account/store', [UserController::class,'store'])->name('account_store');

    //アカウント詳細画面
    Route::get('/account/{id}', [UserController::class,'detail'])->name('account_detail');

    //アカウント編集画面
    Route::get('/account/edit/{id}', [UserController::class,'edit'])->name('account_edit');

    //アカウント更新
    Route::post('/account/update', [UserController::class,'update'])->name('account_upadte');

    //アカウント削除
    Route::post('/account/delete/{id}', [UserController::class,'delete'])->name('account_delete');
});

//Route::get('account_index', [UserController::class,'index'])->name('account_index');
//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
