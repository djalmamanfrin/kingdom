<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Church extends Migration
{
    private $table = 'church';
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('branch_id');
            $table->unsignedInteger('address_id');
            $table->string('name')->nullable();
            $table->char('cnpj', 14)->unique();
            $table->timestamp('created_at')
                ->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')
                ->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

            $table->foreign('branch_id')->references('id')->on('branch');
            $table->foreign('address_id')->references('id')->on('address');
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
