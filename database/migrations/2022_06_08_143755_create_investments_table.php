<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvestmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('investments', function (Blueprint $table) {
            $table->id();
            $table->string('customerid');
            $table->string('ref')->nullable();
            $table->string('nuban');
            $table->string('acctname');
            $table->double('fdamt',12,2)->default(0);
            $table->double('paidback',12,2)->default(0);
            $table->double('fdint',12,2)->default(0);
            $table->string('duration');
            $table->double('totalint',12,2)->default(0);
            $table->double('wht',12,2)->default(0);
            $table->double('intdue',12,2)->default(0);
            $table->double('penalty',12,2)->default(0);
            $table->date('maturity');
            $table->date('predate');
            $table->string('status')->default('Pending');
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
        Schema::dropIfExists('investments');
    }
}
