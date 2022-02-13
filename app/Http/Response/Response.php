<?php

namespace App\Http\Response;

class Response
{
    public $success;
    public $message;
    public $data;

    public function __construct(bool $success, string $message, array $data= [])
    {
        $this->success = $success;
        $this->message = $message;
        $this->data = $data;
    }

}
