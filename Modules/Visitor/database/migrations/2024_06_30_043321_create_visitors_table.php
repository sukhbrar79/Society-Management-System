<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitors', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            
            $table->string('contact_number');
            $table->unsignedBigInteger('resident_id');
            $table->unsignedBigInteger('block_id')->nullable();
            $table->unsignedBigInteger('flat_id')->nullable();
            $table->timestamp('check_in_time')->nullable();
            $table->timestamp('check_out_time')->nullable();
            $table->date('check_in_date')->nullable();
            $table->date('check_out_date')->nullable();
            $table->string('purpose')->nullable();
            $table->string('vehicle_number')->nullable();

            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();

            $table->timestamps();
            $table->softDeletes();

             // Foreign key constraints
             $table->foreign('resident_id')->references('id')->on('users')->onDelete('cascade');
             $table->foreign('block_id')->references('id')->on('blocks')->onDelete('set null');
             $table->foreign('flat_id')->references('id')->on('flats')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitors');
    }
};
