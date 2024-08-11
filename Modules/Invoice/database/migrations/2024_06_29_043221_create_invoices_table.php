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
        Schema::create('invoices', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('invoice_number', 50);
            $table->string('name', 50)->default('Maintenance Bill');
            $table->text('description');
            $table->unsignedBigInteger('resident_id');
            $table->decimal('amount', 10, 2);
            $table->date('invoice_date');
            $table->date('due_date');
            $table->json('transaction')->nullable();
            $table->enum('status', ['Pending', 'Paid', 'Overdue'])->default('Pending');
           
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->integer('deleted_by')->unsigned()->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('resident_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            if (Schema::hasTable('invoices')) {
                $table->dropForeign('invoices_resident_id_foreign');
            }
        });
        Schema::dropIfExists('invoices');
    }
};
