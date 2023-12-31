<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientFinancialsTable extends Migration
{
    public function up()
    {
        Schema::create('client_financials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('amount', 15, 2)->nullable();
            $table->boolean('approved')->default(0)->nullable();
            $table->longText('description')->nullable();
            $table->string('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
