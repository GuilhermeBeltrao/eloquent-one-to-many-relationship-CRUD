<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Post;
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
    return view('welcome');
});



//CRUD One To Many

Route::get('/user/{user_id}/createpost/{title}/{body}', function ($user_id, $title, $body) {

    $user = User::findOrFail($user_id);

    $post = new Post(['title'=>$title, 'body'=>$body]);
    $user->posts()->save($post);
});

Route::get('/user/{user_id}/readposts', function($user_id){

    $user = User::FindOrFail($user_id);
    
    //dd($user->posts);
    return $user->posts;
});

Route::get('/user/{user_id}/updatepost/{post_id}/{title}/{body}', function ($user_id, $post_id, $title, $body) {

    $user = User::findOrFail($user_id);
    $user->posts()->whereId($post_id)->update(['title'=>$title, 'body'=>$body]);

});

Route::get('/user/{user_id}/deletepost/{post_id}', function($user_id, $post_id) {

    $user = User::findOrFail($user_id);
    $user->posts()->whereId($post_id)->delete();
});
