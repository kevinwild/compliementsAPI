<?php

namespace App\Http\Controllers;

use App\Expression;
use Illuminate\Http\Request;
use App\Helpers\Common;
use App\Helpers\GenericResponses;
use App\ExpressionGroup;



class ExpressionController extends Controller
{
//===================================================
//---------------- Expressions ----------------------
//====================================================
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function all()
    {
        return response()->json(Expression::all());
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
        $value = $request->input('value');
        $group_id = $request->input('group_id');
        $expression = new Expression();
        $expression->value = $value;
        $expression->group_id = $group_id;
        $status = $expression->save();
        return GenericResponses::savedResource($status, [
            "name" => "Expression",
            "action" => "save"
        ]);    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(Expression::find($id));
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
        $expression = Expression::find($id);
        $value = $request->input('value');

        if($expression === null || $value === null){
            return Common::handleEmpty();
        }
        $expression->value = $value;
        $status = $expression->update();
        return GenericResponses::savedResource($status, [
            "name" => "Expression",
            "action" => "update"
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $expression = Expression::find($id);
        if($expression === null){
            return Common::handleEmpty();
        }
        $status = $expression->delete();
        return GenericResponses::savedResource($status, [
            "name" => "Expression",
            "action" => "delete"
        ]);
    }

//=====================================================
//--------- ExpressionGroups -------------------------
//====================================================
    //.. Get All Groups
    public function allGroup(){
        return response()->json(ExpressionGroup::all());
    }

    //.. Create Group
    public function createGroup(Request $request, $id)
    {
        $group_name = $request->input('group_name');
        $expression = new ExpressionGroup();
        $expression->group_name = $group_name;
        $status = $expression->save();
        if($status){
            return response()->json(["status" => true, "message" => "Express Group Saved"]);
        }else {return response()->json(["status" => false, "message" => "Failed Saved"]);}
    }

    //-- Find by ID
    public function findGroup($id)
    {
        return response()->json(ExpressionGroup::find($id));
    }

    //-- Get Expressions by Group
    function expressionsByGroup($id) {
        return response()->json(Expression::
        where(["group_id" => $id])
            ->get());
    }

    //--Edit Expression Group
    function editGroup(Request $request){
        $group = ExpressionGroup::find($id);
        $group_name = $request->input('group_name');

        if($group === null || $group_name === null){
            return Common::handleEmpty();
        }
        $group->group_name = $group_name;
        $status = $group->update();
        if($status){
            return response()->json(["status" => true, "message" => "Group Updated"]);
        }else {return response()->json(["status" => false, "message" => "Failed Update"]);}

    }

    //-- Delete Group
    function deleteGroup($id){
        $group = ExpressionGroup::find($id);
        if($group === null){
            return Common::handleEmpty();
        }
        $status = $group->delete();
        if($status){
            return response()->json(["status" => true, "message" => "Group Deleted"]);
        }else {return response()->json(["status" => false, "message" => "Failed Deletion"]);}
    }


//=====================================================
//--------------------- Views -------------------------
//====================================================
    function index(){

        return view('index' ,[
            "randomExpression" => Expression::inRandomOrder()->first()
        ]);
    }
}
