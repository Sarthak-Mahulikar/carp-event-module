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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->integer('total_quantity');
            $table->integer('price');
            $table->string('sale_starts_from');
            $table->string('sale_ends_at');
            $table->string('description');
            $table->string('message_to_attendee');
            $table->boolean('status');
            $table->string('event_id');
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
        Schema::table('tickets',function(Blueprint $table){
            $table->dropSoftDeletes();
        });
    }
};
