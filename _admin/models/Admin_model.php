<?php
class Admin_model extends CI_Model{

    public function __construct(){                
        parent::__construct();  
        $this->_default(); 
        $this->userLogIn(); 
    } 

// Default          
    function _default(){   
        // Przekazywanie tablicy adresu dla smarty
        $this->smarty->assign("uri", $this->uri->segment_array());
        // Definiowanie nowej lini błedu 
        $this->form_validation->set_error_delimiters("<p>","</p>"); 
    }          
    
// Przekazywanie danych zalogowanego użytkownika
    function userLogIn(){
        if($this->ion_auth->logged_in()){     
            $_avatar = templates_url("assets/img/user.png"); 
            $_user = $this->ion_auth->user()->row();
            if($_user->avatar) $_avatar = base_url("../uploads/avatar/{$_user->avatar}");
            $_group = FC_DB::getWhereJoinOrder('users_permissions', 'users_groups', 'up_group_id = ug_id', array('up_user_id'=>$_user->id), "`up_group_id` DESC");   
            $userLogIn = array(                   
                'first_name' => $_user->first_name,
                'last_name'  => $_user->last_name,
                'avatar'     => $_avatar,
                'high'       => $_group["ug_description"]   
            );              
            $this->smarty->assigns("userLogIn", $userLogIn);
        } 
    }
    
}