<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('slug');
            $table->string('name')->unique();
            $table->string('name_kh');
            $table->text('note')->nullable()->default(NULL);
            $table->integer('status')->default(1);
            $table->string('image')->default('default-product.jpg');
            $table->decimal('buy_price', 8, 2);
            $table->decimal('sale_price', 8, 2);
            $table->unsignedInteger('category_id')->default(0);
            $table->unsignedInteger('created_by')->default(0);
            $table->unsignedInteger('updated_by')->default(0);
            $table->unsignedInteger('deleted_by')->default(0);
            $table->timestamps();
            $table->softDeletes();
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
