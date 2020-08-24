<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('identification')->unique();
            $table->string('company_type')->default('Natural');
            $table->text('description')->nullable();
            $table->unsignedInteger('country_id')->index();
            $table->foreign('country_id')->references('id')->on('countries');
            $table->string('logo')->nullable()->default('Sin Logo');
            $table->string('timezone')->nullable();
            $table->tinyInteger('is_active')->unsigned()->default(1);
            $table->integer('base_currency_id')->unsigned();
            $table->foreign('base_currency_id')->references('id')->on('currencies')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
