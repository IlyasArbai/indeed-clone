<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'last_name', 'avatar', 'city', 'phone', 'resume', 'bio', 'account_id', 'photo'])]
#[Hidden(['status'])]
class User extends Model
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $with = ['applicants'];


    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function applicants()
    {
        return $this->hasMany(Applicant::class);
    }
}
