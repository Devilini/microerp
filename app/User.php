<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'is_admin', 'transport_id', 'password'
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

    public function transport()
    {
        return $this->belongsTo(Transport::class);
    }

    public function getCreatedAtAttribute($value)
    {
        $date = Carbon::parse($value);
        return $date->format('d.m.Y H:i');
    }

    public function setCreatedAtAttribute($value)
    {
        $this->attributes['created_at'] = Carbon::parse($value)->setTimezone('Europe/Moscow')->format('Y-m-d H:i:s');
    }

    public function setUpdatedAtAttribute($value)
    {
        $this->attributes['updated_at'] = Carbon::parse($value)->setTimezone('Europe/Moscow')->format('Y-m-d H:i:s');
    }

    public function generatePassword($password)
    {
        if ($password != null) {
            $this->password = Hash::make($password);
        } else {
            unset($this->attributes['password']);
        }
    }

    public function add($fields)
    {
        $this->fill($fields);
        $this->generatePassword($fields['password']);
        $this->save();
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this->generatePassword($fields['password']);
        $this->update();
    }

    public static function validate($request, $rules)
    {
        $messages = [
            'name.required' => 'Поле Имя обязательно для заполнения!',
            'name.max' => 'Поле Имя должно иметь не более 100 символов',
            'email.required' => 'Поле Email обязательно для заполнения!',
            'email.email' => 'Поле Email должно соответствовать эл.почте!',
            'email.unique' => 'Данный Email занят',
            'password.required' => 'Поле Пароль обязательно для заполнения!',
            'password.min' => 'Поле Пароль должно содержать минимум 8 символов',
        ];

        $validator = Validator::make($request, $rules, $messages);
        $validator->sometimes('password', 'min:8', function ($input) {
            return $input->password != null;
        })->validate();
    }

}
