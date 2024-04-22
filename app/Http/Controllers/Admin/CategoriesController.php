<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoriesFormRequest;
use App\Models\Categories;
use App\Models\Theme;
use App\Models\Users;
use Illuminate\Support\Facades\Auth;

class CategoriesController extends Controller
{
//  View categories
    public function index()
    {
//      Cau lenh nay rat quan trong,
//      no se fetch thong tin tu database roi cung cap cho view
        $categories = Categories::all();
        $user = Users::all();
        return view('adminpanel.adminviews.categories.index', compact('categories','user'));
    }

//  Create new categories
    public function create()
    {
        return view('adminpanel.adminviews.categories.create');
    }

// Store new categories from create function
    public function store(CategoriesFormRequest $request)
    {
        $data = $request->validated();
        $categories = new Categories;
        $categories->name = $data['name'];
        $categories->description = $data['description'];
        $categories->save();

        return redirect()->route('categories')->with('message', 'Categories Added Successfully');
    }

//Edit each categories
    public function edit($category_id)
    {
        $categories = Categories::find($category_id);
        return view('adminpanel.adminviews.categories.edit', compact('categories'));
    }

//Update categories from the Edit function
    public function update(CategoriesFormRequest $request, $category_id)
    {
        $data = $request->validated();
        $categories = Categories::find($category_id);
        $categories->name = $data['name'];
        $categories->description = $data['description'];
        $categories->update();

        return redirect()->route('categories')->with('message', 'Categories Update Successfully');
    }

//Delete categories
    public function delete($category_id)
    {
        $categories = Categories::find($category_id);
        if ($categories)
        {
            $categories->delete();
            return redirect()->route('categories')->with('message', 'Categories Delete Successfully');
        }
        else
        {
            return redirect()->route('categories')->with('message', 'No Categories ID Found');
        }
    }
}
