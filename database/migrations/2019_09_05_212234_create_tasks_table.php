<?php

use App\Helpers\TaskState;
use App\Model\Task;
use App\Model\TaskType;
use App\Model\Team;
use App\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    protected $table = Task::TABLE_NAME;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->text('comment')->nullable();
            $table->string('file')->nullable();
            $table->boolean('is_closed')->nullable();
            $table->timestamp('time_from')->nullable();
            $table->timestamp('time_to')->nullable();
            $table->enum('state', TaskState::getConsts()->values()->toArray())->nullable();
            $table->unsignedBigInteger('user_creator_id')->nullable();
            $table->unsignedBigInteger('user_executor_id')->nullable();
            $table->unsignedBigInteger('task_type_id')->nullable();
            $table->unsignedBigInteger('team_id')->nullable();
            $table->timestamps();

            $table->foreign('user_creator_id')
                ->references('id')
                ->on(User::TABLE_NAME)
                ->onDelete('set null');
            $table->foreign('user_executor_id')
                ->references('id')
                ->on(User::TABLE_NAME)
                ->onDelete('set null');
            $table->foreign('task_type_id')
                ->references('id')
                ->on(TaskType::TABLE_NAME)
                ->onDelete('set null');
            $table->foreign('team_id')
                ->references('id')
                ->on(Team::TABLE_NAME)
                ->onDelete('cascade');

            $table->unique(['user_creator_id', 'user_executor_id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->table);
    }
}
