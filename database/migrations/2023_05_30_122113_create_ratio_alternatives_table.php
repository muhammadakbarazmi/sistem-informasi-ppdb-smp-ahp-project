<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatioAlternativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ratio_alternatives', function (Blueprint $table) {
            $table->id();
            // $table->date('period');
            $table->unsignedInteger('h_alternative_id');
            $table->unsignedInteger('v_alternative_id');
            $table->unsignedInteger('criteria_id');
            $table->unsignedFloat('value');
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
        Schema::dropIfExists('ratio_alternatives');
    }
}
