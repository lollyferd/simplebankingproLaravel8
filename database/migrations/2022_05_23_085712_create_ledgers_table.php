<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLedgersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ledgers', function (Blueprint $table) {
            $table->id();
            $table->string('refno')->nullable();
            $table->string('customerid');
            $table->string('nuban');
            $table->string('narration')->nullable();
            $table->string('credit')->default(0);
            $table->string('debit')->default(0);
            $table->string('deleted')->default('N');
            $table->string('status')->nullable();
            $table->string('user')->nullable();
            $table->string('loanref')->nullable();
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
        Schema::dropIfExists('ledgers');
    }
}
