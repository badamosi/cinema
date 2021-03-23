<?php

namespace Modules\ShowTime\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Modules\ShowTime\Entities\ShowTime;


class ShowTimeController extends Controller
{
    public function index()
    {
        $showTime= ShowTime::paginate(5);
        return response()->json(['data'=>$show, 'status'=>200]);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validate = $request->validate([
            'cinema_id' => 'required',
            'movie_id' => 'required|unique:show_times,movie_id,show_time|not_in:'.$request->show_time,
            'show_time' => 'required',
        ]);


        $$showTime = ShowTime::create($input);
    }

    public function update(Request $request, $id)
    {
        $input = $request->only(['url', 'logo', 'name']);

        $validate = $request->validate([
            'cinema_id' => 'required',
            'movie_id' => 'required|unique:show_times,movie_id,id'.$id,
            'show_time' => 'required',
        ]);

        
        ShowTime::find($id)->update($input);

    }

    public function destroy($id)
    {
        ShowTime::find($id)->delete();
        return response()->json(null, 204);
    }
}
