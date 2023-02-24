<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('package_id')
                ->unique()
                ->onDelete('cascade');

            $table->string('street_name');
            $table->string('street_number');
            $table->string('flat_number')->nullable();
            $table->string('postal_code');
            $table->string('city');
            $table->string('coordinates');
            $table->string('recipient_street_name');
            $table->string('recipient_street_number');
            $table->string('recipient_flat_number')->nullable();
            $table->string('recipient_postal_code');
            $table->string('recipient_city');
            $table->string('recipient_coordinates');
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
        Schema::dropIfExists('adresses');
    }
};
