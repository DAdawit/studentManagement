<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::group(['middleware'=>['auth:sanctum']],function(){
//     Route::get('/',function())
// });

Route::resource('sections',SectionController::class);
Route::get('/allsectionStudents',[SectionController::class,'allSectionStudent']);
Route::get('/sectionStudents/{id}',[SectionController::class,'SectionStudents']);
Route::get('/teacherStudents/{user}',[UserController::class,'teacherStudents']);
Route::get('/teacherCourses/{user}',[UserController::class,'teacherCourses']);

Route::resource('students',StudentController::class);
Route::resource('courses',CourseController::class);
Route::get('/courseTeachers/{course}',[CourseController::class,'courseTeachers']);

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[Authcontroller::class,'logout']);
Route::post('/verifyToken',[AuthController::class,'verifyToken']);
