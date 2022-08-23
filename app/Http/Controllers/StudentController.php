<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\CourseStudent;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            return Student::with('Section','courses')->paginate(10);
    }

    public function searchStudent($search){
            return Student::where('fullName','like','%'.$search.'%')->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'fullName'=>'required',
            'chName'=>'required',
            'motherName'=>'required',
            'phoneNumber'=>'required',
            'birthDate'=>'required',
            'city'=>'required',
            'wereda'=>'required',
            'kebele'=>'required',
            'houseNumber'=>'required',
            'sex'=>'required',
            'schoolName'=>'required',
            'grade'=>'required',
        ]);

        $student= Student::create($request->all());
        $course=$request['course_id'];

        $student->courses()->attach($course);

        return response()->json(['student'=>$student],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {

     return   Student::with('Section','courses')->where('id',$student->id)->first();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $users = DB::table('students')
            ->join('course_student', 'students.id', '=', 'course_student.user_id')
            ->where('course_student.student_id','=',$student->id)
            ->select('students.*', 'course_student.course_id')

            ->get();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
//        'fullName',
//        'chName',
//        'motherName',
//        'phoneNumber',
//        'birthDate',
//        'city',
//        'wereda',
//        'kebele',
//        'houseNumber',
//        'sex',
//        'schoolName',
//        'grade',
//        'section_id',
//        'user_id',
//        'password',
         $request->validate([
            'fullName'=>'required',
            'chName'=>'required',
            'motherName'=>'required',
            'phoneNumber'=>'required',
            'birthDate'=>'required',
            'sex'=>'required',
            'section_id'=>'required',
        ]);

       $data= Student::find($student->id);
       $data->update($request->all());
       $data->courses()->sync(['course_id'=>$request->course_id]);
        $res=   Student::with('Section','courses')->where('id',$student->id)->first();

        return response()->json(['data'=>$res],201);
//        return Student::;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $data= Student::find($student);
        $student->courses()->detach($student->id);
        return $data[0]->delete();
    }
}
