<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Middleware\DataParser;
use App\Http\Middleware\Validations;
use App\Http\Middleware\Validations\Requests;

use App\Http\Controllers\PeopleController;
use App\Http\Controllers\ConfigController;


Route::prefix('people')->middleware([
    DataParser::class,
])->group(function () {
    Route::middleware([
        Requests\PeopleValidation\Create::class
    ])
    ->post('/', [PeopleController::class, 'create']);

    Route::middleware([
        Requests\PeopleValidation\Find::class
    ])->delete('/{id}',  [PeopleController::class, 'destroy']);

    Route::middleware([
        Validations\Requests\Pagination::class,
    ])->get('/',  [PeopleController::class, 'index']);

    Route::middleware([
        Requests\PeopleValidation\Find::class
    ])->get('/{id}',  [PeopleController::class, 'show']);

    Route::middleware([
        Requests\PeopleValidation\Find::class,
        Requests\PeopleValidation\Update::class,
    ])
    ->put('/{id}', [PeopleController::class, 'update']);
});

Route::prefix('config')->middleware([
    DataParser::class,
])->group(function () {
    Route::get('/',  [ConfigController::class, 'index']);
});
