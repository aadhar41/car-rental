<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id');
            $table->unsignedBigInteger('user_id');
            $table->string('image')->nullable($value = true);
            $table->text('title')->nullable($value = true)->collation('utf8mb4_general_ci');
            $table->text('education')->nullable($value = true)->collation('utf8mb4_general_ci');
            $table->string('location')->nullable($value = true);
            $table->text('skills')->nullable($value = true)->collation('utf8mb4_general_ci');
            $table->text('note')->nullable($value = true)->collation('utf8mb4_general_ci');
            $table->enum('status', ['1', '0'])->default("1")->comment('[1 => "Enabled", 0 => "Disabled"]');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profiles');
    }
}
