<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
    ];

    public function users(){
        return $this->hasMany(Course::class);
    }
    public function student(){
        return $this->belongsToMany(Student::class);
    }
}
