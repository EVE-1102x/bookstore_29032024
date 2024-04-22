<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\customers;
use App\Models\Users;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $user = Users::where('role_as', '=', '0')->get();
        $customer = customers::all();
        return view('adminpanel.adminviews.customers.index', compact('customer','user'));
    }

    public function edit($customer_id)
    {
        $customer = customers::find($customer_id);
        $user = Users::all();
        return view('adminpanel.adminviews.customers.edit', compact('customer','user'));
    }
}
