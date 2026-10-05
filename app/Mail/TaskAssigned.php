<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TaskAssigned extends Mailable
{
    use Queueable, SerializesModels;

    public $task;
    public $technician;

    public function __construct($task)
    {
        $this->task = $task;
    }

    public function build()
    {
        return $this->markdown('emails.task_assigned')
        ->subject('Task Assigned')
        ->with([
            'title' => $this->task->title,
            'description' => $this->task->description,
            'taskId' => $this->task->id,
        ]);

        
       
    }
}

