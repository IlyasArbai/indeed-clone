<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['name', 'phone', 'website', 'logo', 'description', 'account_id', 'status'])]
class Company extends Model
{
    use HasFactory;
    //

    protected function casts(): array
    {
        return [
            'verified_at' => 'datetime',
        ];
    }

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
