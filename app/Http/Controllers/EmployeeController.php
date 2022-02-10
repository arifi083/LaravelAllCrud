<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Illuminate\Support\Facades\Validator;
class EmployeeController extends Controller
{
     public function index(){
         return view('employee.index');
     }

     public function store(Request $request)
     {
         //dd($request->all());
         $validator = Validator::make($request->all(), 
             [
                 'name'=>'required|max:191',
                 'email'=>'required|email|max:191',
                 'phone'=>'required|max:191',
                 'position'=>'required|max:191',
 
             ]
         );
 
         if($validator->fails())
         {
             return response()->json([
                 'status'=>400,
                 'errors'=> $validator->messages(),
             ]);
         }
         else
         {
             $employee = new Employee();
             $employee->name = $request->input('name');
             $employee->email = $request->input('email');
             $employee->phone = $request->input('phone');
             $employee->position = $request->input('position');
             $employee->save();
             return response()->json([
                 'status'=>200,
                 'message'=> 'Employee Added Successfully',
             ]);
         }
 
     }//end method

     public function getEmployee()
     {
         $employees = Employee::all();
         return response()->json([
             'students'=>$employees,
         ]);
     }



     public function editEmployee($id)
     {
         $employee = Employee::find($id);
         if($employee)
         {
             return response()->json([
                 'status'=>200,
                 'employee'=>$employee,
             ]);
         }
         else
         {
             return response()->json([
                 'status'=>404,
                 'message'=>'Employee Not Found',
             ]);
         }
     }//end method



     public function updateEmployee(Request $request,$id)
    {
        $validator = Validator::make($request->all(), 
            [
                'name'=>'required|max:191',
                'email'=>'required|email|max:191',
                'phone'=>'required|max:191',
                'position'=>'required|max:191',

            ]
        );

        if($validator->fails())
        {
            return response()->json([
                'status'=>400,
                'errors'=> $validator->messages(),
            ]);
        }
        else
        {
            $employee = Employee::find($id);
            if($employee)
            { 
                $employee->name = $request->input('name');
                $employee->email = $request->input('email');
                $employee->phone = $request->input('phone');
                $employee->position = $request->input('position');
                $employee->update();
                return response()->json([
                    'status'=>200,
                    'message'=> 'Employee Updated Successfully',
                ]);
                
            }
            else
            {
                return response()->json([
                    'status'=>404,
                    'message'=>'Employee Not Found',
                ]);
            }
           
        }

    }//end method


    public function deleteEmployee($id)
    {
        $employee = Employee::find($id);
        $employee->delete();

        return response()->json([
            'status'=>200,
            'message'=> 'Employee Deleted Successfully',
        ]);

    }

 
}
