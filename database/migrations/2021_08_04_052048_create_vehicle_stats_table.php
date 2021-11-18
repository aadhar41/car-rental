<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehicleStatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicle_stats', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('brand_id');
            $table->unsignedBigInteger('vehicle_id');
            // $table->unsignedBigInteger('unit_id');
            $table->string('engine');
            $table->string('power');
            $table->string('zero_to_hundred');
            $table->string('top_speed');
            $table->string('weight');
            $table->enum('status', ['1', '0'])->default("1")->comment('[1 => "Enabled", 0 => "Disabled"]');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade')->onUpdate('cascade');
            // $table->foreign('unit_id')->references('id')->on('units')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vehicle_stats');
    }
}
