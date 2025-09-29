<?php

namespace App\Http\Controllers;

use App\Models\Freelancer;
use Illuminate\Http\Request;

class FreelancerController extends Controller
{
    // Show all freelancers
    public function index()
    {
        $freelancers = Freelancer::where('status', 'active')->latest()->paginate(12);
        return view('freelancers.index', compact('freelancers'));
    }

    // Show a single freelancer
    public function show(Freelancer $freelancer)
    {
            if ($freelancer->status !== 'active') {
                return redirect()->route('freelancers.index')->with('error', 'Freelancer not found or inactive.');
            }
        return view('freelancers.show', compact('freelancer'));
    }
}
