<?php
namespace Pbl\Interface;
    interface UserControllerInterface {
        public function addUser();
        public function getAll();
        public function edit($id);
        public function getOne($id);
        public function update($id);
        public function delete($id);
    }
?>