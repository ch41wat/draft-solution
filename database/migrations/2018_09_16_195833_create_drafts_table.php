<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDraftsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('drafts', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('water_need_qty')->nullable();
            $table->string('purpose')->nullable();
            $table->integer('budget')->nullable();
            $table->timestamp('start_date')->nullable();
            $table->timestamp('start_service_duration')->nullable();
            $table->timestamp('end_service_duration')->nullable();
            $table->string('other')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->integer('water_qty')->nullable();
            $table->float('pipe_size')->nullable();
            $table->float('pipe_setup_price')->nullable();
            $table->string('technology')->nullable();
            $table->string('sale_name')->nullable();
            $table->string('company')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('drafts');
    }
}
