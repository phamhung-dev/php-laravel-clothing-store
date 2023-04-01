<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    protected $dateFormat = 'Y-m-d';
    protected $fillable = ['name', 'description'];

    // get list role users
    public function roleUsers()
    {
        return $this->hasMany(RoleUser::class);
    }
}
