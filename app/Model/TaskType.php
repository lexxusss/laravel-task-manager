<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Model\TaskType
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Model\Task[] $tasks
 * @property-read int|null $tasks_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TaskType newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TaskType newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TaskType query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TaskType whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TaskType whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TaskType whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Model\TaskType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class TaskType extends Model
{
    const TABLE_NAME = 'task_types';

    protected $table = self::TABLE_NAME;

    protected $fillable = [
        'name'
    ];

    /*--- RELATIONS ---*/
    /**
     * @return HasMany
     */
    public function tasks()
    {
        return $this->hasMany(Task::class, 'task_type_id', 'id');
    }
    /*--- /RELATIONS ---*/
}
