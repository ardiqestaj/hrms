<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EditedAttendanceNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($editAttend)
    {
        $this->editAttend = $editAttend;
        // $this->status = $requestt;
        // $this->day = $requestt;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
    //  */
    public function toMail($notifiable)
    {
        // $leavetypes = DB::table('leave_types')->where('leave_id', $this->leaves['leave_type_id'])->select('leave_names')->first();
        return (new MailMessage)
                    // ->name('kashwbda')
                    ->subject('Attendence Edited')
                    ->line('Your attendance has been updated on this day ' . $this->editAttend['date'] . ', Time In: ' . $this->editAttend['time_in'] . ' Time out: ' . $this->editAttend['time_out'] )
                    ->action('Notification Action', route('employee/attendance'))
                    ->line('Thank you for using our application!');
    }

     /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'time_in' => $this->editAttend['time_in'],
            'time_out' => $this->editAttend['time_out'],
            'date' => $this->editAttend['date']
        ];
    }
}
