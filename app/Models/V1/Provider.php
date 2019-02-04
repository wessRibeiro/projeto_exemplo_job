<?php
/**
 * Created by Weslley Ribeiro.
 * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
 * Date 27/01/2019 19:50
 */
namespace Convenia\Models\V1;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use JWTAuth;
use Illuminate\Database\Eloquent\Builder;
use Convenia\Models\V1\ProvidersMonthly;

/**
 * Created by Weslley Ribeiro
 * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
 * Class Provider
 * @package Convenia\V1\Models
 */
class Provider extends Model{

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
        'users_id',
        'name',
        'email',
        'monthly',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('user', function (Builder $builder) {
            $user = JWTAuth::user();
            $builder->where('users_id', $user['id']);
        });
    }

    /**
     * Created by Weslley Ribeiro.
     * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
     * Date 03/02/2019 23:39
     * @return mixed
     */
    public function monthlies()
    {
        return $this->hasMany(ProvidersMonthly::class, 'providers_id', 'id');
    }

}
