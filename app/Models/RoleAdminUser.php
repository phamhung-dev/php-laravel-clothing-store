<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleAdminUser extends Model
{
    use HasFactory;

    protected $primaryKey = ['admin_user_id', 'role_id'];
    public $incrementing = false;

    protected $dateFormat = 'Y-m-d';
    protected $fillable = ['admin_user_id', 'role_id'];

    // get admin user associated
    public function adminUser()
    {
        return $this->belongsTo(AdminUser::class);
    }

    // get role associated
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
