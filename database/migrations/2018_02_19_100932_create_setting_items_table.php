<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting_items', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('setting_type_id')->default(0);
            $table->string('setting_type_model');
            $table->string('slug')->unique();
            $table->string('name');
            $table->string('name_kh');
            $table->string('value');
            $table->string('note');
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
        Schema::dropIfExists('setting_items');
    }
}
