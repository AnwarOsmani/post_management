<?php

// DeliveryRequestController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeliveryRequest;  // Assuming this model exists
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class DeliveryRequestController extends Controller
{
    public function create()
    {
        return view('delivery.create');
    }
    public function index()
    {
        $requests = Auth::user()->deliveryRequests;

        // $requests = DeliveryRequest::where('user_id', Auth::id())->get();
        return view('delivery.index', compact('requests'));
    }



    public function store(Request $request)
    {
        // Validate input fields
        $validated = $request->validate([
            'sender_name' => 'required|string|max:255',
            'sender_phone' => 'required|digits_between:10,15',
            'sender_postal_code' => 'required|exists:postal_codes,postal_code',
            'receiver_name' => 'required|string|max:255',
            'receiver_phone' => 'required|digits_between:10,15',
            'receiver_postal_code' => 'required|exists:postal_codes,postal_code',
        ]);

        // Save the delivery request
        DeliveryRequest::create([
            'sender_name' => $validated['sender_name'],
            'sender_phone' => $validated['sender_phone'],
            'sender_postal_code' => $validated['sender_postal_code'],
            'receiver_name' => $validated['receiver_name'],
            'receiver_phone' => $validated['receiver_phone'],
            'receiver_postal_code' => $validated['receiver_postal_code'],
            'user_id' => Auth::id(),  // Assuming the request is tied to the logged-in user
        ]);

        // Redirect or respond with success message
        return redirect()->route('delivery.request.index')->with('success', 'Delivery request created successfully.');
    }

    // Show the form for editing a specific delivery request
    public function edit($id)
    {
        // Use the relationship to find the delivery request
        $deliveryRequest = Auth::user()->deliveryRequests()->findOrFail($id);

        return view('delivery.edit', compact('deliveryRequest'));
    }

    // Update the delivery request
    public function update(Request $request, $id)
    {
        // Find the delivery request belonging to the authenticated user with the specified ID
        $deliveryRequest = Auth::user()->deliveryRequests()->where('id', $id)->firstOrFail();

        // Check if the status is "created"
        if ($deliveryRequest->status !== DeliveryRequest::STATUS_CREATED) {
            return redirect()->route('delivery.request.index');
        }
        // Validate the request input (status and user_id are not allowed to change)
        $validated = $request->validate([
            'sender_name' => 'required|string|max:255',
            'sender_phone' => 'required|digits_between:10,15',
            'sender_postal_code' => 'required|exists:postal_codes,postal_code',
            'receiver_name' => 'required|string|max:255',
            'receiver_phone' => 'required|digits_between:10,15',
            'receiver_postal_code' => 'required|exists:postal_codes,postal_code',
        ]);

        // Update the delivery request with the validated data
        $deliveryRequest->update($validated);

        return redirect()->route('delivery.request.index')->with('success', 'Delivery request updated successfully.');
    }
    public function destroy($id)
    {
        // Find the delivery request belonging to the authenticated user with the specified ID
        $deliveryRequest = Auth::user()->deliveryRequests()->where('id', $id)->firstOrFail();

        // Check if the status is "created"
        if ($deliveryRequest->status !== DeliveryRequest::STATUS_CREATED) {
            return redirect()->route('delivery.request.index');
        }

        // Delete the delivery request
        $deliveryRequest->delete();

        return redirect()->route('delivery.request.index')->with('success', 'Delivery request deleted successfully.');
    }

}
