<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\thirdyear;
use Illuminate\Support\Arr;


class ThirdYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(thirdyear::all(),200);
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
            'user_id' => 'required'
        ]);
        $to = $request->input('to');
        $from = $request->input('from');
        $extra_courses = $request->input('extra_courses');
        $id = $request->input('user_id');
        $major = $request->input('major');
        $match = DB::table('thirdyear')->where('major',$major)->where('extra_courses',$extra_courses) ->get();
         $match= $match-> where('to',$from)-> orwhere('from',$to)->get() ;
         $switchuser=null;
         foreach($match as $user){
             if($user->from == $to && $user->to == $from){
                $switchuser = [$user];
             break;
             }
             if($user->to == $from){
                 foreach($match as $user2){
                if($user->from==$user2->to && $to==$user2->from){
                    $switchuser=[$user,$user2];
                   
                break;
                }
                 }
             }
             if($switchuser!= null){
             break;
             }
         }
            if($switchuser == null){
                $thirdyear = new thirdyear;
                $thirdyear->user_id=$id;
                $thirdyear->major=$major;
                $thirdyear->from=$from;
                $thirdyear->to=$to;
                $thirdyear->extra_courses=$extra_courses;
                $thirdyear->save();
        return response()->json([
            'message' => 'your switch was stored successfully',
            'switch' => $thirdyear
        ]);
    }
    else{
        $found=[];
        foreach($switchuser as $deleted){
            $this->destroy($deleted->id);
            $user = DB::table('users')->where('id',$deleted->id);
              $return =[
            'email' => $user->personal_mail,
            'phone' => $user->phone_num,
            'name' => $user->name,
            'uni-mail'=>$user->mail
             ];
             $found = Arr::prepend($found, $return);
        }
        
        return response()->json([
            'message' => 'found a match',
            'match' => $found
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
        return response()->json(thirdyear::find($id),200);
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
        $thirdyear = thirdyear::findOrFail($id);
        $thirdyear->update($request->all());
        return response()->json($thirdyear,201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $thirdyear = thirdyear::findOrFail($id);
        $thirdyear->delete();
        return response()->json(null,204);
    }
}
