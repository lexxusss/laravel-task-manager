<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * App\Model\Team
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Task[] $tasks
 * @property-read int|null $tasks_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Team newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Team newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Team query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Team whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Team whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Team whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Team whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Team whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\UserTeam[] $usersTeams
 * @property-read int|null $users_teams_count
 */
class Team extends Model
{
    const TABLE_NAME = 'teams';

    protected $table = self::TABLE_NAME;

    protected $fillable = [
        'name',
        'description',
    ];

    /*--- RELATIONS ---*/
    /**
     * @return HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class, 'team_id', 'id');
    }

    /**
     * @return BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(User::class, UserTeam::class, 'team_id', 'user_id');
    }

    /**
     * @return HasMany|UserTeam
     */
    public function usersTeams()
    {
        return $this->hasMany(UserTeam::class, 'team_id', 'id');
    }
    /*--- /RELATIONS ---*/

    /**
     * @param User|null $forUser
     * @return Collection
     */
    public function getCollaborators(User $forUser = null)
    {
        return $this->usersTeams()->whereNotIn('user_id', [$forUser->id ?? null])->get();
    }
}
