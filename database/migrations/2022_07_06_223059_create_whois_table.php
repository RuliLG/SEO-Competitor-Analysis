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
            $table->string('registrant_name')->nullable();
            $table->string('registrant_organization')->nullable();
            $table->string('registrant_street')->nullable();
            $table->string('registrant_city')->nullable();
            $table->string('registrant_state')->nullable();
            $table->string('registrant_postal_code')->nullable();
            $table->string('registrant_country')->nullable();
            $table->string('registrant_phone')->nullable();
            $table->string('registrant_fax')->nullable();
            $table->string('registrant_email')->nullable();
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
