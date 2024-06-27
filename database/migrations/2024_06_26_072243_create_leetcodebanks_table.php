<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeetcodebanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leetcodebanks', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('question_slug')->unique();
            $table->string('difficulty');
            $table->decimal('acRate');
            $table->json('topic_tags');
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
        Schema::dropIfExists('leetcodebanks');
    }
}
