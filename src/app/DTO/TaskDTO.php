<?php
declare(strict_types=1);
namespace App\DTO;

use App\Contracts\DTOContract;

class TaskDTO implements DTOContract
{
    public  $title;
    public  $priority;
    public  $description;
    public  $status;
    public  $completedAt;
    public  $id;
    private $user_id;

    public function __construct(
         $id,
         $title = null,
         $priority = null,
         $description = null,
         $status = null,
         $completedAt = null,
         $user_id = null,
    ) {
        $this->id = $id;
        $this->title = $title;
        $this->priority = $priority;
        $this->description = $description;
        $this->status = $status;
        $this->completedAt = $completedAt;
        $this->user_id = $user_id;
    }

    public function setUserId(int $user_id)
    {
        $this->user_id = $user_id;
        return $this;
    }

    public function getUserId()
    {
        return $this->user_id;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' =>$this->title,
            'user_id' => $this->user_id,
            'priority' => $this->priority,
            'description' => $this->description,
            'status' => $this->status,
            'completedAt '=> $this->completedAt
        ];
    }
}
