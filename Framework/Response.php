<?php

namespace Framework;

class Response {

    public function __construct(
        private string $content = '',
        private int $status = 200
    ){}

    public function setContent(String $content){
        $this->content = $content;
    }

    public function send (){
        echo $this->content;
    }
}