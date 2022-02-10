<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    public function studentView(){

        $students = Student::orderBy('id','DESC')->get();
        return view('student.view_student',compact('students'));
    }

    public function studentAdd(Request $request){ 
       // dd($request->all());
        $student = new Student();
        $student->firstname = $request->firstname;
        $student->lastname = $request->lastname;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->save();
        return response()->json($student);

    }

    public function getStudentById($id){
        $student = Student::find($id);
        return response()->json($student);
    }

    public function studentUpdate(Request $request){
         //dd($request->all());
         $student = Student::find($request->id);
         $student->firstname = $request->firstname;
         $student->lastname = $request->lastname;
         $student->email = $request->email;
         $student->phone = $request->phone;
         $student->save();
         //dd($student);
         return response()->json($student);
 
     }
   
}
