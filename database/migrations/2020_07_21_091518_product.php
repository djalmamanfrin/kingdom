<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Product extends Migration
{
    private $table = 'product';
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('company_id');
            $table->boolean('is_active')->default(0);
            $table->decimal('value', 10, 2);
            $table->integer('quantity')->default(0);
            $table->timestamp('created_at')
                ->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')
                ->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

            $table->foreign('company_id')->references('id')->on('company');
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
