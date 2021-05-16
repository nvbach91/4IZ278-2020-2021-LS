<?php


namespace App\Models;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseModel
 * @package App\Models
 * @mixin Builder
 */
abstract class BaseModel extends Model
{
    use HasFactory;

    public $timestamps = true;

}
