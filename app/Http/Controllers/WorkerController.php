<?php

namespace App\Http\Controllers;

use App\Models\DeliveryRequest;
use Illuminate\Support\Facades\Auth;

class WorkerController extends Controller
{
    // Display requests assigned to the worker
    public function dashboard()
    {
        $worker = Auth::user()->worker;
        $requests = DeliveryRequest::where('assigned_worker', $worker->id)->get();

        return view('users.worker.dashboard', compact('requests'));
    }
}
