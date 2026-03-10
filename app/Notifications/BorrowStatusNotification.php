<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class BorrowStatusNotification extends Notification
{
    use Queueable;
    public $borrow, $student;

    /**
     * Create a new notification instance.
     */
    public function __construct($borrow, $student)
    {
        $this->borrow = $borrow;
        $this->student = $student;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    // public function toMail(object $notifiable): MailMessage
    // {
    //     return (new MailMessage)
    //         ->line('The introduction to the notification.')
    //         ->action('Notification Action', url('/'))
    //         ->line('Thank you for using our application!');
    // }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }

    public function toDatabase(object $notifiable): array
    {
        return [
            'borrow_id' => $this->borrow->id,
            'book_title' => $this->borrow->book_title,
            'status' => $this->borrow->is_returned ? 'Returned' : 'Borrowed',
            'borrowed_at' => $this->borrow->borrowed_at,
            'returned_at' => $this->borrow->returned_at,
            'student_id' => $this->borrow->student_id,
            'student_name' => $this->student->name,
        ];
    }
}
