<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValidDomainsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('valid_domains', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->text('url');
            $table->uuid('oauth_clients_id')->index();
            $table->foreign('oauth_clients_id')->references('id')->on('oauth_clients')->onDelete('cascade');
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
        Schema::dropIfExists('valid_domains');
    }
}
