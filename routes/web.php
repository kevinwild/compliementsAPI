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


//==============================================
//=======        Admin Routes      =============
//==============================================
$router->get('/', [
    'as' => 'index', 'uses' => 'ExpressionController@index'
]);

$router->get('login', 'AdminController@login');
$router->post('login', 'AdminController@verifyLogin');
Route::group(['middleware' => 'admin'], function () {
    Route::get('dashboard/{token}', [
        'as' => 'dashboard', 'uses' => 'AdminController@dashboard'
    ]);

});

//==============================================
//=======   Handle Expressions =================
//==============================================
//-- Get All
$router->get('expressions', 'ExpressionController@all');

//-- Find by ID
$router->get('expressions/{id}', 'ExpressionController@show');

//-- Create New Expression
$router->post('expressions', 'ExpressionController@store');

//-- Delete Expression
$router->delete('expressions/{id}', 'ExpressionController@destroy');

//-- Edit Expression
$router->post('expressions/{id}', 'ExpressionController@update');


//==============================================
//=======   Handle ExpressionGroups  ==========
//==============================================
//-- Get All
$router->get('groups', 'ExpressionController@allGroup');

//-- Find by ID
$router->get('groups/{id}', 'ExpressionController@findGroup');

//-- Get All Expressions by ExpressionGroup
$router->get('groups/{id}/expressions', 'ExpressionController@expressionByGroup');

//-- Create New ExpressionGroup
$router->post('groups', 'ExpressionController@createGroup');

//-- Edit ExpressionGroup
$router->post('expressions/{id}', 'ExpressionController@editGroup');

//-- Delete ExpressionGroup
$router->delete('groups/{id}', function ($id) {
    $group = ExpressionGroup::find($id);
    if ($group === null) {
        return Common::handleEmpty();
    }
    $status = $group->delete();
    if ($status) {
        return response()->json(["status" => true, "message" => "Group Deleted"]);
    } else {
        return response()->json(["status" => false, "message" => "Failed Deletion"]);
    }
});


$router->get('quicktest', function () {
    echo hash('sha256', "test");

});