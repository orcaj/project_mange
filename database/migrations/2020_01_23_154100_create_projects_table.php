<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('project_name');
            $table->string('contractor');
            $table->integer('mda_id');
            $table->integer('zone_id');
            $table->integer('lga_id');
            $table->double('contract_amount');
            $table->double('amount_disbursed');
            $table->double('balance_payment');
            $table->string('current_ipc_no');
            $table->double('current_ipc_amount');
            $table->double('project_per_completion');
            $table->date('start_date');
            $table->date('expected_date');
            $table->integer('picreport_id')->nullable();
            $table->integer('doc_id')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
