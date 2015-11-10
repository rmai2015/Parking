<?php

class Controller extends CI_Controller
{
    private function display($data) {
        $return = '<ul>';
        foreach ($data as $key => $value) 
            if (is_numeric($key))
                $return .= '<li><a href="'.base_url().'category/view/'.$key.'">'.$data[$key]['name'].'</a></li>'.$this->display($data[$key]);
        return $return.'</ul>';
    }

    public function __construct() {
        parent::__construct();
        $this->load->model('Category_Model');
        $box['left'] = array(
                        'category' => array(
                                        'title' => 'Categories', 
                                        'content' => $this->display($this->Category_Model->GetAllCategories()), 
                                        'footer' => '')); 
        $box['right'] = array(
                        'cart' => array(
                                        'title' => 'Cart', 
                                        'content' => 'Empty', 
                                        'footer' => 'foot'),
                        'info' => array(
                                        'title' => 'Information', 
                                        'content' => 'Test', 
                                        'footer' => 'foot'));
        foreach ($box as $key => $v) {
            $this->boxes[$key] = null;
            foreach ($v as $key3 => $value) {
                $content = file_get_contents('application/views/box.php');
                foreach (array( 'id' => $key3,
                                'title' => $value['title'], 
                                'content' => $value['content'], 
                                'footer' => $value['footer']) as $key2 => $value2)
                    $content = str_replace('{'.$key2.'}', $value2, $content);
                $this->boxes[$key] .= $content;
            }
        }
    }
}
