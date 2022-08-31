<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\People;

use App\Services\Response;


class ConfigController extends Controller
{
    public function index()
    {
        $data = [
            'type_documents' => People::TYPE_DOCUMENT,
            'gender' => People::GENDER,
            'cities' => People::CITIES,
            'marital_status' => People::MARITAL_STATUS,
            'occupations' => People::OCCUPATIONS,
        ];
        return Response::OK(
            data: $data,
        );
    }
}
