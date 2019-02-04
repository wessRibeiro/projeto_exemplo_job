<?php

namespace Convenia\Models\V1;

use Illuminate\Database\Eloquent\Model;

/**
 * Created by Weslley Ribeiro
 * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
 * Class ProvidersMonthly
 * @package Convenia\Models\V1
 */
class ProvidersMonthly extends Model
{
    /**
     * Created by Weslley Ribeiro.
     * @var string
     */
    protected $table = 'providers_monthlies';
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
        'providers_id',
        'monthly',
    ];

    /**
     * Created by Weslley Ribeiro.
     * @var array
     */
    protected $visible = ['monthly', 'created_at'];

}
