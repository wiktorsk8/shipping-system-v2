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
            $table->id('package_number');
            $table->string('name');
            $table->string('size');
            $table->tinyInteger('status')->default(PackageStatus::PACKAGE_STATUS['In preparation']);

            $table->foreignId('senders_address');
            $table->string('senders_email');

            $table->foreignId('recipient_address');
            $table->string('recipient_email');
            
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
