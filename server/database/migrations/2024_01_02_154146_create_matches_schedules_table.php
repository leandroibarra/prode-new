<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('matches_schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('competition_id');
            $table->unsignedInteger('instance_id');
            $table->unsignedInteger('group_id')->nullable();
            $table->unsignedTinyInteger('match_day')->nullable();
            $table->unsignedBigInteger('home_team_id');
            $table->unsignedBigInteger('away_team_id');
            $table->unsignedTinyInteger('home_goals')->nullable();
            $table->unsignedTinyInteger('away_goals')->nullable();
            $table->boolean('extra_time')->default(false);
            $table->boolean('penalties_kicks')->default(false);
			$table->unsignedTinyInteger('home_goals_penalties')->unsigned()->nullable();
			$table->unsignedTinyInteger('away_goals_penalties')->unsigned()->nullable();
            $table->enum('final_result', ['home', 'draw', 'away'])->nullable();
            $table->dateTime('utc_datetime')->nullable();
            $table->timestamps();

            $table->foreign('competition_id')->references('id')->on('competitions')->onDelete('cascade');
            $table->foreign('instance_id')->references('id')->on('instances')->onDelete('cascade');
            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
            $table->foreign('home_team_id')->references('id')->on('teams')->onDelete('cascade');
            $table->foreign('away_team_id')->references('id')->on('teams')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matches_schedules');
    }
};
