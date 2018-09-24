<?php
namespace OSD\Http\Controllers;
use Illuminate\Http\Request;
use OSD\Http\Controllers\Controller;
use OSD\KnowledgeArea;
use OSD\SubKnowledgeArea;
use OSD\Teacher;
use OSD\Coordinator;
use OSD\SubKnowledgeAreaCoordinator;
use OSD\Subject;
use OSD\Section;
use OSD\Semester;
use OSD\SubjectType;
use OSD\SubjectProgramming;
use OSD\Student;
use OSD\StudentProgramming;
use OSD\User;
use OSD\UserType;
use DB;

use Excel;
use File;

class FileController extends Controller {

    public function importExportExcelORCSV(){

        return view('admin.masiveUploadForm');
    }

    public function importFileIntoDB(Request $request){

    	$elements = [3.22,3.33,3.44,3.55,3.45,3.77,4.12,4.16,4.55,4.78,4.33,4.49,4.89,4.21,4.66,4.88,4.66,4.99,4.79,3.10,3.02,4.31,4.57,4.41,3.09,3.03,3.99];


        if($request->hasFile('sample_file')){

            $path = $request->file('sample_file')->getRealPath();
            
            $data = Excel::load($path)->get();
            
            if($data->count()){

                foreach ($data as $key => $value) {
                    
                 /*   $arr1[] = ['nombre_area' => $value->nombre_area, 'details' => $value->details];
                    $arr2[] = ['nombre_sub_area' => $value->nombre_sub_area, 'id' => $value->id];*/

                    $Semester[] = ['nombre_periodo_lectivo' => $value->nombre_periodo_lectivo];

                    $Section[] = ['seccion_nombre' => $value->seccion_nombre];

                    $KnowledgeAreas[] = ['nombre_area' => $value->nombre_area];
                    
                    $SubKnowledgeAreas[] = ['nombre_sub_area' => $value->nombre_sub_area,
                    						'area_asociada' => $value->area_asociada
                							];
                    
                    $Teachers[] = 

	                    		['nombre_profesor' => $value->nombre_profesor,
	            			     'profesor_ci' => $value->profesor_ci , 
	            			     'profesor_email' => $value->profesor_email , 
	            			     'profesor_codigo_materia' => $value->profesor_codigo_materia,
	            			     'profesor_seccion_materia' => $value->profesor_seccion_materia,
	                    		];

                    $AreaCoordinators[] = 

                				['coordinador_area_nombre' => $value->coordinador_area_nombre,
        					     'coordinador_area_ci' => $value->coordinador_area_ci,
        					     'coordinador_area_email' => $value->coordinador_area_email,
        					     'coordinador_area_asociada' => $value->coordinador_area_asociada,
            					];

                	$SubAreaCoordinators[] = 

            					['coordinador_sub_area_nombre' => $value->coordinador_sub_area_nombre,
        					     'coordinador_sub_area_ci' => $value->coordinador_sub_area_ci,
        					     'coordinador_sub_area_email' => $value->coordinador_sub_area_email,
        					     'coordinador_sub_area_asociada' => $value->coordinador_sub_area_asociada,
                					  
            					];

                	$MateriasObligatoriasAreas[] = 

            					['materia_obligatoria_nombre_area' => $value->materia_obligatoria_nombre_area,  
        				         'area_nombre_materia_obligatoria' => $value->area_nombre_materia_obligatoria,
        					     'area_materia_obligatoria_cod' => $value->area_materia_obligatoria_cod,
        					     'area_materia_obligatoria_semestre' => $value->area_materia_obligatoria_semestre,
                					  
            					];

                	$MateriasObligatoriasSubAreas[] = 

            					['materia_obligatoria_nombre_sub_area' => $value->materia_obligatoria_nombre_sub_area,  
        				         'sub_area_nombre_materia_obligatoria' => $value->sub_area_nombre_materia_obligatoria,
        					     'sub_area_materia_obligatoria_cod' => $value->sub_area_materia_obligatoria_cod,
        					     'sub_area_materia_obligatoria_semestre' => $value->sub_area_materia_obligatoria_semestre,
                					  
            					];

                	$MateriasElectivasAreas[] = 

            					['materia_electiva_nombre_area' => $value->materia_electiva_nombre_area,  
        				         'area_nombre_materia_electiva' => $value->area_nombre_materia_electiva,
        					     'area_materia_electiva_cod' => $value->area_materia_electiva_cod,
        					     'area_materia_electiva_semestre' => $value->area_materia_electiva_semestre,
                					  
            					];

            		$Students[] = 

            					['estudiante_nombres' => $value->estudiante_nombres,  
        				         'estudiante_apellidos' => $value->estudiante_apellidos,
        					     'estudiante_ci' => $value->estudiante_ci,
        					     'estudiante_email' => $value->estudiante_email,
        					     'estudiante_asignatura_1' => $value->estudiante_asignatura_1,
        					     'estudiante_cod_asignatura_1' => $value->estudiante_cod_asignatura_1,
        					     'estudiante_seccion_1' => $value->estudiante_seccion_1,
        					     'estudiante_asignatura_2' => $value->estudiante_asignatura_2,
        					     'estudiante_cod_asignatura_2' => $value->estudiante_cod_asignatura_2,
        					     'estudiante_seccion_2' => $value->estudiante_seccion_2,
        					     'estudiante_asignatura_3' => $value->estudiante_asignatura_3,
        					     'estudiante_cod_asignatura_3' => $value->estudiante_cod_asignatura_3,
        					     'estudiante_seccion_3' => $value->estudiante_seccion_3,
        					     'estudiante_asignatura_4' => $value->estudiante_asignatura_4,
        					     'estudiante_cod_asignatura_4' => $value->estudiante_cod_asignatura_4,
        					     'estudiante_seccion_4' => $value->estudiante_seccion_4,
        					     'estudiante_asignatura_5' => $value->estudiante_asignatura_5,
        					     'estudiante_cod_asignatura_5' => $value->estudiante_cod_asignatura_5,
        					     'estudiante_seccion_5' => $value->estudiante_seccion_5,
        					     'estudiante_asignatura_6' => $value->estudiante_asignatura_6,
        					     'estudiante_cod_asignatura_6' => $value->estudiante_cod_asignatura_6,
        					     'estudiante_seccion_6' => $value->estudiante_seccion_6,
        					     'estudiante_asignatura_7' => $value->estudiante_asignatura_7,
        					     'estudiante_cod_asignatura_7' => $value->estudiante_cod_asignatura_7,
        					     'estudiante_seccion_7' => $value->estudiante_seccion_7,
        					     'estudiante_asignatura_8' => $value->estudiante_asignatura_8,
        					     'estudiante_cod_asignatura_8' => $value->estudiante_cod_asignatura_8,
        					     'estudiante_seccion_8' => $value->estudiante_seccion_8,
        					     'estudiante_asignatura_9' => $value->estudiante_asignatura_9,
        					     'estudiante_cod_asignatura_9' => $value->estudiante_cod_asignatura_9,
        					     'estudiante_seccion_9' => $value->estudiante_seccion_9,
        					    
                					  
            					];
                					
                }

               /* Funcion para filtrar valores nulos*/
               	$c = function($v){
				   
				    return array_filter($v) != array();
				};

			   /*Datos filtrados, quitando valores NULL*/

			    $SemesterFilter = array_filter($Semester, $c);

			    $SectionFilter = array_filter($Section, $c);

				$KnowledgeAreasFilter = array_filter($KnowledgeAreas, $c);

				$SubKnowledgeAreasFilter = array_filter($SubKnowledgeAreas, $c);

				$TeachersFilter = array_filter($Teachers, $c);

				/*$resultado = array_unique($TeachersFilter);*/


				/*Funcion para tener un arreglo sin elementos repetidos, para no guardar el mismo profesor 
				dos veces*/
				
				function unique_multidim_array($array, $key) { 
					    $temp_array = array(); 
					    $i = 0; 
					    $key_array = array(); 
					    
					    foreach($array as $val) { 
					        if (!in_array($val[$key], $key_array)) { 
					            $key_array[$i] = $val[$key]; 
					            $temp_array[$i] = $val; 
					        } 
					        $i++; 
					    } 
					    return $temp_array; 
				} 


				$AreaCoordinatorsFilter = array_filter($AreaCoordinators, $c);

				$SubAreaCoordinatorsFilter = array_filter($SubAreaCoordinators, $c);

				$MateriasObligatoriasAreasFilter = array_filter($MateriasObligatoriasAreas, $c);

				$MateriasObligatoriasSubAreasFilter = array_filter($MateriasObligatoriasSubAreas, $c);

				$MateriasElectivasAreasFilter = array_filter($MateriasElectivasAreas, $c);

				$StudentsFilter = array_filter($Students, $c);

				/*tipos de usuarios*/

				$TypeStudent_id = UserType::where("description", "Estudiante")->first()->id;

				$TypeTeacher_id = UserType::where("description", "Profesor")->first()->id;

				$TypeAreaCoordinator_id = UserType::where("description", "Coordinador_areas")->first()->id;

				$TypeSubAreaCoordinator_id = UserType::where("description", "Coordinador_sub_areas")->first()->id;


				/*Creando Peŕiodo lectivo*/

				foreach($SemesterFilter as $key=>$data) {

					Semester::create([
			            'name' => $data["nombre_periodo_lectivo"]
			        ]);

				}

				/*Creando Secciones*/

				DB::table('sections')->delete();

				foreach($SectionFilter as $key=>$data) {

					
					Section::create([
			            'name' => $data["seccion_nombre"]
			        ]);

				}

				/*Creando Áreas de Conocimiento*/

				DB::table('knowledge_areas')->delete();

				foreach($KnowledgeAreasFilter as $key=>$data) {

					KnowledgeArea::create([
			            'name' => $data["nombre_area"],
			            'score' => $elements[array_rand($elements)],
			        ]);

				}
				
				/*Creando Sub Áreas de Conocimiento*/

				DB::table('sub_knowledge_areas')->delete();

				foreach($SubKnowledgeAreasFilter as $key=>$data) {

					$subKnowledgeArea = SubKnowledgeArea::create([
			            'name' => $data["nombre_sub_area"],
			            'score' => $elements[array_rand($elements)],
			        ]);

					$KnowledgeAreaId = KnowledgeArea::where("name",$data["area_asociada"])->first()->id;

					$subKnowledgeArea->knowledgeArea()->associate($KnowledgeAreaId);
        			
        			$subKnowledgeArea->save();

				}

				

				/*Creando Coordinadores de Áreas*/

				DB::table('coordinators')->delete();

				foreach($AreaCoordinatorsFilter as $key=>$data) {

					$KnowledgeArea = KnowledgeArea::where("name",$data["coordinador_area_asociada"])->first();

					$KnowledgeAreaId = $KnowledgeArea->id;

					$coordinator = Coordinator::create([
						
			            'name' => $data["coordinador_area_nombre"],
			            'ci' => $data["coordinador_area_ci"],
			            'email' => $data["coordinador_area_email"],
			            
			           
			        ]);
						/*asociando a sus areas de conocmiento*/

			          	$coordinator->knowledge_area()->associate($KnowledgeAreaId);
       					$coordinator->save();
				

	       				 $user = User::create([

				            'name' => $data["coordinador_area_nombre"],
				            'ci' => $data["coordinador_area_ci"],
				            'email' => $data["coordinador_area_email"],
				            'password' => bcrypt($data["coordinador_area_ci"]),
				            
				        ]);
					
				        $user->type_user()->associate($TypeAreaCoordinator_id);
	        			$user->save();


				}



				/*Creando Coordinadores de Sub Áreas*/

				DB::table('sub_knowledge_area_coordinators')->delete();

				foreach($SubAreaCoordinatorsFilter as $key=>$data) {

					$SubKnowledgeArea = SubKnowledgeArea::where("name",$data["coordinador_sub_area_asociada"])->first();
				
					$SubKnowledgeAreaId = $SubKnowledgeArea->id;

					$SubAreaCoordinator = SubKnowledgeAreaCoordinator::create([
						
			            'name' => $data["coordinador_sub_area_nombre"],
			            'ci' => $data["coordinador_sub_area_ci"],
			            'email' => $data["coordinador_sub_area_email"],

			        ]);
						/*asociando a sus areas de conocmiento*/
						
			          	$SubAreaCoordinator->sub_knowledge_area()->associate($SubKnowledgeAreaId);
       					$SubAreaCoordinator->save();



       				$user = User::create([

				            'name' => $data["coordinador_sub_area_nombre"],
				            'ci' => $data["coordinador_sub_area_ci"],
				            'email' => $data["coordinador_sub_area_email"],
				            'password' => bcrypt($data["coordinador_sub_area_ci"]),
				            
				        ]);
					
				    $user->type_user()->associate($TypeSubAreaCoordinator_id);
	        	    $user->save();

				}


				/*Creando Materias Obligatorias de las  Áreas*/

				DB::table('subjects')->delete();

				
				foreach($MateriasObligatoriasAreasFilter as $key=>$data) {

					$SubjectType = SubjectType::where("name","Obligatoria")->first();
					
					$SubjectTypeId = $SubjectType->id;

					$KnowledgeArea = KnowledgeArea::where("name",$data["materia_obligatoria_nombre_area"])->first();

					$KnowledgeAreaId = $KnowledgeArea->id;


					$Subject = Subject::create([
						
			            'name' => $data["area_nombre_materia_obligatoria"],
			            'cod' => $data["area_materia_obligatoria_cod"],
			            'semester' => $data["area_materia_obligatoria_semestre"],

			        ]);
						/*asociando a sus areas de conocmiento*/
						
			          	$Subject->knowledge_area()->associate($KnowledgeAreaId);

			          	$Subject->type_subject()->associate($SubjectType);

       					$Subject->save();

				}


				/*Creando Materias Obligatorias de las  Sub Áreas*/

			
				foreach($MateriasObligatoriasSubAreasFilter as $key=>$data) {

					$SubjectType = SubjectType::where("name","Obligatoria")->first();
					
					$SubjectTypeId = $SubjectType->id;

					$SubKnowledgeArea = SubKnowledgeArea::where("name",$data["materia_obligatoria_nombre_sub_area"])->first();

					$SubKnowledgeAreaId = $SubKnowledgeArea->id;


					$Subject = Subject::create([
						
			            'name' => $data["sub_area_nombre_materia_obligatoria"],
			            'cod' => $data["sub_area_materia_obligatoria_cod"],
			            'semester' => $data["sub_area_materia_obligatoria_semestre"],

			        ]);
						/*asociando a sus areas de conocmiento*/
						
			          	$Subject->sub_knowledge_area()->associate($SubKnowledgeAreaId);

			          	$Subject->type_subject()->associate($SubjectType);

       					$Subject->save();

				}


				/*Creando Materias Electivas de las Áreas*/

			
				foreach( $MateriasElectivasAreasFilter as $key=>$data ) {

					$SubjectType = SubjectType::where("name","Electiva")->first();
					
					$SubjectTypeId = $SubjectType->id;

					$KnowledgeArea = KnowledgeArea::where("name",$data["materia_electiva_nombre_area"])->first();

					$KnowledgeAreaId = $KnowledgeArea->id;


					$Subject = Subject::create([
						
			            'name' => $data["area_nombre_materia_electiva"],
			            'cod' => $data["area_materia_electiva_cod"],
			            'semester' => $data["area_materia_electiva_semestre"],

			        ]);
						/*asociando a sus areas de conocmiento*/
						
			          	$Subject->knowledge_area()->associate($KnowledgeAreaId);

			          	$Subject->type_subject()->associate($SubjectType);

       					$Subject->save();

				}


				/*Creando Profesores*/

				$noRepeatTeachers = unique_multidim_array($TeachersFilter,'profesor_ci'); 

				DB::table('teachers')->delete();

				foreach($noRepeatTeachers as $key=>$data) {

					$codMateria = $data["profesor_codigo_materia"];

					$subject = Subject::where('cod',$codMateria)->first();

					if ($subject->knowledge_area_id !=NULL) {

						$area_id = KnowledgeArea::find($subject->knowledge_area_id);
						
						$teacher = Teacher::create([

			            'name' => $data["nombre_profesor"],
			            'ci' => $data["profesor_ci"],
			            'email' => $data["profesor_email"],
			            'score' => $elements[array_rand($elements)],

			        	]);

			        	$teacher->knowledge_area()->associate($area_id->id);
			        	$teacher->save();
					}

					if ($subject->sub_knowledge_area_id !=NULL) {

						$area_id = SubKnowledgeArea::find($subject->sub_knowledge_area_id);

						$teacher = Teacher::create([

			            'name' => $data["nombre_profesor"],
			            'ci' => $data["profesor_ci"],
			            'email' => $data["profesor_email"],
			            'score' => $elements[array_rand($elements)],

			        	]);

			        	$teacher->sub_knowledge_area()->associate($area_id->id);
			        	$teacher->save();
					}

			        $user = User::create([

			            'name' => $data["nombre_profesor"],
			            'ci' => $data["profesor_ci"],
			            'email' => $data["profesor_email"],
			            'password' => bcrypt($data["profesor_ci"]),
			            
			        ]);

				
			        $user->type_user()->associate($TypeTeacher_id);
        			$user->save();

				}


				/*Creando estudiantes*/
				
				DB::table('students')->delete();

				foreach( $StudentsFilter as $key=>$data ) {

					$Students = Student::create([
						
			            'name' => $data["estudiante_nombres"],
			            'lastname' => $data["estudiante_apellidos"],
			            'ci' => $data["estudiante_ci"],
			            'email' => $data["estudiante_email"],
			            'score' => $elements[array_rand($elements)],

			        ]);


			        $user = User::create([

			            'name' => $data["estudiante_nombres"]." ".$data["estudiante_apellidos"],
			            'ci' => $data["estudiante_ci"],
			            'email' => $data["estudiante_email"],
			         
			        ]);

			        $user->type_user()->associate($TypeStudent_id);
	        	    $user->save();
				
				}


			/*Creando programación de las materias*/

			$semester = Semester::where("name",$Semester[0]["nombre_periodo_lectivo"])->first();
			
			$semester_id = $semester->id;		
					

			foreach($TeachersFilter as $key=>$data) {

			
				$subject= Subject::where("cod",$data["profesor_codigo_materia"])->first();

				$section = Section::where("name",$data["profesor_seccion_materia"])->first();
				
				$section_id = $section->id;

				$teacher = Teacher::where("ci",$data["profesor_ci"])->first();

				$teacher_id = $teacher->id;	

				$subject_id = $subject->id;

     			/*creando la relacion  muchos a muchos  subject programming*/

            	$subject = Subject::find($subject_id);

				$subject->semester()->attach(

                                $semester_id,
                                [
                                    'section_id' => $section_id, 
                                    'teacher_id' => $teacher_id,
                                                  
                                ]);
			}



			/*Creando programación de estudiantes*/

			$semester = Semester::where("name",$Semester[0]["nombre_periodo_lectivo"])->first();
			
			$semester_id = $semester->id;		
					

			foreach($StudentsFilter as $key=>$data) {

				if($data["estudiante_cod_asignatura_1"]!= NULL) {

					$student = Student::where("ci",$data["estudiante_ci"])->first();

					$subject = Subject::where("cod",$data["estudiante_cod_asignatura_1"])->first();

					$subjectProgramming = SubjectProgramming::where("subject_id",$subject->id)->first();

					$student = Student::find($student->id);

					$student->subject_programming()->attach(
                                    $subjectProgramming->id
                                    );


				}

				if($data["estudiante_cod_asignatura_2"]!= NULL) {

					$student = Student::where("ci",$data["estudiante_ci"])->first();

					$subject = Subject::where("cod",$data["estudiante_cod_asignatura_2"])->first();

					$subjectProgramming = SubjectProgramming::where("subject_id",$subject->id)->first();

					$student = Student::find($student->id);

					$student->subject_programming()->attach(
                                    $subjectProgramming->id
                                    );

				}

				if($data["estudiante_cod_asignatura_3"]!= NULL) {

					$student = Student::where("ci",$data["estudiante_ci"])->first();

					$subject = Subject::where("cod",$data["estudiante_cod_asignatura_3"])->first();

					$subjectProgramming = SubjectProgramming::where("subject_id",$subject->id)->first();

					$student = Student::find($student->id);

					$student->subject_programming()->attach(
                                    $subjectProgramming->id
                                    );


				}

				if($data["estudiante_cod_asignatura_4"]!= NULL) {

					$student = Student::where("ci",$data["estudiante_ci"])->first();

					$subject = Subject::where("cod",$data["estudiante_cod_asignatura_4"])->first();

					$subjectProgramming = SubjectProgramming::where("subject_id",$subject->id)->first();

					$student = Student::find($student->id);

					$student->subject_programming()->attach(
                                    $subjectProgramming->id
                                    );

				}

				if($data["estudiante_cod_asignatura_5"]!= NULL) {

					$student = Student::where("ci",$data["estudiante_ci"])->first();

					$subject = Subject::where("cod",$data["estudiante_cod_asignatura_5"])->first();

					$subjectProgramming = SubjectProgramming::where("subject_id",$subject->id)->first();

					$student = Student::find($student->id);

					$student->subject_programming()->attach(
                                    $subjectProgramming->id
                                    );


				}

				if($data["estudiante_cod_asignatura_6"]!= NULL) {

					$student = Student::where("ci",$data["estudiante_ci"])->first();

					$subject = Subject::where("cod",$data["estudiante_cod_asignatura_6"])->first();

					$subjectProgramming = SubjectProgramming::where("subject_id",$subject->id)->first();

					$student = Student::find($student->id);

					$student->subject_programming()->attach(
                                    $subjectProgramming->id
                                    );

				}

				if($data["estudiante_cod_asignatura_7"]!= NULL) {

					$student = Student::where("ci",$data["estudiante_ci"])->first();

					$subject = Subject::where("cod",$data["estudiante_cod_asignatura_7"])->first();

					$subjectProgramming = SubjectProgramming::where("subject_id",$subject->id)->first();

					$student = Student::find($student->id);

					$student->subject_programming()->attach(
                                    $subjectProgramming->id
                                    );

				}

				if($data["estudiante_cod_asignatura_8"]!= NULL) {

					$student = Student::where("ci",$data["estudiante_ci"])->first();

					$subject = Subject::where("cod",$data["estudiante_cod_asignatura_8"])->first();

					$subjectProgramming = SubjectProgramming::where("subject_id",$subject->id)->first();

					$student = Student::find($student->id);

					$student->subject_programming()->attach(
                                    $subjectProgramming->id
                                    );

				}

				if($data["estudiante_cod_asignatura_9"]!= NULL) {

					$student = Student::where("ci",$data["estudiante_ci"])->first();

					$subject = Subject::where("cod",$data["estudiante_cod_asignatura_9"])->first();

					$subjectProgramming = SubjectProgramming::where("subject_id",$subject->id)->first();

					$student = Student::find($student->id);

					$student->subject_programming()->attach(
                                    $subjectProgramming->id
                                    );

				}

			}

                return redirect()->to('/dashboard')->with('success',"Se han cargado los datos exitosamente");
             
            }
        }

        return redirect()->to('/cargar-datos')->with('error',"No se ha adjuntado ningun archivo");     
    } 

    public function downloadExcelFile($type){

        $products = Product::get()->toArray();

        return Excel::create('expertphp_demo', function($excel) use ($products) {

            $excel->sheet('sheet name', function($sheet) use ($products)
            {
                $sheet->fromArray($products);
            });
        })->download($type);
    }      
}
