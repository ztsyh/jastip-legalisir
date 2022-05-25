<?php

namespace App\Models\Master;

use App\Models\Pivot\Master\AdminUniversity;
use App\Traits\HasTable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;


class Admin extends Authenticatable
{
    use HasFactory, HasTable;

    protected $table = 'm_admins';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @param $value
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }

//    protected static function boot()
//    {
//        parent::boot(); // TODO: Change the autogenerated stub
//
//
//        static::saving(function (self $admin) {
//            $passwordHashed = Hash::make($admin->password);
//            $admin->setAttribute('password', $passwordHashed);
//        });
//    }

    public function universities(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(University::class, AdminUniversity::getTableName())->using(AdminUniversity::class);
    }
}
