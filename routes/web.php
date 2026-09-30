<?php

use App\Http\Controllers\AdvisorController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\WelcomeController;
use Illuminate\Support\Facades\Route;

Route::get('/article', [ArticleController::class, 'index'])->name('article');
Route::get('/articles', [ArticleController::class, 'index'])->name('articles');
Route::get('/advisor', [AdvisorController::class, 'show'])->name('advisor')
    ->middleware('check-age');

Route::get('/acces-refuse', function () {
    return view('acces-refuse');
})->name('acces-refuse');
Route::get('/', function () {
    return view('welcome');
});

Route::get('/welcome',
    [WelcomeController::class, 'index']);

Route::middleware('web')->group(function () {
    //
    //
    //

});
Route::get('/about/{p}', [WelcomeController::class, 'about']);

Route::get('/home/{name}', function ($name) {
    echo 'Hello'.$name;
})->name('home')
    ->where('name', '[A-Za-z]+');

/*$tab= ["name"=> "Med", "age"=>15, "adresse"=>"Ariana"];
$tab =['a',"merci", 12] ;*/
