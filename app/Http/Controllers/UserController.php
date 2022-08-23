<?php

namespace App\Http\Controllers;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function teacherStudents(User $user){
        $students=Student::with('Section','courses')->where('user_id',$user->id)->paginate(15);

//        $students = user::find($user->id)->students;
        $courses = User::find($user->id)->courses;
        $studentsCount=count($students);
        $coursesCount = count($courses);
        $response = [
            'studentcount'=>$studentsCount,
            'coursesCount'=>$coursesCount,
            'courses'=>$courses,
            'students'=>$students
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
