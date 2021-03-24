<?php

namespace Modules\Movie\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Movie\Entities\Movie;


class MovieController extends Controller
{
    public function index()
    {
        $movie= Movie::paginate(5);
        return response()->json(['data'=>$movie, 'status'=>200]);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validate = $request->validate([
            'title' => 'required|unique:movies|max:255|string',
        ]);


        $movie = Movie::create($input);
            if($request->logo){
                $fileName = 'movie-'.$movie->id.'.png';
                $data['logo'] = $request->logo->move('companies/logo/', $fileName);
                Movie::find($movie->id)->update($data);
            }

        return response()->json(['data'=>$movie, 'status'=>200, "message" => "Operation Successful!"]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $validate = $request->validate([
            'title' => 'required|max:255|string|unique:movies,title,'.$id,
        ]);

        
            if($request->logo){
                $fileName = 'movie-'.$id.'.png';
                $request->logo->move(public_path('companies/logo/'), $fileName);
                $input['logo'] = $fileName;
            }
            Movie::find($id)->update($input);
            return response()->json(['status'=>200, "message" => "Update Successful!"]);

    }

    public function destroy($id)
    {
        Movie::find($id)->delete();
        return response()->json(["status" => 204, "message" => "Update Successful!"]);

    }
}
