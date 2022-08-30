<?php

namespace App\Http\Middleware\Validations\Requests\PeopleValidation;

use Closure;
use Illuminate\Http\Request;

use App\Services\Validator;
use App\Services\Response;

use App\Models\People;


class Update
{
    public function handle(Request $request, Closure $next)
    {
        $parameters = $request['parameters'];
        $id = $parameters['id'];

        $body = $request['body'];
        $body['id'] = $id;

        $validator = Validator::make($body, [
            'id' => ['required','integer','exists:people,id'],
            'name' => ['required', 'string', 'max:50'],
            'last_name' => ['required', 'string', 'max:50'],
            'type_document' => [
                'required',
                'integer',
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
                isset($id) ? 'iunique:people,email,'.$id :null,
            ],
            'gender' => [
                'required',
                'integer',
                'in:'.implode(",", array_keys(People::GENDER)),
            ],
            'birth_date' => ['required', 'date'],
            'city' => [
                'required',
                'integer',
                'in:'.implode(",", array_keys(People::CITIES)),
            ],
            'marital_status' => [
                'required',
                'integer',
                'in:'.implode(",", array_keys(People::MARITAL_STATUS)),
            ],
            'occupation' => [
                'required',
                'integer',
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
