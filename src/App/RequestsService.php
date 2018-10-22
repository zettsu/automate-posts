<?php
/**
 * Created by PhpStorm.
 * User: matias
 * Date: 21/10/18
 * Time: 03:47 AM
 */


namespace App;

class RequestsService
{

    private $request;

    public function __construct()
    {

    }

    public function isPost()
    {
        $body = file_get_contents('php://input');

        if(!empty($_POST))
        {
            $this->request = json_decode($_POST);
            return true;
        }

        if(!empty($body))
        {

            $this->request = json_decode($body);
            return true;
        }

        return false;
    }

    public function isGet()
    {
        if(!empty($_GET))
        {
            $this->request = (object) $_GET;
            return true;
        }

        return false;
    }

    public function processPost()
    {

    }

    public function processGet()
    {

    }

    public function getRequestData()
    {
        return $this->request;
    }

    public function isValid()
    {
        return true;

        $keys = ['forum_url', 'user', 'pass', 'subject', 'post'];

        foreach ($keys as $key)
        {
            if(empty($this->request->{$key}) || !isset($this->request->{$key}))
            {
                return false;
            }
        }

        return true;
    }

}