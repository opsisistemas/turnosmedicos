<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Medico;
use App\Dia;
use App\Horario;

use Session;
use Carbon\Carbon;

class MedicosController extends Controller
{
    private function validarMedico(Request $request){
        $this->validate($request, [
            'apellido' => 'required',
            'nombre' => 'required'
        ]);
    }

    private function altaHorarios($medico, $input){
        //por cada dia de atención, doy de alta un horario
        if(array_key_exists('Lunes',$input)){
            $datos = array('medico_id'=> $medico->id, 
                           'dia'=> '1',
                           'desde'=> Carbon::createFromFormat('H:i', $input['Lunesdesde']),
                           'hasta'=> Carbon::createFromFormat('H:i', $input['Luneshasta']));
        Horario::create($datos);    
        }
        if(array_key_exists('Martes',$input)){
            $datos = array('medico_id'=> $medico->id, 
                           'dia'=> '2',
                           'desde'=> Carbon::createFromFormat('H:i', $input['Martesdesde']),
                           'hasta'=> Carbon::createFromFormat('H:i', $input['Marteshasta']));
        Horario::create($datos);    
        }
        if(array_key_exists('Miercoles',$input)){
            $datos = array('medico_id'=> $medico->id, 
                           'dia'=> '3',
                           'desde'=> Carbon::createFromFormat('H:i', $input['Miercolesdesde']),
                           'hasta'=> Carbon::createFromFormat('H:i', $input['Miercoleshasta']));
        Horario::create($datos);
        } 
        if(array_key_exists('Jueves', $input)){
            $datos = array('medico_id'=> $medico->id, 
                           'dia'=> '4',
                           'desde'=> Carbon::createFromFormat('H:i', $input['Juevesdesde']),
                           'hasta'=> Carbon::createFromFormat('H:i', $input['Jueveshasta']));
        Horario::create($datos); 
        }     
        if(array_key_exists('Viernes', $input)){
            $datos = array('medico_id'=> $medico->id, 
                           'dia'=> '5',
                           'desde'=> Carbon::createFromFormat('H:i', $input['Viernesdesde']),
                           'hasta'=> Carbon::createFromFormat('H:i', $input['Vierneshasta']));
        Horario::create($datos); 
        }     
        if(array_key_exists('Sabado', $input)){
            $datos = array('medico_id'=> $medico->id, 
                           'dia'=> '6',
                           'desde'=> Carbon::createFromFormat('H:i', $input['Sabadodesde']),
                           'hasta'=> Carbon::createFromFormat('H:i', $input['Sabadohasta']));
        Horario::create($datos); 
        }
        if(array_key_exists('Domingo', $input)){
            $datos = array('medico_id'=> $medico->id, 
                           'dia'=> '7',
                           'desde'=> Carbon::createFromFormat('H:i', $input['Domingodesde']),
                           'hasta'=> Carbon::createFromFormat('H:i', $input['Domingohasta']));
        Horario::create($datos);
        }         
        //
    }

    public function getMedico(Request $request)
    {
        $medico = Medico::where('id', $request->get('id'))->get();
        return response()->json(
            $medico->toArray()
        );
    }    

    public function diasAtencion(Request $request)
    {

        $dias = Dia::join('horarios', 'dias.id', '=', 'horarios.dia')->where('horarios.medico_id', '=', $request->get('id'))->get();        

        return response()->json(
            $dias->toArray()
        );
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medicos = Medico::paginate(30);
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
        $this->validarMedico($request);

        $input = $request->all();        

        $input['fechaNacimiento'] = Carbon::createFromFormat('d-m-Y', $input['fechaNacimiento']);
        $input['duracionTurno'] = Carbon::createFromFormat('H:i', $input['duracionTurno']);

        $medico=Medico::create($input); 

        $this->altaHorarios($medico, $input);
        
        Session::flash('flash_message', 'Alta de Medico exitosa!');

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
        $medico = Medico::findOrFail($id);

        $this->validarMedico($request);

        $input = $request->all();

        $medico->fill($input)->save();

        Session::flash('flash_message', 'Medico editado con éxito!');

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
