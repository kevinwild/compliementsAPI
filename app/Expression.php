<?php
/**
 * Created by PhpStorm.
 * User: PMM
 * Date: 4/3/2019
 * Time: 10:29 PM
 */

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expression extends Model
{

    public function group()
    {
        return $this->belongsTo(ExpressionGroup::class, 'group_id');
    }
}