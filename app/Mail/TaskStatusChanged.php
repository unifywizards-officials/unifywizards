<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TaskStatusChanged extends Mailable
{
    use Queueable, SerializesModels;

    public $task;

    public function __construct($task)
    {
        $this->task = $task;
    }

    public function build()
    {
        return $this->markdown('emails.task_status_changed')
                    ->subject('Task Status Updated')
                    ->with([
                        'taskTitle' => $this->task->title,
                        'taskStatus' => $this->task->status,
                        'taskId' => $this->task->id,
                    ]);
    }
}
