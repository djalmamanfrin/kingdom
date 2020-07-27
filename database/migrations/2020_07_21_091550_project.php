<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class Project extends Migration
{
    private $table = 'project';
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('branch_id');
            $table->unsignedInteger('project_type_id');
            $table->string('title');
            $table->mediumText('description');
            $table->timestamp('delivery_at');
            $table->timestamp('expected_at');
            $table->timestamp('created_at')
                ->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')
                ->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));

            $table->foreign('branch_id')->references('id')->on('branch');
            $table->foreign('project_type_id')->references('id')->on('project_type');
        });
    }

    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
