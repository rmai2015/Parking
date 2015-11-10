<?php

require_once 'controller.php';

class Category extends Controller
{
    public function View($id)
    {
        if (!($this->id = $id) || !($this->data['category'] = $this->Category_Model->GetCategory($id)))
            redirect('main');
        $this->load->view('header');
        $this->load->view('category', $this->data);
        $this->load->view('footer');
    }
}
