<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SettingController extends Controller
{
    public function store()
    {
        return view('pages.dashboard.setting',[
            'user' => Auth::user(),
            'categories' => Category::all(),
        ]);
    }

    public function account()
    {
        return view('pages.dashboard.account',[
            'user' => Auth::user(),
        ]);
    }

    public function update(Request $request, $redirect)
    {
        $getVar = $request->all();
        Auth::user()->update($getVar);

        return redirect()->route($redirect);
    }
}
