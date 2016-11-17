<?php

class Controller_Comments extends Controller
{
    function __construct()
    {
        parent::__construct();
        @session_start();
        $this->model = new Model_comments($this->db);
    }

    function action_index()
    {

        if(isset($_POST['del_comment'])) {
            $data['comment'] = $this->model->del_comment($_POST['id_comment']);
        }
        if(isset($_POST['add_comment'])) {
            $data['comment'] = $this->model->add_comment($_POST['user'],$_POST['comment'],$_POST['raiting']);
        }
        if(isset($_POST['navig_comment'])){
            $data['comments'] = $this->model->get_commets($_POST['navig_comment']);
        }
        else{
            $data['comments'] = $this->model->get_commets(1);
        }



        $data['comments_count'] = $this->model->get_count();
        $this->view->generate('comments_view.php', 'template_view.php',$data);
    }
}