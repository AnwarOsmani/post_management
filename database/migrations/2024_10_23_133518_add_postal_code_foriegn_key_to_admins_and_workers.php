<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPostalCodeForiegnKeyToAdminsAndWorkers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Update Workers Table
        Schema::table('workers', function (Blueprint $table) {
            // Drop the existing foreign key on the province column
            $table->dropForeign('workers_province_foreign');

            // Optionally, drop the province column if it's no longer needed
            $table->dropColumn('province');

            // Add the postal_code column with double precision to match the postalcodes table
            $table->double('postal_code');

            // Add foreign key constraint to postalcodes table for postal_code
            $table->foreign('postal_code')
                ->references('postal_code')
                ->on('postal_codes')
                ->onDelete('set null'); // Set to null if the postal code is deleted
        });

        // Update Admins Table
        Schema::table('admins', function (Blueprint $table) {
            $table->dropForeign('admins_province_foreign');
            $table->dropColumn('province');

            $table->double('postal_code');
            $table->foreign('postal_code')
                ->references('postal_code')
                ->on('postal_codes')
                ->onDelete('set null'); // Set to null if the postal code is deleted
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
        Schema::table('workers', function (Blueprint $table) {
            // Drop the foreign key pointing to the postalcodes table
            $table->dropForeign(['postal_code']);

            // Drop the postal_code column
            $table->dropColumn('postal_code');

            // Optionally, add back the province column if it was dropped
            // $table->unsignedBigInteger('province')->nullable();

            // Add the foreign key back to the province table
            $table->foreign('province')
                ->references('id')
                ->on('provinces')
                ->onDelete('set null');
        });

        // Revert Admins Table changes
        Schema::table('admins', function (Blueprint $table) {
            // Drop the foreign key pointing to the postalcodes table
            $table->dropForeign(['postal_code']);

            // Drop the postal_code column
            $table->dropColumn('postal_code');

            // Optionally, add back the province column if it was dropped
            // $table->unsignedBigInteger('province')->nullable();

            // Add the foreign key back to the province table
            $table->foreign('province')
                ->references('id')
                ->on('provinces')
                ->onDelete('set null');
        });
    }
}
