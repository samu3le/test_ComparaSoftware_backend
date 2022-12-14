<?php

namespace App\Http\Middleware\Validations\Requests\UserValidation;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

use App\Services\Response;


class GetAll
{
    public function handle(Request $request, Closure $next)
    {
        $user = new User();

        $validator = Validator::make($request['query'], [
            'sort_by' => ['nullable', 'string', 'in:' . implode(',', $user->getFillable())],
            'sort' => ['nullable', 'string', 'in:asc,desc'],
        ]);

        if($validator->fails()){
            return Response::UNPROCESSABLE_ENTITY(
                message: 'Validation failed.',
                errors: $validator->errors(),
            );
        }

        $query = $request['query'];

        $query['page'] = $query['page'] ?? 1;
        $query['per_page'] = $query['per_page'] ?? 10;

        $request->merge([
            'query' => $query,
        ]);

        return $next($request);
    }
}
