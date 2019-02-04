<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

/**
 * Created by Weslley Ribeiro
 * User: Weslley Ribeiro <wess_ribeiro@hotmail.com>
 * Class CreateUsersTable
 */
class CreateUsersTable extends Migration
{
    /**
     * Created by Weslley Ribeiro.
     * @var string
     */
    private $_tb = "users";

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
                $table->string('name');
                $table->string('email', 100)->unique();
                $table->string('phone', 18)->comment('telefone da empresa com formato: 55 (11) 9####-####');
                $table->string('adress')->comment('endereco da empresa por extenso');
                $table->string('cnpj', 18)->comment('cnpj da empresa com formato: ##.###.###/####-##');
                $table->string('postcode',9)->comment('CEP da empresa com formato: #####-###');
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->rememberToken();
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
