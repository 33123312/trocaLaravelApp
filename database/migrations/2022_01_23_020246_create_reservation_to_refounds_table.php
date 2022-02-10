<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationToRefoundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_to_refounds', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer("amount");
            $table->string("canceled_by");
            $table->foreignId("reservation_id")->constrainted()->onDelete("cascade");

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservation_to_refounds');
    }
}
