<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MovCatController;


Route::post("register_admin",[AuthController::class,"register"]);
Route::get("/get_user",[AuthController::class,"getUser"]);
Route::get("/get_detail_user/{id}",[AuthController::class,"getDetailUser"]);
Route::put("/update_user/{id}",[AuthController::class,"update_user"]);
Route::delete("/hapus_user/{id}",[AuthController::class,"hapus_user"]);
Route::post("add_movies",[MovCatController::class,"movies"]);
Route::get("/get_movies",[MovCatController::class,"getMovies"]);
Route::get("/get_detail_movies/{id}",[MovCatController::class,"getDetailMovies"]);
Route::put("/update_movies/{id}",[MovCatController::class,"update_movies"]);
Route::delete("/hapus_movies/{id}",[MovCatController::class,"hapus_movies"]);
Route::post("add_category",[CategoryController::class,"category"]);
Route::get("/get_category",[CategoryController::class,"getCategory"]);
Route::get("/get_detail_category/{id}",[CategoryController::class,"getDetailCategory"]);
Route::put("/update_category/{id}",[CategoryController::class,"update_category"]);
Route::delete("/hapus_category/{id}",[CategoryController::class,"hapus_category"]);
Route::post("/login",[AuthController::class,"login"]);
Route::get("/logout",[AuthController::class,"logout"]);


Route::middleware('auth:sanctum')->get('/user', function (Request $request)
 {
    return $request->user();
});