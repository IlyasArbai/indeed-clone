<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $keywords = strtolower(trim($request->input('q', '')));
        $location = strtolower(trim($request->input('l', '')));

        if (!$request->filled('l') && !$request->filled('q') && Auth::check() && Auth::user()->isUser()) {
            $location = Auth::user()->data->city;

            return redirect()->route('jobs.index', [
                'l' => $location,
                'q' => $keywords,
            ]);
        }

        $query = Job::query();

        if ($keywords) {
            $query->where(function ($q) use ($keywords) {
                $q->whereRaw('LOWER(title) LIKE ?', ["%{$keywords}%"])
                    ->orWhereRaw('LOWER(description) LIKE ?', ["%{$keywords}%"])
                    ->orWhereRaw('LOWER(job_type) LIKE ?', ["%{$keywords}%"]);
            });
        }

        if ($location) {
            $query->whereRaw('LOWER(city) LIKE ?', ["%{$location}%"]);
        }

        $jobs = ($keywords || $location)
            ? $query->paginate(9)->withQueryString()
            : collect();

        return view('jobs.index', compact('jobs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Job $job)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Job $job)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Job $job)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Job $job)
    {
        //
    }
}
