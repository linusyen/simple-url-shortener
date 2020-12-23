<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUrlMappingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('url_mappings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('url');
            $table->boolean('is_used')->default(false);
            $table->timestamps();

            $table->index(['is_used', 'key']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('url_mappings');
    }
}
