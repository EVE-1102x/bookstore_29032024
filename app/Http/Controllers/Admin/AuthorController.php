<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AuthorsFormRequest;
use App\Http\Requests\Admin\PaymentMethodsFormRequest;
use App\Models\Authors;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthorController extends Controller
{
  public function index()
  {
      $authors = Authors::all();
      return view('adminpanel.adminviews.Authors.index', compact('authors'));
  }

  public function create()
  {
      return view('adminpanel.adminviews.Authors.create');
  }

  public function store(AuthorsFormRequest $request)
  {
    $data = $request->validated();
    $authors = new Authors;
    $authors->name = $data['name'];
    $authors->address = $data['address'];
    $authors->phone = $data['phone'];
    $authors->DOB = $data['DOB'];
    $authors->save();

    return redirect()->route('author')->with('message', 'Author Added Successfully');
  }

  public function edit($author_id)
  {
    $authors = Authors::find($author_id);
    return view('adminpanel.adminviews.Authors.edit', compact('authors'));
  }

  public function update(AuthorsFormRequest $request, $author_id)
  {
    $data = $request->validated();
    $authors = Authors::find($author_id);
    $authors->name = $data['name'];
    $authors->address = $data['address'];
    $authors->phone = $data['phone'];
    $authors->DOB = $data['DOB'];
    $authors->save();

    return redirect()->route('author')->with('message', 'Author Update Successfully');
  }

  public function delete($author_id)
  {
    $author = Authors::find($author_id);
    if ($author)
    {
        $author->delete();
        return redirect()->route('author')->with('message', 'Author Delete Successfully');
    }
    else
    {
        return redirect()->route('author')->with('message', 'No Author ID Found');
    }
  }
}
