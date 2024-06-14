<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Person;

class PeopleController extends Controller
{
    public function index()
    {
        $people = Person::all();
        return response()->json($people);
    }

    public function show($id)
    {
        $person = Person::find($id);
        if (!$person) {
            return response()->json(['message' => 'Person not found'], 404);
        }
        return response()->json($person);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'comments' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $person = Person::create($request->all());
        return response()->json($person, 201);
    }

    public function update(Request $request, $id)
    {
        $person = Person::find($id);
        if (!$person) {
            return response()->json(['message' => 'Person not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'comments' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $person->update($request->all());
        return response()->json($person);
    }

    public function destroy($id)
    {
        $person = Person::find($id);
        if (!$person) {
            return response()->json(['message' => 'Person not found'], 404);
        }

        $person->delete();
        return response()->json(['message' => 'Person deleted successfully']);
    }
}
