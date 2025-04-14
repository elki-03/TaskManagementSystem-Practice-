<!-- 2.	Task Management 
o	Each user can create tasks, and tasks are linked to their user account. 
o	Allow users to update, delete, and filter tasks (e.g., view only pending or completed tasks).  -->

<?php
defined ('BASEPATH') OR exit('No direct script access allowed');

class Tasks extends CI_Controller {


    //Constructor
    public function __construct() {
        parent::__construct();
        //$this->load->library('session'); //evtl autoload weil überall verwendet?
        $this->load->model('Task_model');
    }


    // //filter without dropdown, load view with all tasks of the logged in user
    public function index() {
        $data['message'] = '';
    
        // get Filter from URL ( ?filter=pending)
        $filter = $this->input->get('filter');
    
        // give filter to model
        $data['tasks'] = $this->Task_model->all_tasks_by_user($filter);
    
        $this->load->view('tasks/index', $data);
    }


    // when button is clicked, this loads the create-view (view where new tasks are created)
    public function button_create() {
        $this->load->view('tasks/create');
    }
   

    //creates a new task (for the logged in user)
    public function create() {
        $task = $this->input->post('task');
        if (!empty($task)) {
            $this->Task_model->new_task($task);
            redirect('tasks/index'); 
        }
    
        redirect('tasks/index');
    }

    
    //gives a task the state "completed" in a view through an "x" inside the table
    public function update($id) {
        $this->load->model('Task_model');
    
        $data = [
            'completed' => 1,
            'pending' => 0
        ];
    
        $this->Task_model->update_task($id, $data);
        redirect('tasks/index');
    }


    //deletes a task
    public function delete($id) {
        $this->load->model('Task_model');
        $this->Task_model->delete_task($id);
        redirect('tasks/index');
    }


        // Logout: ends current session and redirects to login view
    public function logout() {
        // destroys session and back to login
        $this->session->sess_destroy();
        redirect('login');
    }
}

