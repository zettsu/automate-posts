<?php
/**
 * Created by PhpStorm.
 * User: matias
 * Date: 21/10/18
 * Time: 03:47 AM
 */



namespace App;


use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedConditions;
use Facebook\WebDriver\Remote\DesiredCapabilities;

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
        $keys = ['forum_url', 'user', 'pass', 'subject', 'post', 'ccode'];

        foreach ($keys as $key)
        {
            if(empty($this->request->{$key}) || !isset($this->request->{$key}))
            {
                return false;
            }
        }

        return true;
    }

    public function createPost($driver)
    {

        $page = $driver->get(BASE_URL . $this->request->forum_url);
        $driver->wait(5);

        $subject_input = $page->findElement(WebDriverBy::name('subject'));
        $subject_input->sendKeys($this->request->subject);

        $message_input = $page->findElement(WebDriverBy::name('message'));
        $message_input->sendKeys($this->request->post);

        $page->findElement(WebDriverBy::name('post'))->click();
    }

    public function makeLogin($page, $driver)
    {
        $name_input = $page->findElement(WebDriverBy::name('user'));
        $name_input->sendKeys($this->request->user);
        $pass_input = $page->findElement(WebDriverBy::name('passwrd'));
        $pass_input->sendKeys($this->request->pass);
        $stay_logged_minutes_input = $page->findElement(WebDriverBy::name('cookielength'));
        $stay_logged_minutes_input->sendKeys(6099);
        $stay_logged_checkbox = $page->findElement(WebDriverBy::name('cookieneverexp'));
        $stay_logged_checkbox->click();

        $page->findElement(WebDriverBy::cssSelector("input[value='Login']"))->click();
        $driver->wait(5);

        $result = count($page->findElements(WebDriverBy::id('hellomember'))) > 0;

        return $result;
    }

}