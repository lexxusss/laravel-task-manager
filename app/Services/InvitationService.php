<?php


namespace App\Services;


use App\Helpers\UserTeamStatus;
use App\Model\UserTeam;
use App\Notifications\InvitationToATeam;

class InvitationService
{
    const TOKEN_URL_VAR_NAME = 'token';

    /**
     * @return string
     */
    private function getLink()
    {
        return route('accept_invitation_form')
            . '?' . self::TOKEN_URL_VAR_NAME . '=' . $this->generateInvitationToken();
    }

    /**
     * @return bool|string
     */
    private function generateInvitationToken()
    {
        return substr(md5(rand(0, 9) . uniqid() . time()), 0, 32);
    }

    /**
     * @param UserTeam $userTeam
     */
    public function send(UserTeam $userTeam)
    {
        $inviteEmail = new InvitationToATeam($userTeam, $this->getLink());

        $userTeam->user->notify($inviteEmail);

        $userTeam->update(['status' => UserTeamStatus::USER_STATUS_INVITATION_SENT]);
    }
}
