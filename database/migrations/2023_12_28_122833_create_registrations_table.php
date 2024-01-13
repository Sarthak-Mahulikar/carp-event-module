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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('participant_name');
            $table->string('participant_email');
            $table->bigInteger('participant_phone');
            $table->string('title');
            $table->string('gender');
            $table->string('designation');
            $table->string('organization');
            $table->bigInteger('emergency_contact');
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_relation');
            $table->string('blood_group');
            $table->string('where_did_you_hear_about_us');
            $table->string('note_to_organiser');
            $table->string('payment_status');
            $table->string('event_id');
            $table->softDeletes();
            // $table->string('ticket_id');
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
        // Schema::dropIfExists('registrations');
        Schema::table('registrations',function(Blueprint $table){
            $table->dropSoftDeletes();
        });
    }
};
