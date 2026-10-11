<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Account;
use App\Models\Applicant;
use App\Models\Job;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:30',
            'last_name'  => 'required|string|max:30',
            'phone'      => 'required|string|max:50|unique:users,phone',
            'city'       => 'required|string|max:30',
            'bio'        => 'nullable|string',

            'email'      => 'required|string|email|max:50|unique:accounts,email',
            'password'   => 'required|string|min:8|max:20|confirmed',

            'resume'     => 'required|file|mimes:pdf|max:5120',
            'photo'     => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $validatedData['resume'] = $request->file('resume')->store('resumes', 'public');
        if ($request->hasFile('photo')) {
            $validatedData['photo'] = $request->file('photo')->store('photos', 'public');
        }

        DB::transaction(function () use ($validatedData) {
            $account = Account::create([
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);

            $userData = collect($validatedData)->except([
                'email',
                'password',
            ])->toArray();

            $userData['account_id'] = $account->id;

            User::create($userData);
        });

        return redirect('/login')->with('success', 'You can login now');
    }

    public function apply(Job $job)
    {
        if (Applicant::where(['user_id' => Auth::user()->id, 'job_id' => $job])) {
            return back()->with('error', 'You already applies for the job');
        }

        Applicant::create(['user_id' => Auth::user()->id, 'job_id' => $job]);

        return back()->with('success', 'Application sent successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
