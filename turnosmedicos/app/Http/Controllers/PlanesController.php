<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Plan;
use App\Funciones;

use Session;

class PlanesController extends Controller
{
    private function validarPlan(Request $request){
        $this->validate($request, [
             'nombre' => 'required',
             'obra_social_id' => 'required'
        ]);
    }

    public function getPlan(Request $request)
    {
        $plan = Plan::where('id', $request->get('id'))->get();
 
        return response()->json(
            $plan->toArray()
        );
    }

    public function planesObraSocial(Request $request)
    {
        $planes = Plan::where('obra_social_id', '=', $request->get('id'))->get();
        return response()->json(
            $planes->toArray()
        );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $planes = Plan::paginate(30);
        return view('planes.index', array('planes' => $planes, 'obras_sociales' => Funciones::getObrasSocialesSel()));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validarPlan($request);

        $input = $request->all();

        Plan::create($input);

        Session::flash('flash_message', 'Alta de Plan exitosa!');

        return redirect('/planes');
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
    public function update(Request $request, $id)
    {
        $plan = Plan::findOrFail($id);

        $this->validarPlan($request);

        $input = $request->all();

        $plan->fill($input)->save();

        Session::flash('flash_message', 'Plan editada con éxito!');

        return redirect('/planes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $plan = Plan::findOrFail($id);
        $plan->delete();
        return redirect('/planes');
    }
}
