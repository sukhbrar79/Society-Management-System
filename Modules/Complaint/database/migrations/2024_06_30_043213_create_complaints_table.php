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
        Schema::create('complaints', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('block_id')->nullable();
            $table->unsignedBigInteger('flat_id')->nullable();
            $table->string('subject')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['pending', 'in_progress', 'resolved', 'closed'])->default('pending');
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
            $table->unsignedBigInteger('assigned_to')->nullable();
            
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();
            $table->timestamp('resolved_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('set null');
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
        Schema::dropIfExists('complaints');
    }
};
