<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Student;


class StaticsController extends Controller
{
    public function numberOfUser(){
        $users = User::count()-1;
        return $users;
    }

    public function numberOfStudents(){
        $students = Student::count();
        return $students;
    }
    public function numberOfCourse(){
        $course = Course::count();
        return $course;
    }
}
