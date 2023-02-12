<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            
            $table->unsignedBigInteger('class_id');
            $table->unsignedBigInteger('school_id');
            $table->unsignedBigInteger('admin_id')->nullable();
            $table->unsignedBigInteger('SubKlass_id')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->date('dateofbirth')->nullable();
            $table->string('lga')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('current_address')->nullable();
            $table->string('reg_num')->nullable();
            $table->string('graduate_status')->nullable();
            $table->string('studentPwd4AdminView');
            $table->unsignedBigInteger('session_id');
            $table->unsignedBigInteger('current_session');
            $table->string('demote_status')->default(0);

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
        Schema::dropIfExists('students');
    }
}
