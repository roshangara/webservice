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
            $table->enum('status', ['INIT', 'SEND', 'RECEIVE', 'FAULT', 'SUCCESS'])->default('INIT');
            $table->decimal('total_time')->nullable();
            $table->longText('response')->nullable();
            $table->string('store')->nullable();
            $table->json('info')->nullable();
            $table->json('errors')->nullable();
            $table->json('headers')->nullable();
            $table->json('parsed_response')->nullable();
            $table->json('params')->nullable();
            $table->bigInteger('request_id')->unsigned();
            $table->foreign('request_id')->references('id')->on('webservice_requests');
            $table->bigInteger('related_id')->unsigned()->nullable();
            $table->foreign('related_id')->references('id')->on('webservice_responses');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->softDeletes();
            $table->timestamps();

        });
    }

    public function down()
    {
        Schema::drop('webservice_responses');
    }
}
