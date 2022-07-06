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
        Schema::create('scrapings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Analysis::class);
            $table->string('url', 512)->index();
            $table->text('html')->nullable();
            $table->text('text')->nullable();
            $table->enum('status', ['pending', 'success', 'error'])->default('pending');
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
        Schema::dropIfExists('scrapings');
    }
};
