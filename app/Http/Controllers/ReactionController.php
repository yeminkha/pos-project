<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\reaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReactionController extends Controller
{
    public function reaction(Request $request){
        $validator = Validator::make($request->all(), [
            'rate' => 'required', // Validation rule for the "rate" field
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            // Redirect back with errors if validation fails
            return redirect()->back()->withErrors($validator)->withInput();
        };

        reaction::create([
            'user_id' => Auth::id(),
            'product_id'=> $request->productId,
            'rating_count' => $request->rate,
            'comment' => $request->comment
        ]);

        return redirect()->route('bookPage',$request->productId);

    }
}
