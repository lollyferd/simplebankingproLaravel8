<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanrepaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loanrepayments', function (Blueprint $table) {
            $table->id();
            $table->string('loanid')->nullable();
            $table->string('ref')->nullable();
            $table->string('customerid');
            $table->string('nuban');
            $table->date('repaydate');
            $table->float('deductionbal')->default(0);
            $table->float('principal')->default(0);
            $table->float('int')->default(0);
            $table->float('endingbal')->default(0);
            $table->float('cummulativeint')->default(0);
            $table->float('totalrepay')->default(0);
            $table->string('rdstatus')->nullable();
            $table->string('method')->nullable();
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
        Schema::dropIfExists('loanrepayments');
    }
}
