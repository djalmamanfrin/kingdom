<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Transaction extends Migration
{
    private $table = 'transaction';
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('order_id');
            $table->unsignedInteger('bank_card_id');
            $table->unsignedInteger('currency_id');
            $table->decimal('value', 10, 2);
            $table->decimal('discount', 10, 2)->default(0);
            $table->timestamp('created_at')
                ->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')
                ->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

            $table->foreign('order_id')->references('id')->on('order');
            $table->foreign('bank_card_id')->references('id')->on('bank_card');
            $table->foreign('currency_id')->references('id')->on('currency');
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
