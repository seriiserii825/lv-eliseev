<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdvertsCategoriesAttributesTable extends Migration
{
    public function up()
    {
        Schema::create('adverts_categories_attributes', function (Blueprint $table) {
            $table->id();
            $table->integer('adverts_category_id');
            $table->foreign('adverts_category_id')->references('id')->on('adverts_categories');
            $table->integer('attribute_id');
            $table->foreign('attribute_id')->references('id')->on('attributes');
            $table->string('variants');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('adverts_categories_attributes');
    }
}
