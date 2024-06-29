<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flats', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('name');
            $table->string('slug')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(1);

            $table->unsignedBigInteger('block_id')->nullable();
            $table->unsignedInteger('floor');
            $table->unsignedInteger('rooms')->nullable();

            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Foreign key constraint
            $table->foreign('block_id')->references('id')->on('blocks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('complaints', function (Blueprint $table) {
            if (Schema::hasTable('complaints')) {
                $table->dropForeign('complaints_flat_id_foreign');
            }
        });
        Schema::table('visitors', function (Blueprint $table) {
            if (Schema::hasTable('visitors')) {
                $table->dropForeign('visitors_flat_id_foreign');
            }
        });
        Schema::dropIfExists('flats');
    }
};
