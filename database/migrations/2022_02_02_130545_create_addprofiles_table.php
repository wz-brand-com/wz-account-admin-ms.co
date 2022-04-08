<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddprofilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addprofiles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_name');
            $table->string('admin_id');
            $table->string('admin_email');
            $table->string('slug_id');
            $table->string('slugname');
            $table->string('u_org_role_id');
            $table->string('facebook');
            $table->string('twitter');
            $table->string('youtube');
            $table->string('wordpress');
            $table->string('tumblr');
            $table->string('instagram');
            $table->string('quora');
            $table->string('pinterest');
            $table->string('reddit');
            $table->string('koo');
            $table->string('scoopit');
            $table->string('slashdot');
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
        Schema::dropIfExists('addprofiles');
    }
}
