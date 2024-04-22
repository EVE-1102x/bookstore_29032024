<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OrderDetailFormRequest;
use App\Http\Requests\Admin\OrderFormRequest;
use App\Models\Authors;
use App\Models\Books;
use App\Models\Categories;
use App\Models\customers;
use App\Models\employees;
use App\Models\Orders;
use App\Models\OrderDetails;
use App\Models\PaymentMethods;
use App\Models\Publishers;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $employee = Employees::all();
        $users = Users::all();
        $customers = Customers::all();
        $orders = Orders::all();
        $paymentID = PaymentMethods::all();

        return view('adminpanel.adminviews.orders.index',
            compact('employee', 'users', 'customers', 'orders', 'paymentID'));
    }

    public function create()
    {
        $users = Users::all();
        $customers = Customers::all();
        $paymentMethod = PaymentMethods::all();
        $categories = Categories::all();
        $authors = Authors::all();
        $publishers = Publishers::all();
        $books = Books::all();
        $totalPrice = 0;

        if (isset($_SESSION['OrderDetail']))
        foreach ($_SESSION['OrderDetail'] as $BookID)
        {
            $totalPrice += $BookID['subTotal'];
        }

        return view('adminpanel.adminviews.orders.create',
            compact('categories', 'users', 'customers', 'paymentMethod',
                'books', 'authors', 'publishers', 'totalPrice'));
    }

    //Function updateOrderDetail dùng để quản lý 
    public function updateOrderDetail(OrderDetailFormRequest $request)
    {
        $data = $request->validated();

        //Kiểm tra $_SESSION['OrderDetail'] đã tồn tại hay chưa
        if (!isset($_SESSION['OrderDetail']))
        {
            //Khởi tại $_SESSION cho tạo mới đơn hàng
            foreach ($data['BookID'] as $newProductID)
            {
                $book = Books::find($newProductID);

                $_SESSION['OrderDetail'][$newProductID . '-' . 'create'] = array(
                    'productID' => $book->id,
                    'name' => $book->name,
                    'image' => $book->image,
                    'CategoryID' => $book->CategoryID,
                    'AuthorID' => $book->AuthorID,
                    'PublisherID' => $book->PublisherID,
                    'price' => $book->price,
                    'soldOut' => 1,
                    'subTotal' => $book->price
                );
            }

            return redirect(route('addOrder'))
                ->with('message', 'Books were Added Successfully');
        }

        if ($_GET['action'] == 'update')
        {
            switch (true)
            {
                // Nếu nhận được ID sản phẩm mới
                case !empty($data):

                    //Gán giá trị productID hiện tại vào array
                    $currentProductID = [];
                    foreach ($_SESSION['OrderDetail'] as $BookID)
                    {
                        $currentProductID[] = $BookID['productID'];
                    }

                    // Lặp qua các ID sản phẩm mới để kiểm tra và thêm vào $productsID
                    foreach ($data['BookID'] as $newProductID)
                    {
                        // Kiểm tra nếu ID sản phẩm chưa tồn tại trong SESSION thì thêm vào
                        if (!in_array($newProductID, $currentProductID)) {
                            $book = Books::find($newProductID);

                            $_SESSION['OrderDetail'][$newProductID . '-' . 'create'] = array(
                                'productID' => $book->id,
                                'name' => $book->name,
                                'image' => $book->image,
                                'CategoryID' => $book->CategoryID,
                                'AuthorID' => $book->AuthorID,
                                'PublisherID' => $book->PublisherID,
                                'price' => $book->price,
                                'soldOut' => 1,
                                'subTotal' => $book->price
                            );
                        }

                        // Nếu ID tồn tại thì nhập số lượng mới
                        else
                        {
                            $book = Books::find($newProductID);

                            if (!isset($newSoldOut))
                            {
                                $newSoldOut = $data['soldOut'];
                                $step = 0;
                            }

                            $_SESSION['OrderDetail'][$newProductID]['soldOut']
                                = $newSoldOut[$step];

                            $_SESSION['OrderDetail'][$newProductID]['subTotal']
                                = ($book->price) * $newSoldOut[$step];

                            $step++;
                        }
                    }

                    return redirect(route('addOrder'))
                        ->with('message', 'Books were Added Successfully');

                // Nếu không nhận được ID sản phẩm mới
                default:
                    return redirect(route('addOrder'))
                        ->with('error', 'No Books were Added');
            }
        }

        elseif ($_GET['action'] == 'delete')
        {
            $deleteID = $_GET['id'];
            unset($_SESSION['OrderDetail'][$deleteID]);

            return redirect(route('addOrder'))
                ->with('message', 'Book Deleted Successfully');
        }
    }

    public function store(OrderFormRequest $request,
                          OrderDetailFormRequest $requestDetail)
    {
        $data = $request->validated();

        //Tinh ra tong gia tien books
        $totalPrice = 0;
        foreach ($_SESSION['OrderDetail'] as $BookID)
        {
            $totalPrice += $BookID['subTotal'];
        }

        //Them du lieu cho Order
        $order = new Orders;
        $order->status = $data['status'];
        $order->totalPrice = $totalPrice;
        $order->address = $data['address'];
        $order->PaymentID = $data['PaymentID'];
        $order->CustomerID = $data['CustomerID'];
        $order->EmployeeID = Auth::user()->id;
        $order->save();

        //Find the newest OrderID
        $newestOrderID = null;
        $AllOrder = Orders::all();
        foreach ($AllOrder as $Order)
        {
            if ($newestOrderID === null || $Order->id > $newestOrderID) {
                $newestOrderID = $Order->id;
            }
        }

        //Them du lieu cho OrderDetails
        foreach ($_SESSION['OrderDetail'] as $detail)
        {
            $orderDetail = new OrderDetails;
            $orderDetail->OrderID = $newestOrderID;
            $orderDetail->BookID = $detail['productID'];
            $orderDetail->soldOut = $detail['soldOut'];
            $orderDetail->subTotal = $detail['subTotal'];
            $orderDetail->save();
        }

        //Xoá SESSION sau khi hoàn thành tạo đơn hàng
        unset($_SESSION['OrderDetail']);

        return redirect(route('orders'))->with('message','Order Add Successfully');
    }

    public function edit($order_id)
    {
        $order = Orders::find($order_id);
        $employee = Employees::all();
        $orderDetails = OrderDetails::where('OrderID' == $order_id);
        $users = Users::all();
        $customers = Customers::all();
        $paymentMethod = PaymentMethods::all();
        $categories = Categories::all();
        $authors = Authors::all();
        $publishers = Publishers::all();
        $books = Books::all();
        $totalPrice = 0;



        return view('adminpanel.adminviews.orders.edit',
            compact('books','categories','order','users','customers',
                'employee','orderDetails','order_id','totalPrice','paymentMethod','authors','publishers'));
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
