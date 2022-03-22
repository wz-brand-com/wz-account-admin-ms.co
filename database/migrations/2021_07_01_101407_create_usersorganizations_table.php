<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersorganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usersorganizations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('invited_by')->nullable();
            $table->string('invited_by_email')->nullable();
            $table->string('u_org_user_id')->nullable();
            $table->string('u_org_user_name')->nullable();
            $table->string('u_org_user_email')->nullable();
            $table->string('u_org_role_id')->nullable();
            $table->string('u_org_role_name')->nullable();
            $table->string('u_org_organization_id')->nullable();
            $table->string('u_org_slugname')->nullable();
            $table->enum('status', array('1','0','-1'))->default('1');
            $table->enum('invited_removed', array('1','0','-1'))->default('1');
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
        Schema::dropIfExists('usersorganizations');
    }
}
