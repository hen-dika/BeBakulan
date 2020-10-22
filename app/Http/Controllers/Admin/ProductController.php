<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\Admin\ProductRequest;
use App\Http\Controllers\Controller;
use App\Product;
use App\User;
use App\Category;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;


class ProductController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            $query = Product::with(['category','user']);
            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" id="action' .  $item->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Choose..
                                </button>
                                <div class="dropdown-menu" aria-labelledby="action' .  $item->id . '">
                                    <a class="dropdown-item" href="' . route('product.edit', $item->id) . '">
                                        Edit
                                    </a>
                                    <form action="' . route('product.destroy', $item->id) . '" method="POST">
                                        ' . method_field('delete') . csrf_field() . '
                                        <button type="submit" class="dropdown-item text-danger">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                    </div>';
                })
                ->rawColumns(['action'])
                ->make();
            
        }
        return view('pages.admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'users' => User::all(),
            'categories' => Category::all()
        ];
        return view('pages.admin.product.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $getVar = $request->all();
        $getVar['slug'] = Str::slug($request->name);
        // dd($getVar);

        Product::create($getVar);
        
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = [
            'users' => User::all(),
            'categories' => Category::all(),
            'item' => Product::findOrFail($id)
        ];

        return view('pages.admin.product.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $getVar = $request->all();
        $getVar['slug'] = $request->name;

        $item = Product::findOrFail($id);
        $item->update($getVar);
        
        return redirect()->route('product.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Product::findOrFail($id);
        $item ->Delete();

        return redirect()->route('product.index');
    }
}
