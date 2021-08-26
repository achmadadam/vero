<?php
   class Fungsi {

      protected $ci;

      function __construct(){
         $this->ci =& get_instance();
      }

      function user_login(){
         $this->ci->load->model('M_user');
         $user_id = $this->ci->session->userdata('id');
         $user_data = $this->ci->M_user->get($user_id)->row();

         return $user_data;
      }

   }