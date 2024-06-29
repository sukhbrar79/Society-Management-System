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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('block_id')->nullable()->after('email');
            $table->unsignedBigInteger('flat_id')->nullable()->after('block_id');

            // Foreign key constraints
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['block_id']);
            $table->dropForeign(['flat_id']);
            $table->dropColumn('block_id');
            $table->dropColumn('flat_id');
        });
    }
};
