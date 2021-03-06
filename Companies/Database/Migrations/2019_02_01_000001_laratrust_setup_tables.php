<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class LaratrustSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return  void
     */
    public function up()
    {
        // Create table for storing roles
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('description')->nullable();
            $table->tinyInteger('status')->unsigned()->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        // Create table for storing permissions
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('icon')->nullable();
            $table->string('description')->nullable();
            $table->tinyInteger('status')->unsigned()->default(1);
            $table->timestamps();
            $table->softDeletes();
        });

        // Create table for properties permissions
        Schema::create('actions', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('permission_id')->index();
            $table->string('name')->nullable();
            $table->string('icon')->nullable();
            $table->string('route');
            $table->tinyInteger('principal')->default('1');
            $table->tinyInteger('is_active')->unsigned()->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('permission_id')->references('id')->on('permissions')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        // Create table for associating roles to properties (Many to many)
        Schema::create('action_role', function (Blueprint $table) {
            $table->unsignedInteger('action_id')->index();
            $table->unsignedInteger('role_id')->index();
            $table->foreign('action_id')->references('id')->on('actions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->tinyInteger('status')->unsigned()->default(1);
            $table->timestamps();
        });

        // Create table for associating roles to users and teams (Many To Many Polymorphic)
        Schema::create('role_user', function (Blueprint $table) {
            $table->unsignedInteger('role_id')->index();
            $table->unsignedInteger('user_id')->index();
            $table->string('user_type');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['user_id', 'role_id', 'user_type']);
            $table->tinyInteger('status')->unsigned()->default(1);
            $table->timestamps();
        });

        // Create table for associating permissions to users (Many To Many Polymorphic)
        Schema::create('permission_user', function (Blueprint $table) {
            $table->unsignedInteger('permission_id')->index();
            $table->unsignedInteger('user_id')->index();
            $table->string('user_type');
            $table->foreign('permission_id')->references('id')->on('permissions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['user_id', 'permission_id', 'user_type']);
            $table->tinyInteger('status')->unsigned()->default(1);
            $table->timestamps();
        });

        // Create table for associating permissions to roles (Many-to-Many)
        Schema::create('permission_role', function (Blueprint $table) {
            $table->unsignedInteger('permission_id')->index();
            $table->unsignedInteger('role_id')->index();
            $table->foreign('permission_id')->references('id')->on('permissions')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->primary(['permission_id', 'role_id']);
            $table->tinyInteger('status')->unsigned()->default(1);
            $table->timestamps();
        });

        // Schema::create('action_permission', function (Blueprint $table) {
        //     $table->unsignedInteger('action_id')->index();
        //     $table->unsignedInteger('permission_id')->index();
        //     $table->foreign('action_id')->references('id')->on('actions')
        //         ->onUpdate('cascade')->onDelete('cascade');
        //     $table->foreign('permission_id')->references('id')->on('permissions')
        //         ->onUpdate('cascade')->onDelete('cascade');
        //     $table->tinyInteger('is_active')->unsigned()->default(1);
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return  void
     */
    public function down()
    {
        Schema::dropIfExists('permission_user');
        Schema::dropIfExists('permission_role');
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('role_user');
        Schema::dropIfExists('roles');
    }
}
