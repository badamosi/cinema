<?php

namespace Modules\Cinema\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Cinema\Entities\Cinema;

class CinemaController extends Controller
{
    
    public function index()
    {
        $cinema= Cinema::paginate(5);
        return response()->json(['data'=>$cinama, 'status'=>200]);
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $validate = $request->validate([
            'name' => 'required|unique:cinemas|max:255|string',
        ]);

        $cinama = Cinema::create($input);
    
        return response()->json(['data'=>$cinama, 'status'=>200]);
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $validate = $request->validate([
            'name' => 'required|max:255|string|unique:cinemas,name,'.$id,
        ]);

        Cinema::find($id)->update($input);
        
        return response()->json(['data'=>$cinama, 'status'=>200]);
    }

    public function destroy($id)
    {
        Cinema::find($id)->delete();
        return response()->json(null, 204);
    }
}
