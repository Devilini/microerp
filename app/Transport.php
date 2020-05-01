<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class Transport extends Model
{
    protected $fillable = [
        'name', 'color', 'year', 'status', 'type_id'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function type()
    {
        return $this->belongsTo(TransportType::class,'type_id','id','type');
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

    public static function validate($request)
    {
        $rules = [
            'name' => 'required|string|max:100',
            'color' => 'nullable|string|max:25',
            'year' => 'nullable|integer',
            'status' => 'nullable',
            'type_id' => 'required'
        ];

        $customMessages = [
            'name.required' => 'Поле Название обязательно для заполнения!',
            'name.max' => 'Поле Название должно иметь не более 100 символов',
            'type_id.required' => 'Поле Тип обязательно для заполнения!',
            'color.max' => 'Поле Цвет должно иметь не более 25 символов!',
            'year.integer' => 'Поле Год должно состоять из цифр!'
        ];

        $request->validate($rules, $customMessages);
    }

    public function add($fields)
    {
        $this->fill($fields);
        $this->save();
    }

    public function edit($fields)
    {
        $this->fill($fields);
        $this->update();
    }

    public static function getEnumValues($table, $column)
    {
        $type = DB::select(DB::raw("SHOW COLUMNS FROM $table WHERE Field = '{$column}'"))[0]->Type;
        preg_match('/^enum\((.*)\)$/', $type, $matches);
        $enum = array();
        foreach (explode(',', $matches[1]) as $value) {
            $v = trim($value, "'");
            $enum = Arr::add($enum, $v, $v);
        }
        return $enum;
    }

}
