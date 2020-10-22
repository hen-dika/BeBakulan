<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\GalleryRequest;
use App\Http\Controllers\Controller;
use App\Product;
use App\ProductGallery;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class GalleryController extends Controller
{
    public function index()
    {
        if(request()->ajax()) {
            $query = ProductGallery::with(['product']);
            return Datatables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button class="btn btn-primary dropdown-toggle mr-1 mb-1" type="button" id="action' .  $item->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Choose ...
                                </button>
                                <div class="dropdown-menu" aria-labelledby="action' .  $item->id . '">
                                    <form action="' . route('gallery.destroy', $item->id) . '" method="POST">
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
        return view('pages.admin.gallery.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'products' => Product::all()
        ];
        return view('pages.admin.gallery.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {
        $getVar = $request->all();
        $getVar['image'] = $request->file('image')->store('uploads/images/gallery', 'public');

        ProductGallery::create($getVar);
        
        return redirect()->route('gallery.index');
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GalleryRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = ProductGallery::findOrFail($id);
        $item ->Delete();

        return redirect()->route('gallery.index');
    }
}
