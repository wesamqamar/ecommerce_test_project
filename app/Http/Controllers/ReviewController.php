<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function addReviewToProduct(Request $request , Review $review)
    {
        $request->validate([
            'rating' => 'required',
            'comment' => 'required',
        ]);

        $review->user_id = auth()->user()->id;
        $review->product_id = $request->product_id;
        $review->rating = $request->rating;
        $review->comment = $request->comment;
        $review->save();

        session()->flash('success', 'Product Review Created Successfully');
        return redirect()->back();
    }

}
