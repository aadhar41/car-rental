<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignBucketIdToVehiclePricingBucketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vehicle_pricing_buckets', function (Blueprint $table) {
            $table->foreign("bucket_id")
                ->references("id")
                ->on("buckets")
                ->onUpdate("CASCADE")
                ->onDelete("CASCADE");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vehicle_pricing_buckets', function (Blueprint $table) {
            $table->dropForeign(["bucket_id"]);
        });
    }
}
