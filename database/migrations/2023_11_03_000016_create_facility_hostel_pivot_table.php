<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilityHostelPivotTable extends Migration
{
    public function up()
    {
        Schema::create('facility_hostel', function (Blueprint $table) {
            $table->unsignedBigInteger('hostel_id');
            $table->foreign('hostel_id', 'hostel_id_fk_9175302')->references('id')->on('hostels')->onDelete('cascade');
            $table->unsignedBigInteger('facility_id');
            $table->foreign('facility_id', 'facility_id_fk_9175302')->references('id')->on('facilities')->onDelete('cascade');
        });
    }
}
