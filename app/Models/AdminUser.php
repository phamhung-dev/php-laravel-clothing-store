<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminUser extends Model
{
    use HasFactory;

    protected $dateFormat = 'Y-m-d';
    protected $fillable = ['first_name', 'last_name', 'avatar', 'email', 'password', 'telephone', 'is_locked'];

    // get list role admin user record associated
    public function roleAdminUsers()
    {
        return $this->hasMany(RoleAdminUser::class);
    }

}
