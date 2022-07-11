<?php

use App\Models\Analysis;
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
        Schema::create('competitors', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Analysis::class);
            $table->string('domain', 80)->index();
            $table->boolean('is_competitor')->default(true)->index();
            $table->double('avg_position');
            $table->bigInteger('pos_1');
            $table->bigInteger('pos_2_3');
            $table->bigInteger('pos_4_10');
            $table->bigInteger('pos_11_20');
            $table->bigInteger('pos_21_30');
            $table->bigInteger('pos_31_40');
            $table->bigInteger('pos_41_50');
            $table->bigInteger('pos_51_60');
            $table->bigInteger('pos_61_70');
            $table->bigInteger('pos_71_80');
            $table->bigInteger('pos_81_90');
            $table->bigInteger('pos_91_100');
            $table->decimal('etv', 20, 8);
            $table->bigInteger('impressions_etv');
            $table->bigInteger('count');
            $table->bigInteger('is_new');
            $table->bigInteger('is_up');
            $table->bigInteger('is_down');
            $table->bigInteger('is_lost');
            $table->timestamps();

            $table->unique(['analysis_id', 'domain']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('competitors');
    }
};
