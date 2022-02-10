<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deposit;
use DB;

class DepositController extends Controller
{
    public function index(){

        $deposits = Deposit::latest()->get();
        //dd($deposits);
        return view('deposit.index',compact('deposits'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $request->validate([
            'name' => 'required',
            'amount' => 'required',
        ]);
    
        Deposit::create($request->all());
     
        return redirect()->route('deposit.index')
                        ->with('success','Deposit created successfully.');
    
    }


    public function update(Request $request,$id)
    {
        //dd($request->all());
        $dep_id = $request->edit_id;
        //dd($dep_id);
        //return $id;
    

       // Deposit::find($dep_id)->update($request->all());
        $data = array();
        $data['name'] = $request->name1;
        $data['amount'] = $request->amount1;
        $data['note'] = $request->note1;
        DB::table('deposits')->where('id',$dep_id)->update($data);
        
        return redirect()->route('deposit.index')->with('success','Deposit Updated Successfully.');

    }

    public function delete($id){
        $deposit = Deposit::find($id);
        //dd($post);
        $deposit->delete();
        return redirect()->route('deposit.index')
                        ->with('success','Deposit deleted successfully');
    }
}
