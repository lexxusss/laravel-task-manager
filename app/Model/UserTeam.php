<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * App\Model\UserTeam
 *
 * @property int $id
 * @property int|null $user_id
 * @property int|null $team_id
 * @property int|null $supervised_by_id
 * @property int $is_admin
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\User|null $supervisor
 * @property-read \App\Model\Team|null $team
 * @property-read \App\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserTeam newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserTeam newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserTeam query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserTeam whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserTeam whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserTeam whereIsAdmin($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserTeam whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserTeam whereSupervisedById($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserTeam whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserTeam whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\UserTeam whereUserId($value)
 * @mixin \Eloquent
 */
class UserTeam extends Pivot
{
    const TABLE_NAME = 'users_teams';

    protected $table = self::TABLE_NAME;

    protected $fillable = [
        'user_id',
        'team_id',
        'supervised_by_id',
        'is_admin',
        'status',
    ];

    /*--- RELATIONS ---*/
    /**
     * @return BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function supervisor()
    {
        return $this->belongsTo(User::class, 'supervised_by_id', 'id');
    }
    /*--- /RELATIONS ---*/
}
