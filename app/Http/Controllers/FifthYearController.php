<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\fifthyear;
use App\User;
use App\Notifications\FoundMatchNotification;
use App\Notifications\DoubleSwitchNotification;
use Ramsey\Collection\DoubleEndedQueue;

class fifthyearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns=['from','to'];
        $fifthyear = DB::select('select * from fifthyear');
        return response()->json([
            'message' => 'your switch was stored successfully',
            'data' => $fifthyear
        ],200);
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
            'user_id' => 'required',
            'token' => 'required'
        ]);
    
        $to = $request->input('to');
        $from = $request->input('from');
        $extra_courses = $request->input('extra_courses');
        $id = $request->input('user_id');
        $major = $request->input('major');
        $token = $request->input('token');
   
        $match = DB::table('fifthyear')->where('major',$major)->where('extra_courses',$extra_courses) ->get();
        
        // $match= $match-> where('to',$from)-> orwhere('from',$to)->get() ;
        
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
                $fifthyear = new fifthyear;
                $fifthyear->user_id=$id;
                $fifthyear->token=$token;
                $fifthyear->major=$major;
                $fifthyear->from=$from;
                $fifthyear->to=$to;
                $fifthyear->extra_courses=$extra_courses;
                $fifthyear->save();
        return response()->json([
            'message' => 'your switch was stored successfully',
            'switch' => $fifthyear
        ]);
    }
    else{
        $found=[];
        $sender = User::where('id',$id)->first();
        foreach($switchuser as $deleted){
            fifthyear::where('user_id',$deleted->user_id)->delete(); 
            $user = User::where('id',$deleted->user_id)->first();
            // $return = $user->name;  
                 
            array_push($found, $user);
           
        }
        
        if(count($found) == 1){
          
            $user->notify(new FoundMatchNotification($sender));
            $sender->notify(new FoundMatchNotification($user)); 
            return response()->json([
                'message' => 'found a match',
                'match' => $found
            ]);
        }
        else{
            $user1=$found[0];
            $user2=$found[1];
            $user1->notify(new DoubleSwitchNotification($sender,$user2));
            $user2->notify(new DoubleSwitchNotification($sender,$user1));
            $sender->notify(new DoubleSwitchNotification($user1,$user2)); 
          return response()->json([
                'message' => 'found a match',
                'match' => $found
            ]); 
        }
        
       

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
        return response()->json(fifthyear::find($id),200);
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
        $token = $request->token;
        $fifthyear = fifthyear:: where('user_id',$id)->where('token',$token)->update($request->all());
        return response()->json($fifthyear, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $token = $request->token;
        fifthyear::where('user_id',$id)->where('token',$token)->delete(); 
         return response()->json(null,204);
    
    }
}
