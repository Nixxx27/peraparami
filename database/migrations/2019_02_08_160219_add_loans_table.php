<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->increments('id');
            
            $table->date('loan_date'); //Date where member filed loan
            $table->date('loan_needed_date'); //Date member need the loan.
            $table->date('approval_date'); // Date when the Admin approved the Loan / Start of Loan
            $table->date('maturity_date'); // Interest will add.
            
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');

            $table->string('loaned_amount'); // Amount member filed.
            $table->string('approved_amount'); // Amount Admin Approved.

            $table->string('balance');

            $table->integer('approved_by')->unsigned()->nullable();
            $table->foreign('approved_by')->references('id')->on('users');

            $table->string('status');
            $table->string('interest_rate'); // Interest Rate when the Time the loan approved
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('loans');
    }
}
