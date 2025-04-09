<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('delivery_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade')->name('delivery_statuses_order_id_foreign');
            $table->enum('status', ['pending', 'dispatched', 'out_for_delivery', 'delivered'])->default('pending');
            $table->timestamps();


        });
    }

    public function down()
    {
        Schema::dropIfExists('delivery_statuses');
    }
};
