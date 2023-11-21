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
        Schema::create('product_sliders', function (Blueprint $table) {
            $table->id();
            $table->string('title',200);
            $table->string('short_des',500);
            $table->string('price',100);
            $table->string('image',200);

            $table->unsignedBigInteger('product_id')->unique();
            $table->foreign('product_id')->references('id')->on('product')
                ->restrictOnDelete()
                ->restrictOnUpdate();

            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_sliders');
    }
};
