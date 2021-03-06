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
        Schema::create('whois', function (Blueprint $table) {
            $table->id();
            $table->string('domain', 80)->index();
            $table->string('registrar')->nullable();
            $table->json('nameservers');
            $table->dateTime('expires_at')->index();
            $table->dateTime('last_updated_at')->nullable();
            $table->string('status')->nullable();
            $table->timestamps();

            $table->index(['domain', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('whois');
    }
};
