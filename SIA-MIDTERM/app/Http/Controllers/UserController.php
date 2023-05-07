<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Student;

Class StudentController extends Controller {
    private $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }
    public function getStudents()
    {
        $students =Student::all();
        return response()->json(['data' => $students], 200);
    }

    public function addStudent(Request $request){
        
        $rules = [
            'lastname' => 'required|max:20',
            'firstname' => 'required|max:20',
            'middlename' => 'required|max:20',
            'bday' => 'required|max:20',
            'age'=> 'required|max:50'
        ];

        $this->validate($request,$rules);

        $student = Student::create($request->all());
        return response()->json($student, 200);
    }
    
    public function updateStudent(Request $request, $id) {
        $rules = [
            'lastname' => 'required|max:20',
            'firstname' => 'required|max:20',
            'middlename' => 'required|max:20',
            'bday' => 'required|max:20',
            'age'=> 'required|max:50'
        ];
    
        $this->validate($request, $rules);
    
        $student = Student::findOrFail($id);
    
        $student->fill($request->all());
    
        if ($user->isClean()) {
            return response()->json("At least one value must
            change", 403);
        } else {
            $user->save();
            return response()->json($student, 200);
        }
    }

    public function deletestudent($id) {
        $student = Student::findOrFail($id);
    
        $student->delete();
    
        return response()->json($student, 200);
    }
}
