<?php

use App\Helpers\UserTeamStatus;
use App\Model\Team;
use App\Model\UserTeam;
use App\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTeamsTable extends Migration
{
    protected $table = UserTeam::TABLE_NAME;

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('team_id')->nullable();
            $table->unsignedBigInteger('supervised_by_id')->nullable();
            $table->boolean('is_admin')->default(0);
            $table->enum('status', UserTeamStatus::getConsts()->values()->toArray());
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on(User::TABLE_NAME)
                ->onDelete('cascade');
            $table->foreign('team_id')
                ->references('id')
                ->on(Team::TABLE_NAME)
                ->onDelete('cascade');
            $table->foreign('supervised_by_id')
                ->references('id')
                ->on($this->table)
                ->onDelete('set null');

            $table->unique(['user_id', 'team_id']);
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
