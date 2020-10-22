<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCourseAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_attendances', function (Blueprint $table) {
            $table->id();
            $table->string('course_name');
            $table->string('id_type');
            $table->string('identification');
            $table->string('name');
            $table->string('last_name');
            $table->string('position')->nullable()->default('No Position');
            $table->string('email')->nullable()->default('No Email');
            $table->string('phone')->nullable()->default('No Phone');
            $table->string('hotel_name')->default('No Name');
            $table->string('hotel_city')->default('No City');
            $table->String('start_date');
            $table->String('end_date');
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
        Schema::dropIfExists('course_attendance');
    }
}
