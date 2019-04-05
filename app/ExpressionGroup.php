<?php
/**
 * Created by PhpStorm.
 * User: PMM
 * Date: 4/3/2019
 * Time: 10:30 PM
 */

namespace App;
use Illuminate\Database\Eloquent\Model;


class ExpressionGroup extends Model
{
    public function expression()
    {
        return $this->hasMany(ExpressionGroup::class);
    }
}