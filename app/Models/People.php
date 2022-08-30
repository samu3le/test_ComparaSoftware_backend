<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class People extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_name',
        'type_document',
        'document',
        'address',
        'phone',
        'email',
        'gender',
        'birth_date',
        'city',
        'marital_status',
        'occupation',
        'area',
        'salary',
    ];

    const TYPE_DOCUMENT = [
        1 => 'CC',
        2 => 'Pasaporte',
    ];

    const GENDER = [
        1 => 'Masculino',
        2 => 'Femenino',
        3 => 'Prefiero no decirlo',
    ];

    const CITIES = [
        1 => 'Bogota',
        2 => 'Medellin',
        3 => 'Cali',
    ];

    const MARITAL_STATUS = [
        1 => 'Soltero',
        2 => 'Casado',
        3 => 'Divorciado',
        4 => 'Viudo',
    ];

    const OCCUPATIONS = [
        1 => 'Estudiante',
        2 => 'Trabajador',
        3 => 'Independiente',
        4 => 'Otro',
    ];
}
