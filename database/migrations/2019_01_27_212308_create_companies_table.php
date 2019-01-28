<?php
/**
 * Created by Weslley Ribeiro.
 * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
 * Date 27/01/2019 19:42
 */

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Created by Weslley Ribeiro.
     * @var string
     */
    private $_tb = "companies";


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
                $table->string('name')->comment('nome da empresa');
                $table->string('phone', 18)->comment('telefone da empresa com formato: 55 (11) 9####-####');
                $table->string('adress')->comment('endereco da empresa por extenso');
                $table->string('postcode',9)->comment('CEP da empresa com formato: #####-###');
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
