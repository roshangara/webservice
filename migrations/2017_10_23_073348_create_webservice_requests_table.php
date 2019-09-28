<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebserviceRequestsTable extends Migration
{

    public function up()
    {
        Schema::create('webservice_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('class', 50);
            $table->string('function', 50);
            $table->string('group', 30)->nullable();
            $table->enum('protocol', ['Soap', 'Rest'])->default('Rest');
            $table->enum('method', ['GET', 'POST', 'PUT', 'DELETE', 'PATCH', 'OPTIONS']);
            $table->enum('content_type', ['json']);
            $table->string('url');
            $table->string('sender');
            $table->softDeletes();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::drop('webservice_requests');
    }
}