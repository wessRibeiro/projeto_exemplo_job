<?php
/**
 * Created by Weslley Ribeiro.
 * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
 * Date 27/01/2019 19:40
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Created by Weslley Ribeiro
 * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
 * Class CreateProvidersTable
 */
class CreateProvidersTable extends Migration
{
    /**
     * Created by Weslley Ribeiro.
     * @var string
     */
    private $_tb = 'providers';
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
                $table->string('name')->comment('nome do fornecedor');
                $table->string('email')->comment('email do fornecedor');
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
