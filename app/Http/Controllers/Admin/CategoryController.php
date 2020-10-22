<?php

namespace App\Http\Controllers\Admin;


use App\Http\Requests\Admin\CategoryRequest;
use App\Http\Controllers\Controller;
use App\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\DataTables;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->ajax()) {
            $query = Category::query();
            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" id="action' .  $item->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Choose ...
                                </button>
                                <div class="dropdown-menu" aria-labelledby="action' .  $item->id . '">
                                    <a class="dropdown-item" href="' . route('category.edit', $item->id) . '">
                                        Edit
                                    </a>
                                    <form action="' . route('category.destroy', $item->id) . '" method="POST">
                                        ' . method_field('delete') . csrf_field() . '
                                        <button type="submit" class="dropdown-item text-danger">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                    </div>';
                })
                ->editColumn('image', function($item) {
                    return $item->image ? '<img src="'. Storage::url($item->image) .'" style="max-height: 50px;" />' : '';
                })
                ->rawColumns(['action','image'])
                ->make();
            
        }
        return view('pages.admin.category.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $getVar = $request->all();
 
        $getVar['slug'] = Str::slug($request->name);
        $getVar['image'] = $request->file('image')->store('uploads/images/category', 'public');

        Category::create($getVar);
        
        return redirect()->route('category.index');
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
            'item' => Category::findOrFail($id)
        ];

        return view('pages.admin.category.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $getVar = $request->all();
 
        $getVar['slug'] = Str::slug($request->name);
        $getVar['image'] = $request->file('image')->store('uploads/images/category', 'public');

        $item = Category::findOrFail($id);
        $item -> update($getVar);
        
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Category::findOrFail($id);
        $item ->Delete();

        return redirect()->route('category.index');
    }
}
