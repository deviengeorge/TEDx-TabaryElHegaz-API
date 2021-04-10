<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;
    protected $table = "forms";
    protected $primaryKey = "id";
    public $timestamps = false;
    protected $fillable = [
        "name",
        "end_date"
    ];

    public function questions()
    {
        return $this->belongsToMany(Question::class);
    }

    public function applicants()
    {
        return $this->hasMany(Applicant::class);
    }
}
