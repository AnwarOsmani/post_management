<?php

namespace App\Http\Controllers;

use App\Models\PostalCode;
use Illuminate\Http\Request;
use Validator;

class PostalCodeController extends Controller
{
    // AJAX endpoint to search postal codes
    public function search(Request $request)
    {

        $query = $request->input('query');
        if (!$query) {
            return redirect()->intended(route('welcome', absolute: false));
        }
        // Validate the postal code input before querying the database
        $validator = Validator::make($request->all(), [
            'query' => 'numeric'
        ]);
        // If validation fails, redirect back with an error message in the session
        if ($validator->fails()) {
            return;
        }

        // Fetch up to 5 postal codes that match the query (search by postal code or district)
        $results = PostalCode::where('postal_code', 'like', "{$query}%")
            // ->orWhere('district', 'like', "%{$query}%")
            ->take(5)  // Limit the results to 5
            ->get(['postal_code', 'district', 'post_office', 'province']);

        return response()->json($results);
    }
}