<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $validated = $request->validate([
    'content' => 'required|string|max:1000',
    'parent_id' => 'nullable|exists:comments,id',
]);

$comment = new Comment();
$comment->content = $validated['content'];
$comment->user_id = auth()->id();
$comment->product_id = $product->id;
$comment->parent_id = $validated['parent_id'] ?? null;
$comment->save();


        return redirect()->back()->with('success', 'Comment posted.');
    }
}
