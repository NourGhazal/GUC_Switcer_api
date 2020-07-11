<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\fifthyear;

class FifthYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'major' => 'required',
            'from' => 'required',
            'to' => 'required',
            'extra_courses' => 'required',
            'id' => 'required'
        ]);
        $match = DB::table('fifthyear')->where('to',$request->from)
        -> where('from',$request->to)->where('major',$request->major) ->first();
            if($match == null){
        $fifthyear = fifthyear::create($request->all());
        return response()->json([
            'message' => 'your switch was stored successfully',
            'switch' => $fifthyear
        ]);
    }
    else{
        DB::table('fifthyear')->where('id',$match->id)->delete();
        $user = DB::table('users')->where('id',$match->id);
        $return =[
            'email' => $user->personal_mail,
            'phone' => $user->phone_num,
            'name' => $user->name,

        ];
        return response()->json([
            'message' => 'found a match',
            'match' => $return
        ]);

    }
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
    }
}
