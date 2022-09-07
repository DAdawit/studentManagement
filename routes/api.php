<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StaticsController;


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

Route::middleware('auth:sanctum')->get('/user',function(Request $request){
   return $request->user();
});

Route::resource('sections',SectionController::class);
Route::get('/allsectionStudents',[SectionController::class,'allSectionStudent']);
Route::get('/sectionStudents/{id}',[SectionController::class,'SectionStudents']);
Route::get('/teacherStudents/{user}',[UserController::class,'teacherStudents']);
Route::get('/teacherCourses/{user}',[UserController::class,'teacherCourses']);
Route::get('/search/{search}',[StudentController::class,'searchStudent']);
Route::get('/searchUser/{search}',[AuthController::class,'searchUser']);


Route::resource('students',StudentController::class);
Route::resource('courses',CourseController::class);
Route::get('/courseTeachers/{course}',[CourseController::class,'courseTeachers']);

Route::post('/register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::post('/logout',[Authcontroller::class,'logout']);
Route::post('/verifyToken',[AuthController::class,'verifyToken']);
Route::get('/allUsers',[AuthController::class,'allUsers']);
Route::get('/getUser/{user}',[AuthController::class,'getUser']);
Route::post('/resetPassword',[AuthController::class,'resetPassword']);
Route::post('/changePassword',[AuthController::class,'changePassword']);
Route::delete('/user/{user}',[UserController::class,'deleteUser']);
Route::patch('/editUser/{user}',[UserController::class,'update']);

Route::get('/numberOfUser',[StaticsController::class,'numberOfUser']);
Route::get('/numberOfStudents',[StaticsController::class,'numberOfStudents']);
Route::get('/numberOfCourse',[StaticsController::class,'numberOfCourse']);


