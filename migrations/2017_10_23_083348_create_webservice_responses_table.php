<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWebserviceResponsesTable extends Migration
{

    public function up()
    {
        Schema::create('webservice_responses', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedInteger('request_id');
            $table->unsignedBigInteger('client_id')->unsigned()->nullable();

            $table->enum('status', ['INIT', 'SEND', 'RECEIVE', 'FAULT', 'SUCCESS'])->default('INIT');
            $table->json('params')->nullable();
            $table->integer('related_id')->unsigned()->nullable();
            $table->longText('response')->nullable();
            $table->string('store')->nullable();
            $table->decimal('total_time')->nullable();
            $table->json('parsed_response')->nullable();
            $table->json('info')->nullable();
            $table->json('headers')->nullable();

            $table->timestamps();

            $table->foreign('related_id')->references('id')->on('webservice_responses');
            $table->foreign('request_id')->references('id')->on('webservice_requests');
        });
    }

    public function down()
    {
        Schema::drop('webservice_responses');
    }
}