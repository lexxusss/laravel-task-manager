<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Model\Task
 *
 * @property int $id
 * @property string $name
 * @property string|null $comment
 * @property string|null $file
 * @property int|null $is_closed
 * @property string|null $time_from
 * @property string|null $time_to
 * @property string|null $state
 * @property int|null $user_creator_id
 * @property int|null $user_executor_id
 * @property int|null $task_type_id
 * @property int|null $team_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Model\TaskType|null $taskType
 * @property-read \App\Model\Team|null $team
 * @property-read \App\User|null $userCreator
 * @property-read \App\User|null $userExecutor
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Task newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Task newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Task query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Task whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Task whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Task whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Task whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Task whereIsClosed($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Task whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Task whereState($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Task whereTaskTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Task whereTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Task whereTimeFrom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Task whereTimeTo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Task whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Task whereUserCreatorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\Task whereUserExecutorId($value)
 * @mixin \Eloquent
 */
class Task extends Model
{
    const TABLE_NAME = 'tasks';

    protected $table = self::TABLE_NAME;

    protected $fillable = [
        'name',
        'comment',
        'file',
        'is_closed',
        'time_from',
        'time_to',
        'state',
        'user_creator_id',
        'user_executor_id',
        'task_type_id',
        'team_id',
    ];

    /*--- RELATIONS ---*/
    /**
     * @return BelongsTo
     */
    public function userCreator()
    {
        return $this->belongsTo(User::class, 'user_creator_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function userExecutor()
    {
        return $this->belongsTo(User::class, 'user_executor_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function taskType()
    {
        return $this->belongsTo(TaskType::class, 'task_type_id', 'id');
    }

    /**
     * @return BelongsTo
     */
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id', 'id');
    }
    /*--- /RELATIONS ---*/
}
