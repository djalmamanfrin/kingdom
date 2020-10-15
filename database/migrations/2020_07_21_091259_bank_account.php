<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BankAccount extends Migration
{
    private $table = 'bank_account';
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('bank_id');
            $table->string('nickname')->nullable();
            $table->string('agency');
            $table->string('account');
            $table->char('document', 14)->unique();
            $table->tinyInteger('type')->comment('1 - conta corrente; 2 - conta poupança');
            $table->timestamp('created_at')
                ->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')
                ->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

            $table->foreign('user_id')->references('id')->on('user');
            $table->foreign('bank_id')->references('id')->on('bank');
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
