<?php

class Category_Model extends CI_Model
{    
    private function categories($id, &$data)
    {
        $result = $this->db->get_where('categories', array('parent_id' => $id))->result_array();
        for ($i = 0; $i < sizeof($result); $i++) {
            $data[$result[$i]['id']] = $result[$i];
            $this->categories($result[$i]['id'], $data[$result[$i]['id']]);
            unset($data[$result[$i]['id']]['id'], $data[$result[$i]['id']]['parent_id']);
        }
        return $data;
    }
    
    public function GetAllCategories()
    {
        $data = null;
        return $this->categories(0, $data);
    }
    
    public function GetCategory($id)
    {
        return $this->db->query('SELECT * FROM categories WHERE id = '.$id)->row();
    }
}
