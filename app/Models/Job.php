<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Job extends Model
{
    use HasFactory;
    protected $table = 'job_listings';
    protected $with = ['company'];


    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function applicants()
    {
        return $this->hasMany(Applicant::class);
    }
}
