<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Freelancer;

use App\Models\Product;
use Carbon\Carbon;
use App\Models\Banner;
use App\Models\Page;


class PageController extends Controller
{
    public function home()
{
    // Fetch latest products (e.g., products added in the last 30 days)
    $latestProducts = Product::where('created_at', '>=', Carbon::now()->subDays(30))
                            ->latest()
                            ->take(4)
                            ->get();

    // Fetch best selling products (this could be based on an attribute, or number of sales)
    // You could also make this dynamic based on a sales field if your products have one.
    $bestSellingProducts = Product::where('featured', 1) // Assuming you have sales_count
                                  ->take(4)
                                  ->get();
    $banners = Banner::where('status', 'active')->get();
    $freelancers = Freelancer::where('status', 'active')->latest()->take(4)->get();

    return view('welcome', compact('latestProducts', 'bestSellingProducts', 'banners', 'freelancers'));
}

    public function dynamicPage($slug)
    {

        $page = Page::where('slug', $slug)
                        ->where('is_public', true)
                        ->where('status', 'published')
                        ->firstOrFail();
        if(!$page) {
            return redirect()->route('404');
        }

            // Increment view count
            $page->increment('views');

            // Use template or fallback
            $view = $page->template ?? 'pages.default';

            return view('pages.default', compact('page'));
            
    }

}