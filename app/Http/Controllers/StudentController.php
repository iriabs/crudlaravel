<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Students;

class StudentController extends Controller
{
    public function index(){
        //$estudiantes =  Students::all();
        //Para paginacion
        $estudiantes =  Students::paginate(5);
        return view('welcome',compact('estudiantes'));
    }

    public function create(){
        return view('create');
    }

    public function store(Request $request){
        $this->validate($request,[

            'nombre' => 'required',
            'email' => 'required',
            'telefono' => 'required'
        ]
        );

        $estudiante = new Students;
        $estudiante->nombre = $request->nombre;
        $estudiante->apellidos = $request->apellidos;
        $estudiante->email = $request->email;
        $estudiante->telefono = $request->telefono;
        $estudiante-> save ();
        return redirect (route('home'))->with('successMsg','Estudiante añadido correctamente');
    }

    public function edit($id){
        $estudiante = Students::find($id);
        return view('edit',compact('estudiante'));

    }

    public function update(Request $request){
        $this->validate($request,[

            'nombre' => 'required',
            'email' => 'required',
            'telefono' => 'required'
        ]
        );

        $estudiante = Students::find($id);
        $estudiante->nombre = $request->nombre;
        $estudiante->apellidos = $request->apellidos;
        $estudiante->email = $request->email;
        $estudiante->telefono = $request->telefono;
        $estudiante-> save ();
        return redirect (route('home'))->with('successMsg','Estudiante modificado');
    }

    public function delete($id){
        $estudiante = Students::find($id);
        $estudiante->delete();
        return redirect (route('home'))->with('successMsg','Estudiante borrado');

    }

}

