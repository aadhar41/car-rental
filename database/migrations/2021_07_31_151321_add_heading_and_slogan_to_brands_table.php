<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHeadingAndSloganToBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->text('heading')->nullable($value = true)->collation('utf8mb4_general_ci')->after("name");
            $table->text('slogan')->nullable($value = true)->collation('utf8mb4_general_ci')->after("heading");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->dropColumn('heading');
            $table->dropColumn('slogan');
            // $table->dropColumn('logo');
            // $table->dropColumn('image');
        });
    }
}
