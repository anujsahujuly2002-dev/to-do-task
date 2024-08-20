<?php

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

/* Route::namespace('Auth')->middleware(['guest'])->controller(AuthController::class)->group(function() {
    Route::get('/','login')->name('login');
    Route::post('/do-login','doLogin')->name('do.login');
}); */
/* Route::middleware(['auth'])->group(function() {
     // DashBoard Route
     Route::controller(DashBoardController::class)->group(function() {
        Route::get('/dashboard','dashboard')->name('dashboard');
        Route::get('/logout','logout')->name('logout');
    }); */

    // User Management Routes
/*     Route::controller(UserManagementController::class)->prefix('user-management')->name('user.management.')->group(function() {
        Route::get('/','index')->name('index');
        Route::get('/create','create')->name('create');
        Route::post('/store','store')->name('store');
        Route::get('/get-users','getUsers')->name('get.users');
        Route::get('/edit/{id?}','edit')->name('edit.users');
    }); */

    // To Do List Routes
    Route::controller(ToDoController::class)->name('to.do.list.')->group(function(){
        Route::get('/','index')->name('index'); 
        Route::post('/store','store')->name('store');
        Route::get('/get-to-do','getToDo')->name('get.to.do');
        Route::post('/edit','edit')->name('edit');
        Route::post('/delete','delete')->name('delete');
    });

    // Hotel Management Route
  /*   Route::controller(HotelManagementController::class)->prefix('hotel-management')->name('hotel.management.')->group(function(){
        Route::get('/','index')->name('index');
        Route::get('/create','create')->name('create');
        Route::post('/store','store')->name('store');
        Route::get('/get-hotel','getHotel')->name('get.hotel');
        Route::post('/delete','delete')->name('delete');
        Route::get('/edit/{id?}','edit')->name('edit');
        Route::post('/update','update')->name('update');
    }); */

    // Room Mangement Route
   /*  Route::controller(RoomController::class)->prefix('room-management')->name('room.management.')->group(function() {
        Route::get('/','index')->name('index');
        Route::get('/create','create')->name('create');
    }); */
/* });
 */