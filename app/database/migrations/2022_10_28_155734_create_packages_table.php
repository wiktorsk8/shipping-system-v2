<?php

use App\Helpers\Package\PackageStatus;
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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('senders_address');
            $table->string('receivers_address');
            $table->string('size');
            $table->boolean('cash_on_delivery')->nullable();
            $table->foreignId('senders_id');
            $table->foreignId('receivers_id');
            $table->foreignId('package_number');                       // unique 13 digits package tracking number
            $table->tinyInteger('status')->default(PackageStatus::PACKAGE_STATUS['In preparation']);
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
        Schema::dropIfExists('packages');
    }
};
