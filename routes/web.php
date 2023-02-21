<?php

use App\Http\Controllers\DataController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TweetController;
use App\Http\Controllers\TweetsController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/signup', function () {
    return view('signup');
});

Route::get('/search', [SearchController::class, 'search'])->name('search')->middleware('login');

Route::get('/', [DataController::class, 'psignin'])->name('psignin');
Route::post('/register', [DataController::class, 'register'])->name('register');

Route::get('/home', [DataController::class, 'phome'])->name('phome')->middleware('login');

Route::get('/profile/{id}', [DataController::class, 'pprofile'])->name('pprofile')->middleware('login');

Route::get('/post/{id}', [TweetController::class, 'tweetpost'])->name('tweetpost')->middleware('login');
Route::get('/addpost', [DataController::class, 'paddpost'])->name('paddpost')->middleware('login');

Route::get('/editprofile/{id}', [ProfileController::class, 'editprofile'])->name('editprofile')->middleware('login');
Route::post('/updateprofile/{id}', [ProfileController::class, 'updateprofile'])->name('updateprofile')->middleware('login');

Route::post('/posttweets', [TweetsController::class, 'posttweets'])->name('posttweets')->middleware('login');
Route::get('/edittweets/{id}', [TweetsController::class, 'edittweets'])->name('edittweets')->middleware('login');
Route::post('/updatetweets/{id}', [TweetsController::class, 'updatetweets'])->name('updatetweets')->middleware('login');
Route::get('/destroytweets/{id}', [TweetsController::class, 'destroytweets'])->name('destroytweets')->middleware('login');

Route::get('/addcomment/{id}', [TweetController::class, 'addcomment'])->name('addcomment')->middleware('login');
Route::post('/postcomment', [TweetController::class, 'postcomment'])->name('postcomment')->middleware('login');
Route::get('/editcomment/{id}', [TweetController::class, 'editcomment'])->name('editcomment')->middleware('login');
Route::post('/updatecomment/{id}', [TweetController::class, 'updatecomment'])->name('updatecomment')->middleware('login');
Route::get('/destroycomment/{id}', [TweetController::class, 'destroycomment'])->name('destroycomment')->middleware('login');

Route::post('/login', [DataController::class, 'login'])->name('login');
Route::post('/logout', [DataController::class, 'logout'])->name('logout')->middleware('login');