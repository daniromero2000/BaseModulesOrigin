<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsToEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->char('rh')->after('employee_position_id');
            $table->string('bank_account')->unique()->nullable()->after('rh');
            $table->string('work_schedule')->nullable()->after('bank_account');
            $table->string('personal_email')->nullable()->unique()->after('work_schedule');
            $table->date('admission_date')->nullable()->after('personal_email');
            $table->tinyInteger('is_rotative')->unsigned()->default(0)->after('personal_email');
            $table->integer('customer_id')->unsigned()->nullable()->after('admission_date');
            $table->foreign('customer_id')->references('id')->on('customers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->dropColumn(array(
                'rh',
                'bank_account',
                'work_schedule',
                'personal_email',
                'admission_date',
                'is_rotative',
            ));
            $table->dropForeign('employees_customer_id_foreign');
            $table->dropColumn('customer_id');
        });
    }
}
