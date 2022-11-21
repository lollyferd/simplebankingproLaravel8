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
            $table->bigInteger('customerid',false,true)->unsigned()->index();

            $table->foreign('customerid')->references('id')->on('customer_details')
            ->onDelete('cascade');

            $table->string('nuban');
            $table->string('narration')->nullable();
            $table->double('credit',12,2)->default(0);
            $table->double('debit',12,2)->default(0);
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
