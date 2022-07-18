<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGlLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gl_ledgers', function (Blueprint $table) {
            $table->id();
            $table->string('refno')->uniqid();
            $table->string('class_id')->uniqid();
            $table->string('sub_class_id')->uniqid();
            $table->string('gl_code')->uniqid();
            $table->string('gl_name');
            $table->string('narration')->nullable();
            $table->string('credit')->default(0);
            $table->string('debit')->default(0);
            $table->string('deleted')->default('N');
            $table->string('status')->nullable();
            $table->string('user')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gl_ledgers');
    }
}
