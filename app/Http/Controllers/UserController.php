<?php

namespace App\Http\Controllers;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function teacherStudents(User $user){
        $data = User::find($user->id)->students;
        $response = [
            'teacher'=>$user,
            'students'=>$data
        ];
        return response($response);
    }

    public function teacherCourses(User $user){
        $data = User::find($user->id)->courses;
        $response = [
          'teacher'=>$user,
          'courses'=>$data
        ];
        return response($response);
    }


}
