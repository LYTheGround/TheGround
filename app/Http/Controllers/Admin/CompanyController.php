<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('admin.company.index',compact('companies'));
    }

    public function show(Company $company)
    {
        return view('admin.company.show',compact('company'));
    }

    public function create()
    {
        return view('admin.company.create');
    }
}
