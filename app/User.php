<?php

namespace App;

use App\Helpers\Helper;
use Carbon\Carbon;
use DateTimeInterface;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{

    use SoftDeletes, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function getIsAdminAttribute()
    {
        return $this->roles()->where('id', 1)->exists();
    }

    public function getEmailVerifiedAtAttribute($value)
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setEmailVerifiedAtAttribute($value)
    {
        $this->attributes['email_verified_at'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    public function setPasswordAttribute($input)
    {
        if ($input) {
            $this->attributes['password'] = app('hash')->needsRehash($input) ? Hash::make($input) : $input;
        }
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function isAdmin(){
        if (Auth::check()){
            if (Helper::checkRole(Auth::user()->id) == 1){
                return true;
            }
            return false;
        }
        return false;
    }
    public function isTeacher(){
        if (Auth::check()){
            if (Helper::checkRole(Auth::user()->id) == 2){
                return true;
            }
            return false;
        }
        return false;
    }
    public function isStudent(){
        if (Auth::check()){
            if (Helper::checkRole(Auth::user()->id) == 3){
                return true;
            }
            return false;
        }
        return false;
    }

    public function posts() {

        return $this->hasMany(Post::class);

    }

    public function answers() {
        return $this->hasOne(Answer::class);
    }

    public function topic() {
        return $this->belongsToMany(Topic::class,'topic_user')
            ->withPivot('amount','transaction_id','status')
            ->withTimestamps();
    }
}
