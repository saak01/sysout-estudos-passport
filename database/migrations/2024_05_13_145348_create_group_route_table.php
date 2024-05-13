<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupRouteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_route', function (Blueprint $table) {
            $table->id();
            $table-> unsignedBigInteger('group_id');
            $table-> unsignedBigInteger('route_id');
            $table->foreign('group_id')->references('id')->on('groups');
            $table->foreign('route_id')->references('id')->on('routes');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_route');
    }
}
