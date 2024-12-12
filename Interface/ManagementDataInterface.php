<?php
namespace Pbl\Interface;
    interface ManagementDataInterface {
        public function add();
        public function getAll();
        public function getOne($id);
        public function update($id);
        public function delete($id);
    }
?>