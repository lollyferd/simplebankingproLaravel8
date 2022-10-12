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
            $table->double('deductionbal',12,2)->default(0);
            $table->double('principal',12,2)->default(0);
            $table->double('int',12,2)->default(0);
            $table->double('endingbal',12,2)->default(0);
            $table->double('cummulativeint',12,2)->default(0);
            $table->double('totalrepay',12,2)->default(0);
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
