<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeavesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaves', function (Blueprint $table) {
            $table->increments('id');
			$table->integer('user_id');
			$table->integer('leave_type_id');
			$table->date('date_from');
			$table->date('date_to');
			$table->date('applied_on');
			$table->text('reason');
			$table->text('comment');
			$table->integer('leave_no')->default(0);
			$table->boolean('status');
            $table->integer('staff_id')->nullable();
            $table->string('type')->nullable();
			$table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('leaves');
    }
}
