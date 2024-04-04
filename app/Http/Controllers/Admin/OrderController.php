<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrderDetailFormRequest;
use App\Http\Requests\Admin\OrderFormRequest;
use App\Http\Requests\Admin\SizeFormRequest;
use App\Models\Books;
use App\Models\Categories;
use App\Models\Category;
use App\Models\customer;
use App\Models\customers;
use App\Models\employee;
use App\Models\employees;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\PaymentMethods;
use App\Models\Product;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $employee = Employees::all();
        $user = User::all();
        $customer = Customers::all();
        $orders = Orders::all();
        $paymentmethods = PaymentMethods::all();

        return view('adminpanel.adminviews.orders.index',
            compact('employee','user','customer','orders','paymentmethods'));
    }

    public function create($product_chose = null)
    {
        $users = User::all();
        $categories = Categories::all();
        $customers = Customers::all();
        $paymentMethod = PaymentMethods::all();

        return view('adminpanel.adminviews.orders.create-1',
            compact('categories','users','customers','paymentMethod','product_chose'));
    }

    public function create_bookMenu(OrderFormRequest $request)
    {
        $data = $request->validated();
        $orders = new Orders;
        $orders->EmployeeID = $data['EmployeeID'];
        $orders->CustomerID = $data['CustomerID'];
        $CategoryID = $data['CategoryID'];

        $books = Books::all();

        return view('adminpanel.adminviews.orders.create-2',
            compact('CategoryID','orders','books'));
    }

    public function store(OrderFormRequest $request, OrderDetailFormRequest $requestDetail)
    {
        $data = $request->validated();
        $dataDetail = $requestDetail->validated();
        $order = new Orders;

//      Tinh ra tong gia tien book
        $bookPrice = [];
        $bookID = [];
        $bookSold = [];
        $subtotal = [];
        $totalPrice = 0;

        for ($i = 0; $i < $PrdNumber; $i++)
        {
//          lay ra toan bo san pham duoc chon
            $prdID[$i] = $data2['ProductID'][$i];
            $product = Product::find($prdID[$i]);
            $prdPrice[$i] = $product->ProPrice;

//          Tinh ra subtotal cua tung san pham
            $prdSold[$i] = $data2['PrdSold'][$i];
            $subtotal[$i] = $prdSold[$i] * $prdPrice[$i];
            $totalPrice += $subtotal[$i];
        }

//      Them du lieu vao database
        $order->TotalPrice = $totalPrice;
        $order->OrdStatus = $data['ord_status'];
        $order->OrdAddress = $data['OrdAddress'];
        $order->paymentMethod = $data['paymentMethod'];
        $order->CustomerID = $data['CustomerID'];
        $order->EmployeeID = Auth::user()->id;
        $order->save();

//      Find the newest OrderID
        $newestOrderID = null;
        $AllOrder = Orders::all();
        foreach ($AllOrder as $Order)
        {
            if ($newestOrderID === null || $Order->id > $newestOrderID) {
                $newestOrderID = $Order->id;
            }
        }

//      Them du lieu cho OrderDetails
        for ($i = 0; $i < $PrdNumber; $i++)
        {
            $orderdetail = new OrderDetails;
            $orderdetail->OrderID = $newestOrderID;
            $orderdetail->ProductID = $data2['ProductID'][$i];
            $orderdetail->SubTotal = $subtotal[$i];
            $orderdetail->SoldOut = $data2['PrdSold'][$i];
            $orderdetail->save();
        }

        return redirect(route('order'))->with('message','Order Add Successfully');
    }

    public function edit($order_id)
    {
        $order = Order::find($order_id);
        $product = Product::all();
        $user = User::all();
        $category = Category::all();
        $customer = Customer::all();
        $employee = Employee::all();
        $orderdetail = OrderDetails::all();

        return view('adminpanel.adminviews.order.edit',
            compact('product','category','order','user','customer','employee','orderdetail','order_id'));
    }

    public function update(OrderFormRequest $request, $order_id)
    {
        $data = $request->validated();
        $order = Order::find($order_id);

        $order->OrdStatus = $data['OrdStatus'];
        $order->OrdAddress = $data['OrdAddress'];
        $order->paymentMethod = $data['paymentMethod'];
        $order->update();

        return redirect(route('order'))->with('message','Order Update Successfully');
    }

    public function delete($order_id)
    {
        $order = Orders::find($order_id);
        if ($order)
        {
            // Delete related order details
            OrderDetails::where('OrderID', $order_id)->delete();

            // Delete the order
            $order->delete();

            return redirect(route('orders'))->with('message','Order Deleted Successfully');
        }
        else
        {
            return redirect(route('orders'))->with('message','No Order Found with the provided ID');
        }
    }
}
