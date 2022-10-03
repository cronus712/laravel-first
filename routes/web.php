<?php

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

Route::get('/', function () {
    return view('posts');
});

Route::get('/posts/{post}', function ($post) {

    if(!file_exists($path = __DIR__ . "/../resources/posts/{$post}.html")) {
        return redirect('/');
    }

    $post = cache()->remember("posts.{$post}",3600,fn() => file_get_contents($path));
    
    return view('post', [
        'post' => $post
    ]);
});