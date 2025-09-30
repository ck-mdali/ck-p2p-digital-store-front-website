<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Comment;
use App\Models\Order;

class ProductController extends Controller
{
     /**
     * Display a paginated list of all products.
     */
    // public function archive(Request $request)
    // {
    //     // Retrieve all products under this category, paginated
    //     $products = Product::paginate(12);

    //     $categories = Category::all();

    //     // Pass the category and products to the view
    //     return view('products.archive', compact('products', 'categories'));
    // }
    public function archive(Request $request)
    {
        // Get the search query from the request
        $search = $request->input('search');
        $is_search = false;

        // If there's a search query, filter the products
        if ($search) {
            $is_search = true;
            $products = Product::where('name', 'like', '%' . $search . '%')
                            ->orWhere('description_lt', 'like', '%' . $search . '%')
                            ->paginate(12);
        } else {
            if($request->type && $request->type == 'best-selling'){
                $products = Product::where('status', 'published')->where('featured', 1)->paginate(12);
            } else {
                $products = Product::where('status', 'published')->paginate(12);
            }
        }

        $categories = Category::all();

        // Pass the search query, categories, and products to the view
        return view('products.archive', compact('products', 'categories', 'search', 'is_search'));
    }

    /**
     * Display the product page based on category slug and product slug.
     */
    public function show($category_slug, $product_slug)
    {
        // First, try to find the category by its slug.
        $category = Category::where('slug', $category_slug)->first();

        // If the category is not found, redirect to a 404 page.
        if (!$category) {
            return redirect()->route('404');
        }

        // Find the product by slug and category_id (making sure the product belongs to the found category).
        $product = Product::where('slug', $product_slug)
                          ->where('category_id', $category->id)
                          ->first();

        // If the product is not found, redirect to a 404 page.
        if (!$product) {
            return redirect()->route('404');
        }

        $comments = Comment::where('product_id', $product->id)
                           ->whereNull('parent_id')
                           ->with('replies.user', 'user')
                           ->latest()
                           ->paginate(6);
        $user = auth()->user();

        // check if user has already a completed order for this product
        if ($user) {
            $purchased = Order::where('user_id', $user->id)
                                    ->where('product_id', $product->id)
                                    ->whereIn('status', ['new', 'pending', 'completed']) // Adjust statuses as needed
                                    ->exists();
        } else {
            $purchased = false;
        }

        // Return the product view with the product data.
        return view('products.show', compact('product', 'comments', 'user', 'purchased'));
    }

    public function archiveCategory($category_slug, Request $request)
    {
        // Find the category by its slug
        $category = Category::where('slug', $category_slug)->first();

        // If the category is not found, redirect to a 404 page
        if (!$category) {
            return redirect()->route('404');
        }

        // Retrieve all products under this category, paginated
        $products = $category->products()->paginate(12);

        $categories = Category::all();

        // Pass the category and products to the view
        return view('products.archive', compact('category', 'products', 'categories'));
    }
}
