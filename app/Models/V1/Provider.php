<?php
/**
 * Created by Weslley Ribeiro.
 * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
 * Date 27/01/2019 19:50
 */
namespace Convenia\V1\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Created by Weslley Ribeiro
 * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
 * Class Provider
 * @package Convenia\V1\Models
 */
class Provider extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'providers';
    /**
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    /**
     * The model's default values for attributes.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'monthly',
    ];
}