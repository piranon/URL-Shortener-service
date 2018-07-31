<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\URL;

class CreateUrlTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('url', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 7);
            $table->integer('hits');
            $table->text('url');
            $table->string('status')->default(URL::STATUS_ACTIVE);
            $table->timestamp('expires_in');
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
        Schema::dropIfExists('url');
    }
}
