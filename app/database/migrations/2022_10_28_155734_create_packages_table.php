<?php

use App\Helpers\Enums\Package\PackageStatus;
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
            $table->id('id');
            $table->string('package_number')->unique();
            $table->string('name');
            $table->string('size');
            $table->tinyInteger('status')->default(0);
            $table->string('sender_email');
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
