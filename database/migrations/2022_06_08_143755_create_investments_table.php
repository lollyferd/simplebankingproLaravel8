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
            $table->float('fdamt')->default(0);
            $table->float('paidback')->default(0);
            $table->float('fdint')->default(0);
            $table->string('duration');
            $table->float('totalint')->default(0);
            $table->float('wht')->default(0);
            $table->float('intdue')->default(0);
            $table->float('penalty')->default(0);
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
