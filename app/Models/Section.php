<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Student;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'name'
    ];

    public function Students(){
        return $this->hasMany(Student::class);
    }

}
