<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebserviceRequestsTable extends Migration
{

    public function up()
    {
        Schema::create('webservice_requests', function (Blueprint $table) {
            $table->increments('id');

            $table->string('class', 50);
            $table->string('function', 50);
            $table->string('method', 10);
            $table->string('group', 30)->nullable();

            $table->string('protocol', 10);
            $table->string('contentType', 20);
            $table->string('url');
            $table->string('sender');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::drop('webservice_requests');
    }
}