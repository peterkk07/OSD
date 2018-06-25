<?php

namespace OSD\Http\Controllers;

use OSD\Http\Requests;
use View;
use OSD\User;
use OSD\UserType;
use OSD\Semester;
use OSD\Survey;
use OSD\Subject;
use OSD\SubjectType;
use OSD\KnowledgeArea;
use OSD\SurveyOption;
use OSD\SurveyQuestion;
use OSD\SemesterSurvey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;
use Session;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator as Paginator;
use Illuminate\Support\Collection as Collection;
use DB;
use \Datetime;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       /* $this->middleware('auth');*/
    }

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

    public function showUsers () {

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

    /*Administrar encuesta*/

    public function showCreateSurveyForm () {

        return view("admin.createSurveyForm");

    }

    /*creación de encuestas*/
    protected function CreateSurvey(Request $request)
    {
        
        $mensajes = array(
            //campos requeridos
            'name.required' => 'Debe ingresar el nombre de la encuesta.',
            'semester.required' =>  'Debe ingresar el período lectivo.',
            'status.required' => 'Debe asignar un estatus a la encuesta.',
            'start_date.required' => 'Debe ingresar la fecha de inicio de la encuesta.',
            'end_date.required' => 'Debe ingresar la fecha de finalización de la encuesta. ',
            'question*.required' => 'Debe agregar las preguntas de la encuesta. ',
            
           
                    //campos que deben ser unicos
            'semester.unique' => 'El período lectivo ya se encuentra almacenado.',
            'name.unique' => 'Ya existe una encuesta con este nombre.',
        );

        for ($i=0 ; $i< count($request["question"]); $i++) {

            $mensajes["question.$i.required"]= "Es necesario que ingrese las preguntas de la encuesta";
        }

        $rules= [
            'name' => 'required|unique:surveys',
            'semester' => 'required|unique:semesters,name',
            'status' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'question.*' => 'required',
        ];


        $this->validate($request,$rules,$mensajes);

       /* Primero se crea el semestre y la encuesta, para luego hacer la asociación*/
        $date = DateTime::createFromFormat('d/m/Y', $request->start_date);
        $start_date=  $date->format('Y-m-d');

        $date2 = DateTime::createFromFormat('d/m/Y', $request->end_date);
        $end_date=  $date2->format('Y-m-d');

        $semester = Semester::create([

            'name' => $request->semester
        ]);
        $survey = Survey::create([

            'name' => $request->name
        ]);

       /* creando la relacion  encuesta-semestre*/
        $semester->survey()->attach($survey->id, ['status'=>$request->status , 'start_date' => $start_date, 'end_date' => $end_date]);

        /* asociando la encuesta  con las preguntas*/

        for ($i=0; $i < count($request["question"]) ; $i++ ){

            $question = SurveyQuestion::create([

                'description' => $request["question"][$i]
            ]);

            $question->survey()->associate($survey->id);
            $question->save();

        }

        return redirect()->to('/dashboard/mostrar-encuestas')->with('success',"Se ha creado la encuesta exitosamente");
    }

   /* Mostrar las encuestas creadas*/
    public function showSurvey () {

        $semesters = Semester::orderBy('name','desc')->paginate(10);

        return view('admin.showSurveys')->with(compact('semesters'));
    }    

    public function selectSurvey ($id) {

        $semesters = Semester::find($id);
        return view('admin.editSurveyForm')->with(compact('semesters'));

    }  

    public function editSurvey (Request $request) {

        $input = $request->all();

        $mensajes = array(
            //campos requeridos
            'name.required' => 'Debe ingresar el nombre de la encuesta.',
            'semester.required' =>  'Debe ingresar el período lectivo.',
            'status.required' => 'Debe asignar un estatus a la encuesta.',
            'start_date.required' => 'Debe ingresar la fecha de inicio de la encuesta.',
            'end_date.required' => 'Debe ingresar la fecha de finalización de la encuesta. ',
        );

        $rules= [
            'name' => 'required',
            'semester' => 'required',
            'status' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ];

        $this->validate($request,$rules,$mensajes);

        $date = DateTime::createFromFormat('d/m/Y',$request->start_date);
        $start_date=  $date->format('d-m-Y');

        $date2 = DateTime::createFromFormat('d/m/Y', $request->end_date);
        $end_date=  $date2->format('d-m-Y');

        $semesters = Semester::find($request->id);

       /* Actualizar período lectivo*/
        $semesters->name = $request->semester;
        $semesters->save();

       /* Obtener id  de la encuesta asociada*/
        foreach ($semesters->survey as $survey) {
            $survey_id = $survey->id;
        }

        /* Actualizar tabla de encuestas*/
        $survey = Survey::find($survey_id);
        $survey->name = $request->name;
        $survey->save();

        /* Actualizar estatus, fecha de inicio y fin*/
        $semesters->survey()->updateExistingPivot($survey_id, ['status'=>$request->status, 'start_date' =>$date, 'end_date' => $date2 ]);

        return redirect()->to('/dashboard/mostrar-encuestas')->with('success',"Se ha configurado la encuesta exitosamente");
    }   




    public function showQuestionsForm($id) {

        /*obtener la encuesta*/
        $survey_id = Semester::whereHas('survey', function($q) use ($id) {
            $q->where('survey_id', $id);
        })->first()->id;

        $semester = Semester::whereHas('survey', function($q) use ($id) {
            $q->where('survey_id', $id);
        })->first()->name;

        /*obtener las preguntas asociadas a la encuesta*/
        $questions = SurveyQuestion::whereHas('survey', function($q) use ($survey_id) {
            $q->where('survey_id',  $survey_id);
        })->paginate(20);
      
        return view('admin.showQuestionForm')->with(compact('questions','survey_id','semester'));
    }


    public function editQuestionsForm($id) {

        /*obtener la encuesta*/
        $survey_id = Semester::whereHas('survey', function($q) use ($id) {
            $q->where('survey_id', $id);
        })->first()->id;

        /*obtener las preguntas asociadas a la encuesta*/
        $questions = SurveyQuestion::whereHas('survey', function($q) use ($survey_id) {
            $q->where('survey_id',  $survey_id);
        })->get();
      
        return view('admin.editQuestionForm')->with(compact('questions','survey_id'));
    }

   
    public function editQuestions(Request $request) {

        $input = $request->all();

        $mensajes = array(
            //campos requeridos
            'question*.required' => 'Debe agregar las preguntas de la encuesta. ',
        );

        for ($i=0 ; $i< count($request["question"]); $i++) {

            $mensajes["question.$i.required"]= "Es necesario que ingrese las preguntas de la encuesta";
        }

        $rules= [
            'question.*' => 'required',
        ];

        $this->validate($request,$rules,$mensajes);

       /* cantidad de preguntas que se van actualizar*/
        $count_update= count($input["questionid"]);

       /* cantidad de preguntas nuevas que se crearán*/
        $count= count($input["question"]);

 
       /* Actualizar  preguntas*/
        for ($i=0 ; $i<$count_update; $i++) {
            
            $questions= SurveyQuestion::find($input["questionid"][$i]);

            $questions->description= $input["question"][$i];
            $questions->save();
        }

        /* Crear  preguntas*/

        for ($i=$count_update ; $i<$count; $i++) {

            $question = SurveyQuestion::create([

            'description' => $input["question"][$i]
            ]);

            $question->survey()->associate($request->survey_id);
            $question->save();
        }

        return redirect()->to('/dashboard/mostrar-encuestas')->with('success',"Se han editado las preguntas de manera exitosa");
    }

    public function deleteSurvey($id) {

        $semester= Semester::find($id);

        foreach ($semester->survey as $survey) {
            $survey_id = $survey->id;
        }

        $survey= Survey::find($survey_id);
        $semester->delete();
        $survey->delete();

        return redirect()->to('/dashboard/mostrar-encuestas')->with('success',"Se ha eliminado la encuesta exitosamente");
    }


   /* Áreas de conocimiento*/

  
    public function createKnowledgeAreaForm(Request $request) {

        return view('admin.createKnowledgeArea');
    }


    public function createKnowledgeAreas(Request $request) {

        $input = $request->all();

        $mensajes = array();

        for ($i=0 ; $i< count($request["area"]); $i++) {

            $mensajes["area.$i.required"]= "Es necesario que ingrese el Área de Conocimiento";
            $mensajes["area.$i.unique"]= "Ya existe un Área de Conocimiento almacenada con este nombre";
        }

        $rules= [
            
            'area.*' => 'required|unique:knowledge_areas,name',
        ];

        $this->validate($request,$rules,$mensajes);

            /*Cantidad de áreas de conocimiento recibidas en el request*/
       
        $count = count($input["area"]);

            for ($i=0; $i<$count; $i++) {

                $area_obligatoria = KnowledgeArea::create([

                'name' => $input["area"][$i]
                ]);
            }

        return redirect()->to('/dashboard')->with('success',"Se han creado las Áreas de Conocimiento exitosamente");
    }


    public function viewKnowledgeAreas() {

        $areas = KnowledgeArea::orderBy('name','desc')->paginate(20);
      
        return view('admin.viewKnowledgeAreas')->with(compact('areas'));
    }


    public function viewSubject($id) {

        $subjects = Subject::where("knowledge_area_id",$id)->paginate(20);

        $knowledgeArea_id = $id;

        return view('admin.viewSubject')->with(compact('subjects','knowledgeArea_id' ));
    }

    public function editSubjectForm($id) {

        /* $id  es el id de las areas de conocimiento*/
        
        /*obtener las materias*/

        $SubjectTypes = SubjectType::all();

        $knowledge_area_id = $id;

        $subjects = Subject::where("knowledge_area_id",$id)->get();

        return view('admin.editSubjectForm')->with(compact('subjects','knowledge_area_id','SubjectTypes'));
    }

    public function editSubject(Request $request) {

      
        $input = $request->all();

        $mensajes = array();

        for ($i=0 ; $i< count($request["subject"]); $i++) {

            $mensajes["subject.$i.required"]= "Es necesario que ingrese el nombre de la materia";

            $mensajes["subject_code.$i.required"]= "Es necesario que ingrese el código de la materia";

            $mensajes["semester.$i.required"]= "Es necesario que ingrese el semestre";
        }

        $rules= [
            'subject.*' => 'required',
            'subject_code.*' => 'required',
            'semester.*' => 'required',
        ];

        $this->validate($request,$rules,$mensajes);


       /* cantidad de preguntas que se van actualizar*/
        $count_update= count($input["subjectId"]);

       /* cantidad de preguntas nuevas que se crearán*/
        $count= count($input["subject"]);

       /* Actualizar  materias*/
        for ($i=0 ; $i<$count_update; $i++) {
            
            $subject= Subject::find($input["subjectId"][$i]);

            $subject->name = $input["subject"][$i];
            $subject->save();
        }

        /* Crear  materias*/

        for ($i=$count_update ; $i<$count; $i++) {

            $subject = Subject::create([

            'name' => $input["subject"][$i],
            'cod' => $input["subject_code"][$i],
            'semester' => $input["semester"][$i]
            ]);

            $subject_type_id = SubjectType::where("name", $input["subject_type"][$i])->first()->id;

            $subject->knowledge_area()->associate($request->knowledge_area_id);
            $subject->type_subject()->associate($subject_type_id );

            $subject->save();
        }

        return redirect()->to('/dashboard/ver-areas')->with('success',"Se han editado las materias de manera exitosa");
       
    }


    public function deleteSubject($id) {

        $subject = Subject::find($id);
        $subject->delete();
        return redirect()->to('/dashboard/ver-areas')->with('success',"Se ha eliminado el la materia exitosamente");
    }

    public function deleteArea($id) {

        $area = KnowledgeArea::find($id);
        $area->delete();
        return redirect()->to('/dashboard/ver-areas')->with('success',"Se ha eliminado el Área de Conocimiento");
    }

   /* Enviar encuestas a los estudiantes */


    public function sendSurveyButton(){

        $CountSurvey = SemesterSurvey::where("status","1")->count();

       /* Solo debe haber una encuesta activa*/
        if ($CountSurvey != 1){

            return redirect()->to('/dashboard')->with('error',"Verifique que haya una sola encuesta activa"); 
        }


        $Semester_id = SemesterSurvey::where("status","1")->pluck("semester_id");

        $Survey_id = SemesterSurvey::where("status","1")->pluck("survey_id");


        $Semester = Semester::where("id",$Semester_id)->pluck("name");

        $Survey = Survey::where("id",$Survey_id)->pluck("name");


        return view('admin.showSurveyButton',['Semester' => $Semester, '$Survey' =>$Survey]);

    }

    public function ConfirmSendSurveyButton(Request $request){

        return view('admin.showSurveyButton',['rol' => $rol])->with(compact('users'));

    }
  



}
