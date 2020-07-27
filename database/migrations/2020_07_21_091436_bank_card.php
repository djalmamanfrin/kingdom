<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BankCard extends Migration
{
    private $table = 'bank_card';
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('brand_id');
            $table->string('owner');
            $table->char('number', 16);
            $table->char('expiry_month', 2);
            $table->char('expiry_year', 4);
            $table->timestamp('created_at')
                ->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')
                ->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('brand_id')->references('id')->on('brand');
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
