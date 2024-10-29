<?php

// database/migrations/xxxx_xx_xx_create_delivery_requests_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliveryRequestsTable extends Migration
{
    public function up()
    {
        Schema::create('delivery_requests', function (Blueprint $table) {
            $table->id();
            $table->string('sender_name');
            $table->string('sender_phone');
            $table->string('sender_postal_code');
            $table->string('receiver_name');
            $table->string('receiver_phone');
            $table->string('receiver_postal_code');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('delivery_requests');
    }
}
