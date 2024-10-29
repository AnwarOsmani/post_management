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
        Schema::table('delivery_requests', function (Blueprint $table) {
            // Add the assigned_worker column
            $table->unsignedBigInteger('assigned_worker')->nullable();

            // Add the foreign key constraint
            $table->foreign('assigned_worker')
                ->references('id')->on('workers')
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
        Schema::table('delivery_requests', function (Blueprint $table) {
            // Drop the foreign key and column
            $table->dropForeign(['assigned_worker']);
            $table->dropColumn('assigned_worker');
        });
    }
};
