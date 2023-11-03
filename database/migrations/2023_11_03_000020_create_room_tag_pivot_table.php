<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomTagPivotTable extends Migration
{
    public function up()
    {
        Schema::create('room_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('room_id');
            $table->foreign('room_id', 'room_id_fk_9177755')->references('id')->on('rooms')->onDelete('cascade');
            $table->unsignedBigInteger('tag_id');
            $table->foreign('tag_id', 'tag_id_fk_9177755')->references('id')->on('tags')->onDelete('cascade');
        });
    }
}
