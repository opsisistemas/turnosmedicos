<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\Asunto;

use Validator;
use Session;

class AsuntosController extends Controller
{
    public function getAsunto(Request $request)
    {
        $asunto = Asunto::where('id', '=',  $request->get('id'))->get();
        return response()->json(
            $asunto->toArray()
        );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $asuntos = Asunto::orderBy('nombre')->paginate(30);

        return view('asuntos.index', ['asuntos' => $asuntos]);
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
        $rules = ['nombre' => 'required'];
        $errors = ['nombre' => 'Debe completar el nombre del asunto'];
        $validator = Validator::make($request->all(), $rules, $errors);
        // process the login
        if ($validator->fails()) {
            return Redirect::to('asuntos')
                ->withErrors($errors)
                ->withInput($request->all());
        } else {
            // store
            $input = $request->all();
            
            Asunto::create($input);

            Session::flash('flash_message', 'Asunto creado con &eacute;xito!');

            //redirect
            return redirect('asuntos');
        }
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
        $rules = ['nombre' => 'required'];
        $errors = ['nombre' => 'Debe completar el nombre del asunto'];
        $validator = Validator::make($request->all(), $rules, $errors);
        // process the login
        if ($validator->fails()) {
            return Redirect::to('/asuntos')
                ->withErrors($errors)
                ->withInput($request->all());
        } else {
            $asunto = Asunto::findOrFail($id);

            $input = $request->all();

            $asunto->fill($input)->save();

            Session::flash('flash_message', 'Asunto editado con éxito!');

            return redirect('/asuntos');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $asunto = Asunto::findOrFail($id);
        $asunto->delete();
        return redirect('/asuntos');
    }
}
