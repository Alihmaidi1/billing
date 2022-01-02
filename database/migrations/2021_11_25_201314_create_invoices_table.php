<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string("customer_name")->nullable();
            $table->string("customer_email")->nullable();
            $table->integer("customer_number")->nullable();
            $table->string("company_name")->nullable();
            $table->integer("invoice_number")->nullable();
            $table->date("invoice_date")->nullable();
            $table->integer("sub_total")->nullable();
            $table->integer("discount")->nullable();
            $table->integer("vat")->nullable();
            $table->integer('shipping')->nullable();
            $table->integer("user_id");
            $table->integer("total")->nullable();
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
        Schema::dropIfExists('invoices');
    }
}
