<?php

use App\Models\DeliveryRequest;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('delivery_requests', function (Blueprint $table) {
            // Drop the existing `status` column if it exists
            $table->dropColumn('status');
        });

        Schema::table('delivery_requests', function (Blueprint $table) {
            // Add the new `status` column as an integer with a default value
            $table->tinyInteger('status')->default(DeliveryRequest::STATUS_CREATED)
                ->after('receiver_postal_code');
        });

        // Adding a check constraint using a raw SQL statement
        DB::statement('ALTER TABLE delivery_requests ADD CONSTRAINT status_check CHECK (status BETWEEN 1 AND 6)');
    }

    public function down()
    {
        Schema::table('delivery_requests', function (Blueprint $table) {
            // Drop the `status` column
            $table->dropColumn('status');
        });

        Schema::table('delivery_requests', function (Blueprint $table) {
            // Re-add the original string `status` column (or however it was previously)
            $table->string('status')->default('created')->after('receiver_postal_code');
        });
    }
};
