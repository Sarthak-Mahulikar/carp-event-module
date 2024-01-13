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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('display_name');
            $table->string('visibility');
            $table->string('starts_from');
            $table->string('ends_at');
            $table->string('timezone');
            $table->string('tag');
            $table->boolean('status');
            $table->string('platform_name')->nullable();
            $table->string('joining_link')->nullable();
            $table->string('joining_credentials')->nullable();
            $table->string('joining_instruction')->nullable();
            $table->string('venue')->nullable();
            $table->string('pin')->nullable();
            $table->string('description_text');
            $table->string('video');
            $table->softDeletes();
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
        // Schema::dropIfExists('events');
        Schema::table('events',function(Blueprint $table){
            $table->dropSoftDeletes();
        });
    }
};
