<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->text('about');
            $table->integer('price')->default(99);
            $table->integer('stock_quantity')->default(10);
            $table->unsignedTinyInteger('discount')->default(10);

            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade'); 
            // $table->boolean('shop')->default(1); (is product available for shopping)
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
        Schema::dropIfExists('products');
    }
}
