<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\People;


class PeopleController extends Controller
{
    public function index(Request $request)
    {
        $query = $request['query'];

        $page = $query['page'];
        $per_page = $query['per_page'];

        $people = new People();

        $people = $people->paginate(
            $per_page, // per page (may be get it from request)
            ['*'], // columns to select from table (default *, means all fields)
            'page', // page name that holds the page number in the query string
            $page // current page, default 1
        );

        return response()->json([
            'data' => $people,
        ]);
    }

    public function create(Request $request)
    {
        $body = $request['body'];

        $people = People::create($body);

        return response()->json([
            'message' => 'People created successfully',
            'people' => $people,
        ]);
    }

    public function show(Request $request)
    {
        $parameters = $request['parameters'];

        $id = $parameters['id'];

        $people = People::find($id);

        return response()->json([
            'message' => 'People found successfully',
            'people' => $people,
        ]);
    }

    public function update(Request $request)
    {
        $parameters = $request['parameters'];
        $body = $request['body'];

        $id = $parameters['id'];

        $people = People::find($id);

        $people->update($body);

        return response()->json([
            'message' => 'People updated successfully',
            'people' => $people,
        ]);
    }

    public function destroy(Request $request)
    {
        $parameters = $request['parameters'];
        $id = $parameters['id'];

        $people = People::find($id);
        $people->delete();

        return response()->json([
            'message' => 'People deleted successfully',
        ]);
    }
}
