<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use App\Model\Student;



class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $students=DB::table('students')->get();
        // $students=Student::all(); //Eloqurent orm
        return response()->json($students);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'class_id' => 'required',
            'section_id' => 'required',
            'name' => 'required',
            'email' => 'required|unique:students|max:25',
            'phone' => 'required',
            'password' => 'required|unique:students|max:25',
            'address' => 'required',
            'gender' => 'required',
            'photo' => 'required|unique:students'
            
        ]);

        $data=array();
        $data['class_id']=$request->class_id;
        $data['section_id']=$request->section_id;
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['password']=Hash::make($request->password);
        $data['address']=$request->address;
        $data['gender']=$request->gender;
        $data['photo']=$request->photo;

        $insert=DB::table('students')->insert($data);
        return response()->json($insert);

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
        $getdata=DB::table('students')->where('id',$id)->first();
        return response()->json($getdata);
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
        //

        $validatedData = $request->validate([
            'class_id' => 'required',
            'section_id' => 'required',
            'name' => 'required',
            'email' => 'required|max:25',
            'phone' => 'required',
            'password' => 'required|unique:students|max:25',
            'address' => 'required',
            'gender' => 'required',
            'photo' => 'required'
            
        ]);

        $data=array();
        $data['class_id']=$request->class_id;
        $data['section_id']=$request->section_id;
        $data['name']=$request->name;
        $data['email']=$request->email;
        $data['phone']=$request->phone;
        $data['password']=Hash::make($request->password);
        $data['address']=$request->address;
        $data['gender']=$request->gender;
        $data['photo']=$request->photo;


        //Eloquent Orm
        // $data=new Student;
        // $data->class_id=$request->class_id;
        // $data->section_id=$request->section_id;
        // $data->name=$request->name;
        // $data->email=$request->email;
        // $data->phone=$request->phone;
        // $data->password=Hash::make($request->password);
        // $data->address=$request->address;
        // $data->gender=$request->gender;
        // $data->photo=$request->photo;

        $update=DB::table('students')->where('id',$id)->update($data);
        return response()->json($update);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $getRow=DB::table('students')->where('id',$id)->first();
        $unlinkimg=unlink($getRow->photo);

        if($unlinkimg)
        {
            $dlt=DB::table('students')->where('id',$id)->delete();
            return response()->json($dlt);
        }

        else
        {
            return response()->json($unlinkimg);
        }

    }
}
