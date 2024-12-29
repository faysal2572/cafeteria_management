<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;

route::get("/",[HomeController::class,'my_home']);

Route::get('/home',[HomeController::class,'index']);

Route::get('/add_food',[AdminController::class,'add_food']);
Route::post('/upload_food',[AdminController::class,'upload_food']);
Route::get('/view_food',[AdminController::class,'view_food']);

Route::post('/confirm order',[HomeController::class,'confirm_order']);

Route::get('/orders',[AdminController::class,'orders']);

Route::get('/on_the_way/{id}',[AdminController::class,'on_the_way']);

Route::get('/delivered/{id}',[AdminController::class,'delivered']);

Route::get('/canceled/{id}',[AdminController::class,'canceled']);

Route::get('/delete_food/{id}',[AdminController::class,'delete_food']);
Route::get('/update_food/{id}',[AdminController::class,'update_food']);
Route::post('/edit_food/{id}',[AdminController::class,'edit_food']);
Route::post('/add_cart/{id}',[HomeController::class,'add_cart']);
Route::get('/my_cart',[HomeController::class,'my_cart']);
<<<<<<< HEAD
Route::get('/remove_cart/{id}',[HomeController::class,'remove_cart']);
// Route::get('/homee',[HomeController::class,'my_home']);



=======
#Route::get('/home',[HomeController::class,'home']);

Route::get('/orders',[AdminController::class,'orders']);
>>>>>>> 460007371d0d0deee0347ab3ba480b48ee316e50


Route::post('/book_table',[HomeController::class,'book_table']);

Route::get('/reservations',[AdminControllerr::class,'reservations']);




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
