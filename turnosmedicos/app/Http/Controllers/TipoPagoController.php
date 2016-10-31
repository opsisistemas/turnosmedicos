<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\TipoPago;

use Validator, Redirect, Session;

class TipoPagoController extends Controller
{
    public function getTipoPago(Request $request)
    {
        $tipopago = TipoPago::where('id', '=',  $request->get('id'))->get();
        return response()->json(
            $tipopago->toArray()
        );
    }

    public function getTiposPago(Request $request)
    {
        $tipospago = TipoPago::orderBy('codigo')->get();
        return response()->json(
            $tipospago->toArray()
        );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos = TipoPago::orderBy('codigo')->paginate(30);

        return view('tipopago.index', ['tipospago' => $tipos]);
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
        $rules = [
            'codigo' => 'required',
            'descripcion' => 'required'
        ];
        $errors = [
            'codigo' => 'Debe completar el c&oacute;digo del tipo de pago',
            'descripcion' => 'Debe completar la descripci&oacute;n del tipo de pago',
        ];
        $validator = Validator::make($request->all(), $rules, $errors);
        // process the login
        if ($validator->fails()) {
            return Redirect::to('tipopago')
                ->withErrors($errors)
                ->withInput($request->all());
        } else {
            // store
            $input = $request->all();
            
            TipoPago::create($input);

            Session::flash('flash_message', 'Tipo de pago creado con &eacute;xito!');

            //redirect
            return redirect('tipopago');
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
        $rules = [
            'codigo' => 'required',
            'descripcion' => 'required'
        ];
        $errors = [
            'codigo' => 'Debe completar el c&oacute;digo del tipo de pago',
            'descripcion' => 'Debe completar la descripci&oacute;n del tipo de pago',
        ];
        $validator = Validator::make($request->all(), $rules, $errors);
        // process the login
        if ($validator->fails()) {
            return Redirect::to('/tipopago')
                ->withErrors($errors)
                ->withInput($request->all());
        } else {
            $tipopago = TipoPago::findOrFail($id);

            $input = $request->all();

            $tipopago->fill($input)->save();

            Session::flash('flash_message', 'Tipo de pago editado con éxito!');

            return redirect('/tipopago');
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
        $tipopago = TipoPago::findOrFail($id);
        $tipopago->delete();
        return redirect('/tipopago');
    }
}
