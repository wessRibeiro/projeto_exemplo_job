<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Migrations\Migration;

/**
 * Created by Weslley Ribeiro
 * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
 * Class CreateProvidersMonthliesTable
 */
class CreateProvidersMonthliesTable extends Migration
{
    use SoftDeletes;
    /**
     * Created by Weslley Ribeiro.
     * @var string
     */
    private $_tb = 'providers_monthlies';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable($this->_tb)) {
            Schema::create($this->_tb, function (Blueprint $table) {
                $table->increments('id');
                $table->integer('providers_id')->comment('id do fornecedor');
                $table->float('monthly')->comment('mensalidade');
                $table->timestamps();
                $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->_tb);
    }
}
