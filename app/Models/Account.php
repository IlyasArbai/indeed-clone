<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class Account extends Authenticatable
{
    use Notifiable;

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected $with = ['user', 'company', 'admin'];

    public function user()
    {
        return $this->hasOne(User::class, 'account_id');
    }
    public function company()
    {
        return $this->hasOne(Company::class, 'account_id');
    }
    public function admin()
    {
        return $this->hasOne(Admin::class, 'account_id');
    }

    public function getType(): ?string
    {
        if ($this->user) return 'user';
        if ($this->company) return 'company';
        if ($this->admin) return 'admin';

        return null;
    }

    public function isUser(): bool
    {
        return $this->user !== null;
    }
    public function isCompany(): bool
    {
        return $this->company !== null;
    }
    public function isAdmin(): bool
    {
        return $this->admin !== null;
    }

    public function getDataAttribute()
    {
        return $this->user
            ?? $this->company
            ?? $this->admin;
    }
}
