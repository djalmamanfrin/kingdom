<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Branch extends Migration
{
    private $table = 'branch';
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('responsible_id');
            $table->string('name')->nullable();
            $table->string('email');
            $table->string('site')->nullable();
            $table->timestamp('created_at')
                ->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')
                ->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

            $table->foreign('responsible_id')->references('id')->on('responsible');
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
