<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PaymentMethodsFormRequest;
use App\Models\Discounts;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DiscountController extends Controller
{
    public function index()
    {
        $discount = Discounts::all();
        return view('adminpanel.adminviews.customers.discounts.index', compact('discount',));
    }

    public function store(PaymentMethodsFormRequest $request)
    {
        $data = $request->validated();
        $discount = new Discounts;
        $discount->discount_amount = $data['discount_amount'];
        $discount->save();

        return redirect()->route('discounts')->with('message', 'Discounts Added Successfully');
    }

    public function update(PaymentMethodsFormRequest $request, $discount_id)
    {
        $data = $request->validated();
        $discount = Discounts::find($discount_id);
        $discount->discount_amount = $data['discount_amount'];
        $discount->save();

        return redirect()->route('discounts')->with('message', 'Discounts Update Successfully');
    }

    public function delete($discount_id)
    {
        $discount = Discounts::find($discount_id);
        if ($discount)
        {
            $discount->delete();
            return redirect()->route('discounts')->with('message', 'Discounts Delete Successfully');
        }
        else
        {
            return redirect()->route('discounts')->with('message', 'No Discounts ID Found');
        }
    }
}
