<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            // Define foreign key to the 'delivery_requests' table with primary key 'id'
            $table->unsignedBigInteger('request_id')->unique();
            $table->foreign('request_id')
                ->references('id')
                ->on('delivery_requests')
                ->onDelete('cascade');

            $table->decimal('weight', 8, 2); // Weight of the package
            $table->decimal('price', 10, 2);  // Delivery price based on weight
            $table->string('tracking_number')->unique(); // Unique tracking number
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('packages');
    }
};
