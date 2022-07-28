<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBbsCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bbs_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('bbs_id')->nullable();
            $table->text('comment')->nullable();

            $table->integer('created_by')->nullable();
            $table->timestamp('created_at')->nullable();

            $table->integer('updated_by')->nullable();
            $table->timestamp('updated_at')->nullable();

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
        Schema::dropIfExists('bbs_comments');
    }
}
