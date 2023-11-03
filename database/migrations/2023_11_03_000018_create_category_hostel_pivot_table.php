<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryHostelPivotTable extends Migration
{
    public function up()
    {
        Schema::create('category_hostel', function (Blueprint $table) {
            $table->unsignedBigInteger('hostel_id');
            $table->foreign('hostel_id', 'hostel_id_fk_9177754')->references('id')->on('hostels')->onDelete('cascade');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id', 'category_id_fk_9177754')->references('id')->on('categories')->onDelete('cascade');
        });
    }
}
