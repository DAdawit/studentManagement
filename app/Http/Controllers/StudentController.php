<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\CourseStudent;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            return Student::with('Section','courses')->get();
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
        return Student::find($student->id)->Section->course;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
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
         $request->validate([
            'name'=>'required',
            'middelName'=>'requ  ired',
            'lastName'=>'required',
            'email'=>'required|email',
            'section_id'=>'required',
            'phoneNumber'=>'required',
            'name'=>'required',
        ]);

       $data= Student::find($student);
       $data[0]->update($request->all());
       return $data;

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
        return $data[0]->delete();
    }
}
