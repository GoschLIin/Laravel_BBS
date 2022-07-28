<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name', 100)->nullable();
            $table->string('login_id', 255)->nullable();
            $table->string('password', 255)->nullable();

            $table->integer('created_by')->nullable();
            $table->timestamp('created_at')->nullable();

            $table->integer('updated_by')->nullable();
            $table->timestamp('updated_at')->nullable();

            $table->integer('deleted_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('accounts');
    }
}
