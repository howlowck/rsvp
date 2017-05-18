<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvitationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('invite_code');
            $table->integer('total_guests'); //if there is no known significant others
            $table->boolean('confirmed')->nullable();
            $table->boolean('will_come')->nullable();
            $table->boolean('cannot_come')->nullable();
            $table->string('address_street')->nullable();
            $table->string('address_city')->nullable();
            $table->string('address_zipcode')->nullable();
            $table->boolean('invitation_viewed')->default(false);
            $table->boolean('invitation_sent')->default(false);
            $table->text('favorite_song')->nullable();
            $table->timestamps();
            $table->text('notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invitations');
    }
}
