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

    // Set the keys for a save update query
    protected function setKeysForSaveQuery($query)
    {
        $query->where('user_id', '=', $this->getAttribute('user_id'))
            ->where('role_id', '=', $this->getAttribute('role_id'));
        return $query;
    }

    // Get the primary key value for a save query.
    protected function getKeyForSaveQuery()
    {
        $keys = $this->getKeyName();
        if (!is_array($keys)) {
            return $this->getAttribute($keys);
        }
        foreach ($keys as $keyName) {
            if (is_null($this->getAttribute($keyName))) {
                return;
            }
        }
        return $keys;
    }
}
