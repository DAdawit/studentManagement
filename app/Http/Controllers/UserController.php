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
    public function update(Request $request,User $user){
        if($user->email == $request['email']){
            $user->update($request->all());
            return response()->json(['data'=>'user updated'],202);
        }else{
            $request->validate([
                'email'=>'required|string|unique:users,email',
            ]);
            $user->update($request->all());
            return response()->json(['data'=>'user updated'],202);
        }


    }
public function deleteUser(User $user){
         $user->delete();
        return response()->json(['data'=>'user deleted'],204);
}

}
