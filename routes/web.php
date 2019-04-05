<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

use App\Expression;
use App\ExpressionGroup;
use Illuminate\Http\Request;
use App\Helpers\Common;


$router->get('/', function () use ($router) {
    return $router->app->version();
});


//==============================================
//=======   Handle Expressions =================
//==============================================
//-- Get All
$router->get('expressions', function () {
    return response()->json(Expression::all());
});

//-- Find by ID
$router->get('expressions/{id}', function ($id) {
    return response()->json(Expression::find($id));
});

//-- Create New Expression
$router->post('expressions', function (Request $request) {
    $value = $request->input('value');
    $group_id = $request->input('group_id');
    $expression = new Expression();
        $expression->value = $value;
        $expression->group_id = $group_id;
    $status = $expression->save();
    if($status){
        return response()->json(["status" => true, "message" => "Express Saved"]);
    }else {return response()->json(["status" => false, "message" => "Failed Saved"]);}
});

//-- Delete Expression
$router->delete('expressions/{id}', function ($id) {
    $expression = Expression::find($id);
    if($expression === null){
        return Common::handleEmpty();
    }
    $status = $expression->delete();
    if($status){
        return response()->json(["status" => true, "message" => "Expression Deleted"]);
    }else {return response()->json(["status" => false, "message" => "Failed Deletion"]);}
});

//-- Edit Expression
$router->post('expressions/{id}', function (Request $request, $id) {
    $expression = Expression::find($id);
    $value = $request->input('value');

    if($expression === null || $value === null){
        return Common::handleEmpty();
    }
    $expression->value = $value;
    $status = $expression->update();
    if($status){
        return response()->json(["status" => true, "message" => "Expression Updated"]);
    }else {return response()->json(["status" => false, "message" => "Failed Update"]);}
});


//==============================================
//=======   Handle ExpressionGroups  ==========
//==============================================
//-- Get All
$router->get('groups', function () {
    return response()->json(ExpressionGroup::all());
});

//-- Find by ID
$router->get('groups/{id}', function ($id) {
    return response()->json(ExpressionGroup::find($id));
});

//-- Get All Expressions by ExpressionGroup
$router->get('groups/{id}/expressions', function ($id) {
    return response()->json(Expression::
         where(["group_id" => $id])
        ->get());
});

//-- Create New ExpressionGroup
$router->post('groups', function (Request $request) {
    $group_name = $request->input('group_name');
    $expression = new ExpressionGroup();
    $expression->group_name = $group_name;
    $status = $expression->save();
    if($status){
        return response()->json(["status" => true, "message" => "Express Group Saved"]);
    }else {return response()->json(["status" => false, "message" => "Failed Saved"]);}
});

//-- Edit ExpressionGroup
$router->post('expressions/{id}', function (Request $request, $id) {
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
});

//-- Delete ExpressionGroup
$router->delete('groups/{id}', function ($id) {
    $group = ExpressionGroup::find($id);
    if($group === null){
        return Common::handleEmpty();
    }
    $status = $group->delete();
    if($status){
        return response()->json(["status" => true, "message" => "Group Deleted"]);
    }else {return response()->json(["status" => false, "message" => "Failed Deletion"]);}
});
