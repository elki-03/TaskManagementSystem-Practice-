<?php
defined ('BASEPATH') OR exit('No direct script access allowed');

class Task_model extends CI_Model {

    //Constructor
    public function __construct() {
        parent::__construct();   
    }

    //gets all tasks by one user with filter-option
    public function all_tasks_by_user($filter = null) {
        $user_id = $this->session->userdata('user_id');
        $this->db->where('user_id', $user_id);
    
        if ($filter === 'pending') {
            $this->db->where('pending', 1);
        } elseif ($filter === 'completed') {
            $this->db->where('completed', 1);
        }
        return $this->db->get('tasks')->result();
    }
    
    //get user from session and inserts new task in database
    public function new_task($task) {
        $user_id = $this->session->userdata('user_id');    
        // check if user_id exists
        if (!$user_id) {
            return false;
        }
        return $this->db->insert('tasks', [
            'task' => $task,
            'user_id' => $user_id //--> so user_id is connected to task (from session)
        ]);
    }
    
    //updates task in database
    public function update_task($id, $data) {
        $this->db->where('task_id', $id);
        return $this->db->update('tasks', $data);
    }

    //deletes task in database
    public function delete_task($id) {
        $this->db->where('task_id', $id);
        return $this->db->delete('tasks');
    }
}