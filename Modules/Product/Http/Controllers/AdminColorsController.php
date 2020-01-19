<?php

namespace Modules\Product\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Product\Entities\Color;

class AdminColorsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function __construct()
    {
        $this->middleware(['auth:admin', 'isAdmin']);
    }

    public function index()
    {
        $colors =  Color::all();
        return view('product::color.index', compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('product::color.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $color = new Color();
        $color->color = $request->color;
        $color->save();
        $request->session()->flash('color_created','Color has been created');
        return redirect('admin/colors/index');
    }

    /**
     * Show the specified resource.
     * @return Response
     */
    public function show()
    {

        return view('product::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit($id)
    {
        $color = Color::findOrFail($id);
        return view('product::color.edit', compact('color'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return Response
     */
    public function update(Request $request,$id)
    {
        $input = $request->all();
        $color = Color::findOrFail($id);
        $color->update($input);
        $request->session()->flash('color_updated','Color has been updated');
        return redirect('admin/colors/index');
    }

    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy(Request $request)
    {
        $color = Color::findOrFail($request->id);
        if($color->delete()){
            return response()->json(['status'=>200]);
        } else {
            return response()->json(['status'=>-1]);
        }
    }
}
