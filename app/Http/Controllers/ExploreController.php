<?php

namespace App\Http\Controllers;

use App\Models\Tutorials;
use Illuminate\Http\Request;

class ExploreController extends Controller
{
    public function explore(Request $request){

        $searchVal = $request->input('search');

        if($request->input('search') == '') {
            $tutorials = Tutorials::orderBy('created_at', 'desc')->with(['votes', 'comments'])->paginate(4);
        } else {
            $tutorials = Tutorials::query()->where('name', 'LIKE', "%{$request->input('search')}%")->with(['votes', 'comments'])->get();
        }

        return view('pages.explore', compact(['tutorials', 'searchVal']));
    }
}
