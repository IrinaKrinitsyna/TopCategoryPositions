<?php

class MainController {
    
    protected $data;

    protected $viewFile;
    
	public function __construct() {

        $this->constructorBody();
	}

    function constructorBody($header = null) {

        global $m;//, $f3;

        if($header == null) $m->data['header'] = 'json';
        else $m->data['header'] = 'js';
    }
}

