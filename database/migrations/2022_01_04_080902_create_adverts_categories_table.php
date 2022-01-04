<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertsCategoriesTable extends Migration
{
    public function up()
    {
        Schema::create('adverts_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->string('slug');
            $table->nestedSet();
        });
    }

    public function down()
    {
        Schema::dropIfExists('adverts_categories');
    }
}
