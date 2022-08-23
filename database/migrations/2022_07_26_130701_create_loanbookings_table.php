<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanbookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loanbookings', function (Blueprint $table) {
            $table->id();
            $table->string('customerid');
            $table->string('ref')->nullable();
            $table->string('nuban');
            $table->string('acctname');
            $table->string('loantype')->nullable();
            $table->string('method')->nullable();
            $table->float('mpd')->default(0);
            $table->float('mid')->default(0);
            $table->float('tp')->default(0);
            $table->float('pp')->default(0);
            $table->float('pr')->default(0);
            $table->string('totalmonth')->nullable();
            $table->string('deductedmonth')->nullable();
            $table->string('remainingmonth')->nullable();
            $table->string('totalint')->nullable();
            $table->string('intpaid')->nullable();
            $table->string('intremaining')->nullable();
            $table->date('applicationdate');
            $table->date('firstdeductiondate');
            $table->date('nextdeductiondate');
            $table->date('deductionmain');
            $table->date('loanexpdate');
            $table->string('loanrate');
            $table->float('totalrepayment')->default(0);
            $table->string('loanpurpose');
            $table->string('collateral');
            $table->string('status');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('loanbookings');
    }
}
