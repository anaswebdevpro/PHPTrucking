<?php

class Controller {

    public function view($viewName, $data = []) {
        extract($data);
        require_once "../app/views/{$viewName}.php";
    }
}