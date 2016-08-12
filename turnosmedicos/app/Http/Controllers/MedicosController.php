<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Medico;
use App\Dia;
use App\Turno;
use App\Categoria_medico;
use App\Especialidad;
use App\Funciones;
use App\ObraSocial;

use Session;
use Carbon\Carbon;
use DB;

class MedicosController extends Controller
{
    private function validarMedico(Request $request){
        $this->validate($request, [
            'apellido' => 'required',
            'nombre' => 'required'            
        ]);
    }

    public function getMedico(Request $request)
    {
        //$medico = Medico::where('id', $request->get('id'))->get();
        $medico = Medico::with('especialidades')->findOrFail($request->get('id'));
        //intento recuperar los días y horarios de atención
        return response()->json($medico);
    }    

    public function diasAtencion(Request $request)
    {
        $dias = Dia::with('medicos')->join('dia_medico', 'dias.id', '=', 'dia_medico.dia_id')->where('dia_medico.medico_id', '=', $request->get('id'))->get();

        return response()->json(
            $dias->toArray()
        );
    }

    public function especialidadesMedico(Request $request)
    {
        $especialidades = Especialidad::select('especialidades.id', 'especialidades.descripcion')->join('especialidad_medico', 'especialidades.id', '=', 'especialidad_medico.especialidad_id')->where('especialidad_medico.medico_id', '=', $request->get('id'))->get();

        return response()->json(
            $especialidades->toArray()
        );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicos = Medico::orderBy('apellido')->orderBy('nombre')->paginate(30);
        $dias = Dia::all();

        return view('medicos.index', array('medicos' => $medicos, 'dias' => $dias));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Funciones::getCategoriasSel();
        $especialidades = Especialidad::orderBy('descripcion')->get();
        $obras_sociales = ObraSocial::orderBy('nombre')->get();
        $dias=Dia::all();

        return view('medicos.create', ['obras_sociales' => $obras_sociales, 'categorias' => $categorias, 'especialidades' => $especialidades, 'dias' => $dias]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {        
            $this->validarMedico($request);

            $input = $request->all();        
            $input['fechaNacimiento'] = Carbon::createFromFormat('d-m-Y', $input['fechaNacimiento']);
            $input['duracionTurno'] = Carbon::createFromFormat('H:i', $input['duracionTurno']);

            $medico=Medico::create($input); 

            if(isset($input['especialidad'])){
                $medico->especialidades()->sync($input['especialidad']);
            }
            if(isset($input['obras_sociales'])){
                $medico->obras_sociales()->sync($input['obras_sociales']);
            }
            if(isset($input['dia'])){
                $medico->dias()->detach();
                foreach ($input['dia'] as $dia){
                    $desde = Carbon::createFromFormat('H:i', $input[$dia.'desde']);
                    $hasta = Carbon::createFromFormat('H:i', $input[$dia.'hasta']);

                    $medico->dias()->attach([$dia], array('desde' => $desde, 'hasta' => $hasta));
                }
            }
            Session::flash('flash_message', 'Alta de Medico exitosa!');
        });

        return redirect('/medicos');
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
        $medico=Medico::with('especialidades')->with('dias')->findOrFail($id);
        $categorias = Funciones::getCategoriasSel();
        $especialidades = Especialidad::orderBy('descripcion')->get();
        $obras_sociales = ObraSocial::orderBy('nombre')->get();
        $dias=Dia::all();

        return view('medicos.edit', ['obras_sociales' => $obras_sociales, 'medico' => $medico, 'categorias' => $categorias, 'especialidades' => $especialidades, 'dias' => $dias]);
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
        DB::transaction(function () use ($request, $id) { 
            $this->validarMedico($request);

            $medico = Medico::findOrFail($id);
            
            $input = $request->all();
            $input['fechaNacimiento'] = Carbon::createFromFormat('d-m-Y', $input['fechaNacimiento']);
            $input['duracionTurno'] = Carbon::createFromFormat('H:i', $input['duracionTurno']);

            $medico->fill($input)->save();

            if(isset($input['especialidad'])){
                $medico->especialidades()->sync($input['especialidad']);
            }
            if(isset($input['obras_sociales'])){
                $medico->obras_sociales()->sync($input['obras_sociales']);
            }

            if(isset($input['dia'])){
                $medico->dias()->detach();
                foreach ($input['dia'] as $dia){
                    $desde = Carbon::createFromFormat('H:i', $input[$dia.'desde']);
                    $hasta = Carbon::createFromFormat('H:i', $input[$dia.'hasta']);

                    $medico->dias()->attach([$dia], array('desde' => $desde, 'hasta' => $hasta));
                }
            }
            Session::flash('flash_message', 'Medico editado con éxito!');
        });

        return redirect('/medicos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medico = Medico::findOrFail($id);
        $medico->delete();
        return redirect('/medicos');
    }
}
