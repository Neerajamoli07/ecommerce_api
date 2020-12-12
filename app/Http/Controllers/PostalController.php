<?php

namespace App\Http\Controllers;

use App\Postal;
use Illuminate\Http\Request;

class PostalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $postals = Postal::all();
        return view('postals.index',compact('postals',$postals));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('postals.create');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate
        $request->validate([
            'pin_code' => 'required',
            'deliver_cost' => 'required',
        ]);   
        $postal = Postal::create(['place_name' => $request->place_name, 'pin_code' => $request->pin_code,'distance' => $request->distance,'deliver_cost' => $request->deliver_cost]);
        return redirect('/backend/postals');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Postal  $postal
     * @return \Illuminate\Http\Response
     */

    public function show(Postal $postal)
    {
        return view('postals.show' , compact('task',$postal));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Postal  $postal
     * @return \Illuminate\Http\Response
     */

    public function edit($id)
    {
        $postal = Postal::find($id);
        return view('postals.edit',compact('postal',$postal));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Postal  $postal
     * @return \Illuminate\Http\Response
     */
    public function update($id,Request $request)
    {
        $postal = Postal::find($id);
        $postal->place_name = $request->place_name;
        $postal->distance = $request->distance;
        $postal->pin_code = $request->pin_code;
        $postal->deliver_cost = $request->deliver_cost;
        $postal->save();

        // redirect
        return redirect('/backend/postals');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Postal  $postal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $postal = Postal::find($id);
        $postal->delete();
        return redirect('/backend/postals');
    }
}
