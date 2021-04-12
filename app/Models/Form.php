<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function requirements()
    {
        return $this->hasMany(Requirement::class);
    }

    public function responsibilities()
    {
        return $this->hasMany(Responsibility::class);
    }
}
