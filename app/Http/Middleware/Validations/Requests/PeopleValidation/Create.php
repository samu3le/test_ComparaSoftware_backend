<?php

namespace App\Http\Middleware\Validations\Requests\PeopleValidation;

use Closure;
use Illuminate\Http\Request;

use App\Services\Validator;
use App\Services\Response;

use App\Models\People;


class Create
{
    public function handle(Request $request, Closure $next)
    {
        $validator = Validator::make($request['body'], [
            'name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'type_document' => [
                'required',
                'string',
                'in:'.implode(",", array_keys(People::TYPE_DOCUMENT)),
            ],
            'document' => ['required', 'string', 'max:10'],
            'address' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:15'],
            'email' => [
                'required',
                'email',
                'min:6',
                'max:50',
                'iunique:people',
            ],
            'gender' => [
                'required',
                'string',
                'in:'.implode(",", array_keys(People::GENDER)),
            ],
            'birth_date' => ['required', 'date'],
            'city' => [
                'required',
                'string',
                'in:'.implode(",", array_keys(People::CITIES)),
            ],
            'marital_status' => [
                'required',
                'string',
                'in:'.implode(",", array_keys(People::MARITAL_STATUS)),
            ],
            'occupation' => [
                'required',
                'string',
                'in:'.implode(",", array_keys(People::OCCUPATIONS)),
            ],
            'area' => [
                'required',
                'string',
                'max:100',
            ],
            'salary' => [
                'required',
                'numeric',
                'between:0,100000000.00',
            ],
            'is_active' => [
                'boolean',
            ],
        ]);

        if($validator->fails()){
            return Response::UNPROCESSABLE_ENTITY(
                message: 'Validation failed.',
                errors: $validator->errors(),
            );
        }
        $request->merge([
            'body' => $validator->validated(),
        ]);

        return $next($request);
    }
}
