<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            // $table->string('type');
            $table->string('ref')->nullable();
            $table->string('sendernuban');
            $table->string('sendername');
            $table->string('senderaccttype')->nullable();
            $table->double('sentamt',12,2)->default(0);
            $table->string('receivernuban');
            $table->string('receivername');
            $table->string('receiveraccttype')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('transfers');
    }
}
