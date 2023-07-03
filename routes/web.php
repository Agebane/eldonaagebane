<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;


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

//Route::get('/', function () {
 //   return view('front.pages.example');
//});
Route::view('/','front.pages.home')->name('home');

Route::get( '/article',[BlogController::class,'readPost'])->name('read_post');
Route::get('/categoria/{any}',[BlogController::class,'categoriaPost'])->name('categoria_posts');
Route::get('/posts/tag/{any}',[BlogController::class,'tagPosts'])->name('tag_posts');
Route::get('/search',[BlogController::class,'searchBlog'])->name('search_posts');
Route::get('/ver-post',[AuthorController::class,'verPost'])->name('ver-post');








