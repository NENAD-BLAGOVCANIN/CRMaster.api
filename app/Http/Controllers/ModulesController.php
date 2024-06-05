<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Module;

class ModulesController extends Controller
{
    public function index()
    {

        $business_id = auth()->user()->currently_selected_business_id;

        $modules = Module::where('business_id', '=', $business_id)->get();
        return response()->json($modules);
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $business_id = auth()->user()->currently_selected_business_id;

        $name = $request->get('name');
        $description = $request->get('description');

        $module = new Module;
        $module->business_id = $business_id;
        $module->name = $name;
        $module->description = $description;
        $module->save();

        return response()->json($module);
    }

    public function show(Request $request, $module_id){

        $module = Module::findOrFail($module_id);
        return response()->json($module);
        
    }
    
}
