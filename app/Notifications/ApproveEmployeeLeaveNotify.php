<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use DB;

class ApproveEmployeeLeaveNotify extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($leaves)
    {
        $this->leaves = $leaves;
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
        $leavetypes = DB::table('leave_types')->where('leave_id', $this->leaves['leave_type_id'])->select('leave_names')->first();
        return (new MailMessage)
                    // ->name('kashwbda')
                    ->subject('Leaves Applies - ' . $leavetypes->leave_names)
                    ->line('Your leaves applies from ' . $this->leaves['from_date'] . ' to ' . $this->leaves['to_date'] . ' has been ' . $this->leaves['status'])
                    ->action('Notification Action', route('form/leavesemployee/new'))
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
            'status' => $this->leaves['status'],
            'from_date' => $this->leaves['from_date'],
            'to_date' => $this->leaves['to_date'],
            'leave_type_id' => $this->leaves['leave_type_id']
        ];
    }
}
