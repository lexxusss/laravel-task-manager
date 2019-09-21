<?php


namespace App\Helpers;


class UserTeamStatus
{
    use EnumHelper;

    const USER_STATUS_PENDING = 'pending';
    const USER_STATUS_INVITATION_SENT = 'invitation sent';
    const USER_STATUS_ACTIVE = 'active';
}
