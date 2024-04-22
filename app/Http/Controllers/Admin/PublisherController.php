<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LegoPieceFormRequest;
use App\Http\Requests\Admin\PublishersFormRequest;
use App\Models\Authors;
use App\Models\piece;
use App\Models\Discounts;
use App\Models\Publishers;
use App\Models\Orders;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublisherController extends Controller
{
    public function index()
    {
        $publishers = Publishers::all();
        return view('adminpanel.adminviews.Publishers.index', compact('publishers'));
    }

    public function create()
    {
        return view('adminpanel.adminviews.Publishers.create');
    }

    public function store(PublishersFormRequest $request)
    {
        $data = $request->validated();
        $publisher = new Publishers;

        $publisher->name = $data['name'];
        $publisher->address = $data['address'];
        $publisher->phone = $data['phone'];
        $publisher->save();

        return redirect()->route('publishers')->with('message', 'Publisher Added Successfully');
    }

    public function edit($publisher_id)
    {
        $publisher = Publishers::find($publisher_id);
        return view('adminpanel.adminviews.Publishers.edit', compact('publisher'));
    }

    public function update(PublishersFormRequest $request, $publisher_id)
    {
        $data = $request->validated();
        $publisher = Publishers::find($publisher_id);

        $publisher->name = $data['name'];
        $publisher->address = $data['address'];
        $publisher->phone = $data['phone'];
        $publisher->update();

        return redirect()->route('publishers')->with('message', 'Publisher Update Successfully');
    }

    public function delete($publisher_id)
    {
        $publisher = Publishers::find($publisher_id);
        if ($publisher)
        {
            $publisher->delete();
            return redirect()->route('publishers')->with('message', 'Publisher Delete Successfully');
        }
        else
        {
            return redirect()->route('publishers')->with('message', 'No Publisher ID Found');
        }
    }
}
