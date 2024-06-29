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
            $table->date('allocation_date');
            $table->date('expiration_date');
            $table->enum('status', ['Expired', 'Active', 'Upcoming']);

            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('parking_requests', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignId('resident_id')->constrained('users', 'id')->onDelete('cascade');
            $table->foreignId('parking_id')->constrained('parkings', 'id')->onDelete('cascade');
            $table->date('request_date');
            $table->enum('status', ['Pending', 'Approved', 'Rejected']);

            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('parking_requests', function (Blueprint $table) {
            if (Schema::hasTable('parking_requests')) {
                $table->dropForeign('parking_requests_parking_id_foreign');
                $table->dropForeign('parking_requests_resident_id_foreign');
            }
        });
        Schema::table('parking_allocations', function (Blueprint $table) {
            if (Schema::hasTable('parking_allocations')) {
                $table->dropForeign('parking_allocations_parking_id_foreign');
                $table->dropForeign('parking_allocations_resident_id_foreign');
            }
        });
        Schema::dropIfExists('parking_requests');
        Schema::dropIfExists('parking_allocations');
        Schema::dropIfExists('parkings');
    }
};
