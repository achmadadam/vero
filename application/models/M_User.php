<?php
   defined('BASEPATH') OR exit('No direct script access allowed');

   class M_User extends CI_Model{

      public function get($id = null){
         $this->db->select('*');
         $this->db->from('user');
         if($id != null){
            $this->db->where('id', $id);
         }
         $query = $this->db->get();
         return $query;
      }

      public function get_spl($id = null){
         $this->db->select('*');
         $this->db->from('input_spl');
         if($id != null){
            $this->db->where('status_id', $id);
         }
         $query = $this->db->get();
         return $query;
      }

      public function getTotalRecordSPL($status_id = null, $user_id = null){
         $this->db->select('count(status_id) as total_kolom');
         $this->db->from('input_spl');
         if($status_id != null){
            $this->db->where('status_id', $status_id);
         }
         if($user_id != null){
            $this->db->where('user_id', $user_id);
         }
         $query = $this->db->get();
         return $query;
      }

      public function getNotifications($user_id) {
         $this->db->select('*');
         $this->db->from('notifications');
         $this->db->join('input_spl', 'input_spl.id_input = notifications.input_spl_id');
         $this->db->join('status', 'status.status_id = input_spl.status_id');
         $this->db->where('notifications.user_id', $user_id);
         $this->db->where('notifications.status_id', 0);
         $this->db->order_by('notifications.created_at', 'DESC');
         $this->db->limit(5);
         $query = $this->db->get();
         return $query;
      }

      public function setReadNotifications($id){
         $data = [
            "status_id" => 1,
         ];
         $this->db->where("user_id", $id);
         $this->db->update("notifications", $data);
      }
   }