<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccesstypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accesstypes', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->string('access')->nullable();
            $table->string('postingM')->nullable()->default('NO');
            $table->string('userM')->nullable()->default('NO');
            $table->string('tellerM')->nullable()->default('NO');
            $table->string('accountM')->nullable()->default('NO');
            $table->string('glM')->nullable()->default('NO');
            $table->string('investmentM')->nullable()->default('NO');
            $table->string('loanM')->nullable()->default('NO');
            $table->string('transferM')->nullable()->default('NO');
            $table->string('approvalM')->nullable()->default('NO');
            $table->string('reversalM')->nullable()->default('NO');
            $table->string('reportM')->nullable()->default('NO');
            $table->string('extra1')->nullable()->default('NO');
            $table->string('extra2')->nullable()->default('NO');
            $table->string('extra3')->nullable()->default('NO');
            $table->string('extra4')->nullable()->default('NO');
            $table->string('extra5')->nullable()->default('NO');
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
        Schema::dropIfExists('accesstypes');
    }
}
