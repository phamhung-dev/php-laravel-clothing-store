<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleUser extends Model
{
    use HasFactory;

    protected $primaryKey = ['user_id', 'role_id'];
    public $incrementing = false;

    protected $dateFormat = 'Y-m-d';
    protected $fillable = ['user_id', 'role_id'];

    // get user associated
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // get role associated
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
