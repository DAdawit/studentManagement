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
    ];
    public function Section(){
        return $this->hasOne(Section::class);
    }
}
