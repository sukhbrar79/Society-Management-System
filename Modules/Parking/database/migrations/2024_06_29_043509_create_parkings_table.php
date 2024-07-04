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
        Schema::create('parkings', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('spot_number', 10);
            $table->enum('spot_type', ['Compact','Standard','Large', 'Handicapped'])->default('Standard');
            $table->string('location', 100);

            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('parking_allocations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('parking_id')->constrained('parkings', 'id')->onDelete('cascade');
            $table->foreignId('resident_id')->constrained('users', 'id')->onDelete('cascade');
            $table->unsignedBigInteger('block_id')->nullable();
            $table->unsignedBigInteger('flat_id')->nullable();
            $table->date('allocation_date');
            $table->date('expiration_date');
            $table->enum('status', ['Expired', 'Active', 'Upcoming','Pending','Approved','Rejected']);

            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();

            $table->timestamps();
            $table->softDeletes();
             // Foreign key constraints
            
         
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::dropIfExists('parking_allocations');
        Schema::dropIfExists('parkings');
    }
};
