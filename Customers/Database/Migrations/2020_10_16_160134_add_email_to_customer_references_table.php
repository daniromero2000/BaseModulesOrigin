<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailToCustomerReferencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_references', function (Blueprint $table) {
            $table->string('name')->after('customer_id');
            $table->string('last_name')->after('name');
            $table->string('phone')->nullable()->after('name');
            $table->string('email')->nullable()->after('phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_references', function (Blueprint $table) {
            //
        });
    }
}
