<?php
namespace ToDo\Repository;

use ToDo\Context\DatabaseContext;

class TodoRepository {

    private $db;

    public function __construct() {
        $this->db = DatabaseContext::getInstance();
    }

    // Create a new todo
    public function createTodo($userId, $todo) {
        $userRef = $this->db->collection('users')->document($userId);
        $userData = $userRef->snapshot()->data();
        $todo = [
            'task' => 'abcde',
            'labels' => 'sjhuh',
            'isDone' => false,
            'timeStamp' => new \DateTime(),
            'updatedAt' => new \DateTime()
        ];
        $newTodo = [
            'task' => $todo['task'],
            'labels' => $todo['labels'] ?? null,
            'isDone' => $todo['isDone'],
            'timeStamp' => $todo['timeStamp'] ?? null,
            'updatedAt' => $todo['updatedAt'] ?? null
        ];

        if ($userData && isset($userData['todos'])) {
            $userData['todos'][] = $newTodo;
        } else {
            $userData = ['todos' => [$newTodo]];
        }
        $userRef->set($userData);
    }

    // public function getTodos($userId) {
    //     $userRef = $this->db->collection('users')->document($userId);
    //     $userSnapshot = $userRef->snapshot();

    //     if ($userSnapshot->exists()) {
    //         return $userSnapshot->data()['todos'] ?? [];
    //     }

    //     return [];
    // }

    // public function updateTodo($userId, $todoIndex, $updatedTodo) {
    //     $userRef = $this->db->collection('users')->document($userId)->;
    //     $userData = $userRef->get;

    //     if ($userData && isset($userData['todos']) && isset($userData['todos'][$todoIndex])) {
    //         $userData['todos'][$todoIndex] = array_merge($userData['todos'][$todoIndex], $updatedTodo);
            
    //         $userData['updatedTime'] = new \DateTime();

    //         $userRef->set($userData);
    //     }
    // }

    public function deleteTodo($userId, $todoIndex) {
        $userRef = $this->db->collection('users')->document($userId);
        $userData = $userRef->snapshot()->data();

        if ($userData && isset($userData['todos']) && isset($userData['todos'][$todoIndex])) {
            array_splice($userData['todos'], $todoIndex, 1);
            $userData['updatedTime'] = new \DateTime();
            $userRef->set($userData);
        }
    }
}
