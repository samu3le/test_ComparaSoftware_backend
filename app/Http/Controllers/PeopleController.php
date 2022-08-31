<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\People;

use App\Services\Response;


class PeopleController extends Controller
{
    public function index(Request $request)
    {
        $query = $request['query'];

        $page = $query['page'];
        $per_page = $query['per_page'];

        $people = new People();

        $people = $people->orderBy('created_at', 'ASC');
        $people = $people->paginate(
            $per_page, // per page (may be get it from request)
            ['*'], // columns to select from table (default *, means all fields)
            'page', // page name that holds the page number in the query string
            $page // current page, default 1
        );

        return Response::OK(
            data: [
                'people' => $people,
            ],
        );
    }

    public function create(Request $request)
    {
        $body = $request['body'];

        $people = People::create($body);

        return Response::CREATED(
            message: 'People created successfully',
            data: [
                'people' => $people,
            ]
        );
    }

    public function show(Request $request)
    {
        $instances = $request['instances'];

        $people = $instances['people'];

        return Response::OK(
            message: 'People found successfully.',
            data: [
                'people' => $people,
            ],
        );
    }

    public function update(Request $request)
    {
        $parameters = $request['parameters'];
        $body = $request['body'];

        $id = $parameters['id'];

        $people = People::find($id);

        $people->update($body);

        return Response::OK(
            message: 'People updated successfully.',
            data: [
                'people' => $people,
            ],
        );
    }

    public function destroy(Request $request)
    {
        $instances = $request['instances'];

        $people = $instances['people'];
        $people->delete();

        return Response::OK(
            message: 'People deleted successfully',
        );
    }
}
