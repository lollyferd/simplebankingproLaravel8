<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReversalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reversals', function (Blueprint $table) {
            $table->id();
            $table->string('ref')->nullable();
            $table->bigInteger('customerid',false,true)->unsigned()->index();

            $table->foreign('customerid')->references('id')->on('customer_details')
            ->onDelete('cascade');
            $table->string('nuban')->nullable();
            $table->string('acctname')->nullable();
            $table->double('credit',12,2)->default(0);
            $table->double('debit',12,2)->default(0);
            $table->string('accttype')->nullable();
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
        Schema::dropIfExists('reversals');
    }
}
