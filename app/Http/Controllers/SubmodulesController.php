<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Submodule;

class SubmodulesController extends Controller
{
    public function index(Request $request, $module_id)
    {
        $submodules = Submodule::where('module_id', '=', $module_id)->get();
        return response()->json($submodules);
    }

    public function store(Request $request, $module_id)
    {

        $name = $request->get('name');
        $description = $request->get('description');

        $submodule = new Submodule;
        $submodule->module_id = $module_id;
        $submodule->name = $name;
        $submodule->description = $description;
        $submodule->save();

        return response()->json($submodule);
    }

    public function show(Request $request, $submodule_id){

        $submodule = Submodule::findOrFail($submodule_id);
        return response()->json($submodule);
        
    }
}
