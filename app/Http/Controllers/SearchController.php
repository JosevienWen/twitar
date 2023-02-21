<?php

namespace App\Http\Controllers;

use App\Models\comments;
use App\Models\tweets;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //function untuk search
    public function search()
    {
        $data = tweets::with('user', 'comments')->latest();
        $data2 = comments::with('user')->latest();

        if(request('search')){
            $data->where('tags', 'like', '%' . request('search') . '%');
            $data2->where('tags', 'like', '%' . request('search') . '%');
        }

        return view('search')->with([
            'data' => $data->get(),
            'data2' => $data2->get(),
        ]);
    }
}
