<?php
class CreateQuestionException extends \Exception {
    protected $message = 'There was an error attempting the question';
    protected $code = 400;
}