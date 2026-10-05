<?php
namespace App\Mail;

use App\Models\Task;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TaskComment extends Mailable
{
    use Queueable, SerializesModels;

    public $task;

    public function __construct($TaskComment)
    {
        $this->TaskComment = $TaskComment;
        $this->task = Task::find($TaskComment->task_id);
    }

    public function build()
    {
        return $this->markdown('emails.task_comments')
                    ->subject('Task Comments')
                    ->with([
                        'taskId' => $this->task->id,
                        'taskTitle' => $this->task->title,
                        'TaskCommentDescription' => $this->TaskComment->description,
                        'TaskCommentStatus' => $this->TaskComment->status,
                    ]);
    }
}
