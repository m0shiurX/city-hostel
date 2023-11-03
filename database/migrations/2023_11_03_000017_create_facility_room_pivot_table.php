<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilityRoomPivotTable extends Migration
{
    public function up()
    {
        Schema::create('facility_room', function (Blueprint $table) {
            $table->unsignedBigInteger('room_id');
            $table->foreign('room_id', 'room_id_fk_9175279')->references('id')->on('rooms')->onDelete('cascade');
            $table->unsignedBigInteger('facility_id');
            $table->foreign('facility_id', 'facility_id_fk_9175279')->references('id')->on('facilities')->onDelete('cascade');
        });
    }
}
