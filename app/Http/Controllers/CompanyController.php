<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Models\Account;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::withCount('jobs')
            ->orderByDesc('jobs_count')
            ->where('status', 'verified')
            ->get();

        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('auth.register-company');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:30',
            'phone'      => 'required|string|max:50|unique:users,phone',
            'website'        => 'nullable|string',
            'description'        => 'nullable|string',

            'email'      => 'required|string|email|max:50|unique:accounts,email',
            'password'   => 'required|string|min:8|max:20|confirmed',
        ]);

        DB::transaction(function () use ($validatedData) {
            $account = Account::create([
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);

            $companyData = collect($validatedData)->except([
                'email',
                'password',
            ])->toArray();

            $companyData['account_id'] = $account->id;

            Company::create($companyData);
        });

        return redirect('/login')->with('success', 'Company registration successful. Please log in.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        //
    }
}
