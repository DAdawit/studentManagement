<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Section;


class Student extends Model
{
    use HasFactory;
        protected $fillable = [
        'name',
        'middelName',
        'lastName',
        'email',
        'section_id',
        'phoneNumber',
        'user_id',
        'password',
        'course_id'
    ];
    public function Section(){
        return $this->belongsTo(Section::class);
    }
    public function user(){

    }
}
