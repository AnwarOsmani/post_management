<?php
namespace App\Http\Controllers;

use App\Models\Package;
use Illuminate\Http\Request;

class BarcodeScanController extends Controller
{
    public function showScanForm()
    {
        return view('barcode.scan');
    }

    public function processScan(Request $request)
    {
        // Validate the request
        $request->validate(['barcode' => 'required|string|exists:packages,tracking_number']);

        // Find the delivery request by barcode
        // $deliveryRequest = DeliveryRequest::where('barcode', $request->barcode)->first();
        $package = Package::where('tracking_number', $request->barcode)->first();
        $deliveryRequest = $package->DeliveryRequest;

        // Get the next status
        $nextStatus = $deliveryRequest->getNextStatus();

        if ($nextStatus) {
            $deliveryRequest->status = $nextStatus;
            $deliveryRequest->save();

            return back()->with('success', 'Status updated to ' . $nextStatus);
        }

        return back()->with('error', 'The request is closed');
    }
}
