<?php

namespace App;

use App\Model\Task;
use App\Model\Team;
use App\Model\UserTeam;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Routing\Route;

/**
 * App\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Task[] $tasksCreated
 * @property-read int|null $tasks_created_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Task[] $tasksExecuted
 * @property-read int|null $tasks_executed_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Team[] $teams
 * @property-read int|null $teams_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\UserTeam[] $usersTeams
 * @property-read int|null $users_teams_count
 */
class User extends Authenticatable
{
    const TABLE_NAME = 'users';

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'is_active', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /*--- RELATIONS ---*/
    /**
     * @return HasMany|Task
     */
    public function tasksCreated()
    {
        return $this->hasMany(Task::class, 'user_creator_id', 'id');
    }

    /**
     * @return HasMany|Task
     */
    public function tasksExecuted()
    {
        return $this->hasMany(Task::class, 'user_executor_id', 'id');
    }

    /**
     * @param Team $team
     * @return Task|Builder
     */
    public function tasksExecutedInTeam(Team $team)
    {
        return $this->tasksExecuted()->whereTeamId($team->id);
    }

    /**
     * @return BelongsToMany|Team
     */
    public function teams()
    {
        return $this->belongsToMany(Team::class, UserTeam::class, 'user_id', 'team_id');
    }

    /**
     * @return HasMany|UserTeam
     */
    public function usersTeams()
    {
        return $this->hasMany(UserTeam::class, 'user_id', 'id');
    }
    /*--- /RELATIONS ---*/


    /*--- BOOLEANS ---*/
    /**
     * @param Team $team
     * @return bool
     */
    public function isInTeam(Team $team)
    {
        return !! $this->getUserTeam($team);
    }

    /**
     * @param Team $team
     * @return int|mixed
     */
    public function isAdminOfTeam(Team $team)
    {
        return $this->getUserTeam($team)->is_admin;
    }
    /*--- /BOOLEANS ---*/

    /**
     * @param Team $team
     * @return UserTeam|null
     */
    public function getUserTeam(Team $team)
    {
        return $this->usersTeams()->whereTeamId($team->id)->first();
    }
}
