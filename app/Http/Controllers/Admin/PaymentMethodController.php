<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrderDetailFormRequest;
use App\Http\Requests\Admin\OrderFormRequest;
use App\Http\Requests\Admin\PaymentMethodsFormRequest;
use App\Http\Requests\Admin\SizeFormRequest;
use App\Models\Books;
use App\Models\Categories;
use App\Models\Category;
use App\Models\customer;
use App\Models\customers;
use App\Models\Discounts;
use App\Models\employee;
use App\Models\employees;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\PaymentMethods;
use App\Models\Product;
use App\Models\Orders;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentMethodController extends Controller
{
    public function index()
    {
        $paymentMethods = PaymentMethods::all();
        return view('adminpanel.adminviews.orders.paymentMethods.index', compact('paymentMethods'));
    }

    public function store(PaymentMethodsFormRequest $request)
    {
        $data = $request->validated();
        $paymentMethod = new PaymentMethods;
        $paymentMethod->name = $data['name'];
        $paymentMethod->save();

        return redirect()->route('paymentmethods')->with('message', 'Payment Method Added Successfully');
    }

    public function update(PaymentMethodsFormRequest $request, $payment_id)
    {
        $data = $request->validated();
        $paymentMethod = PaymentMethods::find($payment_id);
        $paymentMethod->name = $data['name'];
        $paymentMethod->save();

        return redirect()->route('paymentmethods')->with('message', 'Payment Method Update Successfully');
    }

    public function delete($payment_id)
    {
        $paymentMethod = PaymentMethods::find($payment_id);
        if ($paymentMethod)
        {
            $paymentMethod->delete();
            return redirect()->route('paymentmethods')->with('message', 'Payment Method Delete Successfully');
        }
        else
        {
            return redirect()->route('paymentmethods')->with('message', 'No Payment Method ID Found');
        }
    }
}
