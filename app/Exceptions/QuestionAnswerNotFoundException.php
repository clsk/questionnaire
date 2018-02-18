<?php
class QuestionAnswerNotFoundException extends \Exception {
    protected $message = 'Answer not found, Make sure you are choosing an answer that exists in the database';
    protected $code = 404;
}
