<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAdmsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('adms')->nullable();
            $table->boolean('email_verificado')->nullable();
            $table->integer('cod_verificacao')->nullable();
            $table->integer('erro_verificacao')->nullable();
            $table->integer('telefone')->nullable();
            $table->text('endereco')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            Schema::dropIfExists('adms');
        });
    }
}
