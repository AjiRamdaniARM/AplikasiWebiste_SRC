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
        Schema::create('races', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->nullOnDelete();
            $table->string('name');
            $table->string('slug');
            $table->text('description');
            $table->string('point');
            $table->time('duration');
            $table->smallInteger('session');
            $table->dateTime('date_race', $precision = 0);
            $table->bigInteger('price');
            $table->date('deadline_reg');
            $table->boolean('team')->default(false);
            $table->smallInteger('max_people')->default(1);
            $table->boolean('document')->default(false);
            $table->string('image')->default('race.jpg');
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
        Schema::dropIfExists('races');
    }
};
