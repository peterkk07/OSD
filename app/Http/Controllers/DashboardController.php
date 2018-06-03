<?php

namespace OSD\Http\Controllers;

use OSD\Http\Requests;
use View;
use OSD\User;
use OSD\UserType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator as Paginator;
use Illuminate\Support\Collection as Collection;
use DB;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
 /*   public function __construct()
    {
        $this->middleware('auth');
    }*/

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

/*Formulario para la creación de el primer usuario administrador*/
    public function createFirstAdminForm() {

        return view('admin.createAdmin');

    }

/*Función para crear el usuario*/
    protected function create(array $data)
    {
        return User::create([
            'name' => ucwords($data['name']),
            'ci' => $data['ci'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),

            ]);
    }

    public function createAdmin(Request $request) {


        $mensajes = array(
            //campos requeridos
            'name.required' => 'Debe ingresar su nombre.',
            'ci.required' => 'Ingrese su Nro. de cédula.',
            'email.email' => 'Ingrese una dirección de correo válida. ',
            'password.min' => 'Debe ingresar una contraseña de almenos 6 elementos.',
            'password.confirmed' => 'Debe tener la misma contraseña',
        );

        $rules= [
            'name' => 'required',
            'ci' => 'required|numeric|digits_between:6,12|unique:users,ci',
            'email' => 'required|email|max:50|unique:users',
            'password'=> 'required|min:6', 
        ];

        $input = $request->all();
        
        $this->validate($request,$rules,$mensajes);

        $userType= UserType::where("description","Administrador")->first()->id;

        $user = $this->create($input);

        $user->type_user()->associate($userType);
        $user->save();

        return redirect()->to('/crear-primer-admin')->with('success',"Se ha creado el usuario exitosamente");

    }


    public function index()
    {
        return view('home');
    }

    public function showCreateUserForm(){

        $roles =UserType::all();

        return view('admin.createUser')->with(compact('roles'));
    }

    public function addUser(Request $request) {

        $mensajes = array(
            //campos requeridos
            'rol.required' => 'Debe ingresar un rol de usuario.',
            'name.required' => 'Debe ingresar su nombre.',
            'ci.required' => 'Ingrese su Nro. de cédula.',
            'email.email' => 'Ingrese una dirección de correo válida. ',
            'password.min' => 'Debe ingresar una contraseña de almenos 6 elementos.',
            'password.confirmed' => 'Debe tener la misma contraseña',
        );

        $rules= [
            'rol' => 'required',
            'name' => 'required',
            'ci' => 'required|numeric|digits_between:6,12|unique:users,ci',
            'email' => 'required|email|max:50|unique:users',
            'password'=> 'required|min:6', 
        ];

        $input = $request->all();
        $this->validate($request,$rules,$mensajes);


        switch ($request->rol) {
            case 'Estudiante':
                $userType= UserType::where("description","Estudiante")->first()->id;    
                    break;
            
            case 'Profesor':
                $userType= UserType::where("description","Profesor")->first()->id;
                break;

            case 'Administrador':
                $userType= UserType::where("description","Administrador")->first()->id;
                break;

            case 'Director':
                $userType= UserType::where("description","Director")->first()->id;
                break;

            case 'Coordinador':
                $userType= UserType::where("description","Coordinador")->first()->id;
                break;
        }

        $user = $this->create($input);

        $user->type_user()->associate($userType);
        $user->save();

        return redirect()->to('/dashboard/crear-usuario')->with('success',"Se ha creado el usuario exitosamente");

    }

    public function showUsers (Request $request) {

        $roles =UserType::all();

        return view('admin.showUsers')->with(compact('roles'));
    }

    public function showRol (Request $request) {

        $rol = $request->rol;
        $users = User::whereHas('type_user', function($q) use ($rol) {
            $q->where('description', $rol);
        })->paginate(15);


        return view('admin.showRol',['rol' => $rol])->with(compact('users'));
    }

   /* editar los datos de un usuario*/
    public function editUserForm ($id) {

        $roles =UserType::all();
        $user = User::where('id', $id)->first();

        return view('admin.editUserForm')->with(compact('user'))->with(compact('roles'));
    }

    public function editUser (Request $request) {

    $input = $request->all();

        $messages = [
            //campos requeridos
            'name.required' => 'El campo "Nombre" es obligatorio',
            'ci.required' => 'El campo "Cédula" es obligatorio',
            'email.required' => 'El campo "Correo" es obligatorio',
            'rol.required' => 'El campo "Rol" es obligatorio',

            //validar campos con solo texto 
            'name.regex' => 'El nombre solo puede contener texto',
         
            //mínimo y maximo de elementos
            'password.between' => 'Debe ingresar una contraseña de almenos 6 dígitos',
            'password.confirmed' => 'Debe tener la misma contraseña',

            'ci.digits_between' => 'La cédula debe poseer un mínimo de 6 dígitos y un máximo de 12.',
            'ci.unique' => 'La cédula de identidad que ingresó ya se encuentra registrada.',
        ];

        $this->validate($request, [
            'name' => ['required','regex:/^[\pL\s\-]+$/u'],
            'email' => 'required|email|max:50',
            'ci' => 'required|numeric|digits_between:6,12',
            'password' => 'between:6,50|confirmed',
            'rol' =>'required'
           
        ],$messages);

        $user = User::where('id',$request->id)->first();
        $userType= UserType::where("description",$request->rol)->first()->id;

        $user->type_user()->associate($userType);
        $user->name = ucwords($request->name);
        $user->ci = $request->ci;
        $user->email = $request->email;

        if (empty($request->password)) {
            $user->save();
       
            return redirect()->to('/dashboard/mostrar-rol')->with('success',"Se ha editado el usuario correctamente");
        }

        $user->password = bcrypt($request->password);
        
        $user->save();
        return redirect()->to('/dashboard/mostrar-rol')->with('success',"Se ha editado el usuario correctamente");
    }

    public function deleteUserMessage($id) {

        $user = User::where('id',$id)->first();

        return view('admin.deleteConfirm')->with(compact('user'));
       

    }

    public function deleteConfirm (Request $request) {

        $user = User::find($request->id);
        $user->delete();
        return redirect()->to('/dashboard/mostrar-rol')->with('success',"Se ha eliminado el usuario correctamente");

    }
    



}
