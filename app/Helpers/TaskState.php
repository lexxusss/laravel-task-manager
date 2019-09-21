<?php


namespace App\Helpers;


class TaskState
{
    use EnumHelper;

    const NOT_VIEWED = 'not viewed';
    const PENDING = 'pending';
    const IN_PROGRESS = 'in progress';
    const IN_TESTING = 'in testing';
    const DONE = 'done';
}
