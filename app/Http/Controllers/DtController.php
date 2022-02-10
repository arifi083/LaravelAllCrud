<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Datatables;

class DtController extends Controller
{
    public function index()
    {
    	return view('department.data_table');
    }

    // public function getData(){
    // 	return datatables::eloquent(Student::query())->make(true);
    // }


    //     public function getData()
    // {
    //     $users = Student::select(['id', 'name', 'dept', 'created_at', 'updated_at']);

    //     return DataTables::eloquent($users)->toJson();
    // }
    public function getData(){
    	$users = Department::select(['id', 'name', 'dept', 'created_at', 'updated_at']);

        return Datatables::of($users)
            ->addColumn('action', function ($user) {
                return '<a id="'.$user->id.'" href="#" class="btn btn-xs btn-primary edit"><i class="glyphicon glyphicon-edit"></i> Edit</a>
                    <a id="'.$user->id.'" href="#" class="btn btn-xs btn-danger delete"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
            })
            // ->editColumn('id', ' {{$id}}')
            ->make(true);
    }

    public function postData(Request $request)
    {
    	$student=new Department();
    	$student->name=$request->name;
    	$student->dept=$request->dept;
    	$student->created_at=date('Y-m-d H:m:s');
    	$student->updated_at=date('Y-m-d H:m:s');
    	$std = $student->save();
    	if($std)
    	{
    		return "success";
    	}
    	else
    		return "error";

    }

    public function editData($id)
    {

        $student = Department::find($id);
        return $student;
    }


    public function updateData(Request $request, $id)
    {
        $student=Department::find($id);

        $student->name = $request->name;
        $student->dept = $request->dept;
        $student->update();
        return "success";

    }

     public function deleteData($id)
    {

        $student = Department::find($id);
        $student->delete();
        return "success";
    }

}
