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
        Schema::create('teams_competitions', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('competition_id');
            $table->unsignedBigInteger('team_id');
            $table->unsignedInteger('group_id');
            $table->unsignedTinyInteger('order');
            $table->timestamps();

            $table->unique(['competition_id', 'team_id']);

			$table->foreign('competition_id')->references('id')->on('competitions')->onDelete('cascade');
			$table->foreign('team_id')->references('id')->on('teams')->onDelete('cascade');
			$table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teams_competitions');
    }
};
