<?php

namespace App\Http\Middleware\Validations\Requests\PeopleValidation;

use Closure;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\Services\Response;

use App\Models\People;


class Find
{
    public function handle(Request $request, Closure $next)
    {
        $parameters = $request['parameters'];

        $validator = Validator::make($parameters, [
            'id' => [
                'required',
                'integer',
                'exists:people,id',
            ],
        ]);

        if($validator->fails()){
            return Response::UNPROCESSABLE_ENTITY(
                message: 'Validation failed.',
                errors: $validator->errors(),
            );
        }

        $id = $parameters['id'];
        $people = People::find($id);

        $request->merge([
            'parameters' => $validator->validated(),
            'instances' => [
                'people' => $people,
            ],
        ]);

        return $next($request);
    }
}
