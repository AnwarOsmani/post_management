<?php

namespace App\Http\Controllers;

use App\Models\DeliveryRequest;
use App\Models\Package;
use App\Models\Request;
use Illuminate\Http\Request as HttpRequest;
use Picqer\Barcode\BarcodeGeneratorPNG;

class PackageController extends Controller
{
    public function track(HttpRequest $request)
    {
        $trackingNumber = $request->input('tracking_number');

        // Validate tracking number format
        if (!$trackingNumber || !preg_match('/^PKG-[A-Z0-9]{13}$/', $trackingNumber)) {
            return redirect()->route('welcome')->with('error', 'The tracking code format is incorrect. 
            Please use a valid format, e.g., PKG-671EE285D05FA.');
        }

        // Find package by tracking number
        $package = Package::where('tracking_number', $trackingNumber)->first();

        if (!$package) {
            return redirect()->route('welcome')->with('error', 'Package not found.');
        }

        // Retrieve related delivery request for status and creation date
        $deliveryRequest = $package->deliveryRequest;

        return view('welcome', [
            'package' => $package,
            'status' => $deliveryRequest->getStatusLabel(),
            'created_at' => $deliveryRequest->created_at,
        ]);
    }



    public function show(Package $package)
    {
        $request = $package->deliveryRequest;
        // Generate a barcode for the package's tracking number
        $generator = new BarcodeGeneratorPNG();
        $barcode = base64_encode($generator->getBarcode($package->tracking_number, $generator::TYPE_CODE_128));

        return view('packages.show', compact('package', 'request', 'barcode'));

    }
    // Show the form for creating a package
    public function create($requestId)
    {
        $deliveryRequest = DeliveryRequest::findOrFail($requestId);
        return view('packages.create', compact('deliveryRequest'));
    }

    // Store the package information and update request status
    public function store(HttpRequest $request, $requestId)
    {
        $request->validate([
            'weight' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        // Check if a package with the same request_id already exists
        $existingPackage = Package::where('request_id', $requestId)->first();
        if ($existingPackage) {
            return redirect()->route('package.show', $existingPackage->id)
                ->withErrors('A package for this request already exists.');
        }

        $trackingNumber = 'PKG-' . strtoupper(uniqid());

        $package = Package::create([
            'request_id' => $requestId,
            'weight' => $request->weight,
            'price' => $request->price,
            'tracking_number' => $trackingNumber,
        ]);

        // Retrieve the related DeliveryRequest model and update its status
        $deliveryRequest = $package->deliveryRequest();
        if ($deliveryRequest) {
            $deliveryRequest->update(['status' => DeliveryRequest::STATUS_IN_POST_OFFICE]);
        }

        return redirect()->route('package.show', $package->id);
    }

}
