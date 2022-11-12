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
        Schema::create('list_note', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('list_id');
            $table->unsignedBigInteger('note_id');

            $table->foreign('list_id')->references('id')->on('lists')->onDelete('cascade');
            $table->foreign('note_id')->references('id')->on('notes')->onDelete('cascade');

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
        Schema::dropIfExists('list_note');
    }
};
