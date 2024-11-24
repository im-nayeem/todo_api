<?php
namespace ToDo\Models;
class Todo
{
    private $task;
    private $labels;
    private $isDone;
    private $timeStamp;
    private $updatedAt;

    public function __construct($task, $labels = "", $isDone = false, $timeStamp = null, $updatedAt = null)
    {
        $this->task = $task;
        $this->labels = $labels;
        $this->isDone = $isDone;
        $this->timeStamp = $timeStamp;
        $this->updatedAt = $updatedAt;
    }

    public function getTask()
    {
        return $this->task;
    }

    public function setTask($task)
    {
        $this->task = $task;
    }

    public function getLabels()
    {
        return $this->labels;
    }

    public function setLabels($labels)
    {
        $this->labels = $labels;
    }

    public function isDone()
    {
        return $this->isDone;
    }

    public function setIsDone($isDone)
    {
        $this->isDone = $isDone;
    }

    public function getTimeStamp()
    {
        return $this->timeStamp;
    }

    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    public function setTimeStamp($timeStamp)
    {
        $this->timeStamp = $timeStamp;
    }
    public function setUpdatedAt($timeStamp)
    {
        $this->updatedAt = $timeStamp;
    }

    public function toArray()
    {
        return [
            'task' => $this->task,
            'labels' => $this->labels,
            'isDone' => $this->isDone,
            'timeStamp' => $this->timeStamp, 
            'updatedAt' => $this->updatedAt
        ];
    }
}
