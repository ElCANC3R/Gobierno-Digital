<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * Class Role
 *
 * @property $id
 * @property $name
 * @property $slug
 * @property $description
 * @property $created_at
 * @property $updated_at
 *
 * @property RoleUser[] $roleUsers
 * @package App
 * @mixin \Illuminate\Database\Eloquent\Builder
 */
class Role extends Model
{

    protected $perPage = 20;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'slug', 'description'];


    /**
     * Relación uno a muchos con la tabla intermedia RoleUser.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function roleUsers(): HasMany
    {
        return $this->hasMany(\App\Models\RoleUser::class, 'role_id', 'id');
    }

    /**
     * Relación muchos a muchos con el modelo User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class)->withTimestamps();
    }

}
