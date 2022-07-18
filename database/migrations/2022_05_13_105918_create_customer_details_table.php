<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_details', function (Blueprint $table) {
            $table->id();
            $table->string('customerid')->nullable();
            $table->string('nuban')->nullable();
            $table->string('surname');
            $table->string('othername');
            $table->string('bvn')->nullable();
            $table->string('gender');
            $table->string('dob');
            $table->string('email')->nullable();
            $table->string('tel');
            $table->string('occupation')->nullable();
            $table->string('country');
            $table->string('state');
            $table->string('city')->nullable();
            $table->string('homeaddress');
            $table->string('officeaddress')->nullable();
            $table->string('typeofacct');
            $table->string('classofacct');
            $table->string('nextofkin')->nullable();
            $table->string('nextofkinaddress')->nullable();
            $table->string('photo')->nullable();
            $table->string('sign')->nullable();
            $table->string('accountofficer');
            $table->string('bal')->default(0);
            $table->string('loanbal')->default(0);
            $table->string('intbal')->default(0);
            $table->string('createdby')->nullable();
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
        Schema::dropIfExists('customer_details');
    }
}
