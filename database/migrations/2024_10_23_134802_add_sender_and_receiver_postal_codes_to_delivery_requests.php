<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Update Workers Table
        Schema::table('delivery_requests', function (Blueprint $table) {

            $table->dropColumn('sender_postal_code');
            $table->dropColumn('receiver_postal_code');


            // Add the postal_code column with double precision to match the postalcodes table
            $table->double('sender_postal_code')->after('sender_phone');
            $table->double('receiver_postal_code')->after('receiver_phone');

            $table->foreign('sender_postal_code')
                ->references('postal_code')
                ->on('postal_codes')
                ->onDelete('cascade');

            $table->foreign('receiver_postal_code')
                ->references('postal_code')
                ->on('postal_codes')
                ->onDelete('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Revert Workers Table changes
        Schema::table('delivery_requests', function (Blueprint $table) {
            $table->dropForeign(['sender_postal_code']);
            $table->dropForeign(['receiver_postal_code']);
        });

        // Revert Admins Table changes
    }
};
