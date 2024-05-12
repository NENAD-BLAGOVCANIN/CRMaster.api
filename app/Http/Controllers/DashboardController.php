<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Lead;
use App\Models\Task;
use App\Models\Contact;

class DashboardController extends Controller
{
    public function getStats(Request $request){

        $business_id = auth()->user()->currently_selected_business_id;

        $businessMemberCount = User::where('currently_selected_business_id', '=', $business_id)->count();
        $contactCount = Contact::where('business_id', '=', $business_id)->count();
        $leadCount = Lead::where('business_id', '=', $business_id)->count();
        $taskCount = Task::where('business_id', '=', $business_id)->count();
        $todoTasksCount = Task::where('business_id', '=', $business_id)->where('status', '=', Task::STATUS_TODO)->count();
        $inProgressTasksCount = Task::where('business_id', '=', $business_id)->where('status', '=', Task::STATUS_IN_PROGRESS)->count();
        $doneTasksCount = Task::where('business_id', '=', $business_id)->where('status', '=', Task::STATUS_DONE)->count();

        $data = [
            "businessMembersCount" => $businessMemberCount,
            "contactCount" => $contactCount,
            "leadCount" => $leadCount,
            "taskCount" => $taskCount,
            "todoTasksCount" => $todoTasksCount,
            "inProgressTasksCount" => $inProgressTasksCount,
            "doneTasksCount" => $doneTasksCount
        ];

        return response()->json($data);

    }
}
