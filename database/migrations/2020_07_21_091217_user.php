<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class User extends Migration
{
    private $table = 'user';
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('profile_id')->default(1);
            $table->string('name')->nullable();
            $table->string('email')->unique();
            $table->string('password')->nullable();
            $table->boolean('is_member')->default(0);
            $table->string('rg')->nullable();
            $table->char('cpf', 11)->nullable();
            $table->softDeletes();
            $table->timestamp('created_at')
                ->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')
                ->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

            $table->foreign('profile_id')->references('id')->on('profile');
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
