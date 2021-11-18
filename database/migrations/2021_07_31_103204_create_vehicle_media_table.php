<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleMediaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_media', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('vehicle_id');
            $table->enum('type', ['1', '2', '3', '4', '5', '6'])->default("1")->comment('[1 => "image", 2 => "logo", 3 => "favicon", 4 => "banner", 5 => "document", 6 => "main_image"]');
            $table->string('file')->nullable($value = true);
            $table->enum('status', ['1', '0'])->default("1")->comment('[1 => "Enabled", 0 => "Disabled"]');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade')->onUpdate('cascade');
            // $table->unique(['vehicle_id', 'type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_media');
    }
}
