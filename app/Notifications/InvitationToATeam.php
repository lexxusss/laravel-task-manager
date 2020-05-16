<?php

namespace App\Notifications;

use App\Model\UserTeam;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvitationToATeam extends Notification
{
    use Queueable;

    /**
     * @var User
     */
    public $userTeam;

    /**
     * @var string
     */
    public $link;

    /**
     * @var string
     */
    public $subject;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $footer;

    /**
     * Invitation_To_A_Team constructor.
     * @param UserTeam $userTeam
     * @param string $link
     */
    public function __construct(UserTeam $userTeam, string $link)
    {
        $this->userTeam = $userTeam;
        $this->link = $link;

        $this->subject = 'Invitation to a team';
        $this->title = $this->subject . ' ' . $userTeam->team->name . ' from ' . $userTeam->user->email;
        $this->footer = 'Thank you for using ' . config('app.name') . '!';
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject($this->subject)
                    ->line($this->title)
                    ->action('Accept invite', $this->link)
                    ->line($this->footer);
    }
}
