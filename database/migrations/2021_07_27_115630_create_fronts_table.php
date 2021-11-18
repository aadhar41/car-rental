<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrontsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fronts', function (Blueprint $table) {
            $table->id();
            $table->text('herosection')->nullable($value = true)->collation('utf8mb4_general_ci');
            $table->text('aboutcontent_text')->nullable($value = true)->collation('utf8mb4_general_ci');
            $table->text('aboutcontent_image')->nullable($value = true)->collation('utf8mb4_general_ci');
            $table->text("iconicdreams_h2")->nullable($value = true)->collation('utf8mb4_general_ci');
            $table->text("iconicdreams_h6")->nullable($value = true)->collation('utf8mb4_general_ci');
            $table->text("iconicdreams_p")->nullable($value = true)->collation('utf8mb4_general_ci');
            $table->text("iconicdreams_image")->nullable($value = true)->collation('utf8mb4_general_ci');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fronts');
    }
}
