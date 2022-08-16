<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Section;


class Student extends Model
{
    use HasFactory;

//    protected $fillable=[
//        'course_id',
//        'student_id'
//    ];
        protected $fillable = [
        'fullName',
        'chName',
        'motherName',
        'phoneNumber',
        'birthDate',
        'city',
        'wereda',
        'kebele',
        'houseNumber',
        'sex',
        'schoolName',
        'grade',
        'section_id',
        'user_id',
        'password',
    ];
    public function Section(){
        return $this->belongsTo(Section::class);
    }
    public function courses(){
        return $this->belongsToMany(Course::class);
    }
}
