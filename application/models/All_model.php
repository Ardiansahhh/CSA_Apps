<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class All_model extends CI_Model {
        public function get($data, $table) {
                   $this->db->where($data);
          $query = $this->db->get($table);
          if($query != NULL) {
                  return $query->row();
          } else {
                  return false;
          }
        }

        public function get_result($data, $table) {
                $this->db->where($data);
       $query = $this->db->get($table);
       if($query != NULL) {
               return $query->result();
       } else {
               return false;
       }
     }

        public function in($data, $table) {
                $this->db->insert($table, $data);
        }

        public function get_all($table){
            return $this->db->get($table)->result();
        }

        public function edit($data, $table, $id) {
                $this->db->where($id);
                $this->db->update($table, $data);
        }

        public function delt($data, $table) {
                // DELETE FROM nama_table WHERE attribute = $params
                $this->db->where($data);
                $this->db->delete($table);
        }
}