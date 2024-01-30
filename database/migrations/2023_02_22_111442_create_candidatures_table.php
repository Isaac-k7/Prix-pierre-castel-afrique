<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('candidatures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('pays_id')->index();
            $table->unsignedBigInteger('editions_id')->index();
            $table->json('lien_rx')->nullable();
            $table->unsignedBigInteger('accepted_by')->index()->nullable();
            $table->integer('status')->default(0);
            $table->boolean('update_count')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('pays_id')->references('id')->on('pays');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('editions_id')->references('id')->on('editions');
            $table->foreign('accepted_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('candidats');
    }
};
