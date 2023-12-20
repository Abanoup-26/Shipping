<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('shipment_company')->nullable();
            $table->string('order_code')->nullable();
            $table->longText('from');
            $table->longText('to');
            $table->string('weight')->nullable();
            $table->string('chargeable')->nullable();
            $table->integer('pieces')->nullable();
            $table->datetime('pickup_date')->nullable();
            $table->string('destination')->nullable();
            $table->decimal('cash_on_delivery', 15, 2)->nullable();
            $table->longText('description')->nullable();
            $table->decimal('custom_value', 15, 2)->nullable();
            $table->string('delivery_status')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
