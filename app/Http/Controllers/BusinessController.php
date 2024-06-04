<?php

namespace App\Http\Controllers;

use App\Models\BusinessUser;
use Illuminate\Http\Request;
use App\Models\Business;
use App\Models\User;

class BusinessController extends Controller
{
    public function index()
    {
        $businesses = Business::all();
        return response()->json($businesses);
    }

    public function myBusinesses(Request $request)
    {
        $user = auth()->user();

        $businesses = Business::whereHas('users', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->get();

        return response()->json($businesses);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $user = auth()->user();

        $business = Business::create($validatedData);
        $business->save();

        $user->currently_selected_business_id = $business->id;
        $user->save();
        $user->businesses()->attach($business);

        return response()->json($business, 201);
    }

    public function switchBusiness(Request $request){
        
        $business_id = $request->get('business_id');
        $user = auth()->user();

        $user->currently_selected_business_id = $business_id;
        $user->save();

        return response()->json("Success");

    }

    public function show($id)
    {
        $business = Business::findOrFail($id);
        return response()->json($business);
    }

    public function businessInfo(Request $request){
        $user = auth()->user();
        $business = Business::findOrFail($user->currently_selected_business_id);
        return response()->json($business);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $user = auth()->user();

        $business = Business::findOrFail($user->currently_selected_business_id);
        $business->update($validatedData);

        return response()->json($business, 200);
    }

    public function destroy($id)
    {
        $business = Business::findOrFail($id);
        $business->delete();

        return response()->json(null, 204);
    }

    public function businessMembers(Request $request)
    {

        $business_id = auth()->user()->currently_selected_business_id;
        $business_members = BusinessUser::with('user')->where('business_id', '=', $business_id)->get();

        return response()->json($business_members, 200);

    }

    public function addBusinessMember(Request $request)
    {

        $business_id = auth()->user()->currently_selected_business_id;
        $business = Business::findOrFail($business_id);
        
        $user_id = $request->get('user_id');
        $user = User::findOrFail($user_id);

        $user->businesses()->attach($business);

        $new_business_member = BusinessUser::with('user')->where('business_id', '=', $business_id)->where('user_id', '=', $user_id)->first();

        return response()->json($new_business_member, 200);

    }

    public function removeBusinessMember(Request $request)
    {

    
        $business_id = auth()->user()->currently_selected_business_id;
        $business = Business::findOrFail($business_id);
    
        $user_id = $request->get('user_id');
        $user = User::findOrFail($user_id);
    
        $business->users()->detach($user->id);
    
        return response()->json([
            'message' => 'User successfully removed from the business.',
        ], 200);
    }
    

}
