<?php
/**
 * Created by PhpStorm.
 * User: matias
 * Date: 21/10/18
 * Time: 03:54 AM
 */
require __DIR__ . '/vendor/autoload.php';

define('BASE_URL', 'https://bitcointalk.org/');
define('CCODE', '01624f2a12deacf34ed8');
define('LOGIN_PAGE', "index.php?action=login;ccode=" . CCODE);
define('EXEC_PATH', 'community/index.php?board=7.0');
//https://bitcointalk.org/index.php?board=1.0

//data example

/*
 *
 * {
        "forum_url":"https://www.simplemachines.org/community/index.php?board=7.0",
        "user":"username",
        "pass":"password",
        "post":"xxxxxx"
    }
 *
 *
 */

///

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedConditions;
use Facebook\WebDriver\Remote\DesiredCapabilities;

use App\RequestsService;


    $service = new RequestsService();

    if($service->isPost())
    {
        $service->getRequestData();

        if($service->isValid())
        {
            $host = 'http://localhost:4444/wd/hub'; // this is the default
            $driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());
            $page = $driver->get(BASE_URL . LOGIN_PAGE);

            if(count($page->findElements(WebDriverBy::id('hellomember'))) > 0)
            {
                echo 'logged';
            }else{
                $name_input = $page->findElement(WebDriverBy::name('user'));
                $name_input->sendKeys("jmatias.olivera@gmail.com");
                $pass_input = $page->findElement(WebDriverBy::name('passwrd'));
                $pass_input->sendKeys("Sakura23!");
                $stay_logged_minutes_input = $page->findElement(WebDriverBy::name('cookielength'));
                $stay_logged_minutes_input->sendKeys(6099);
                $stay_logged_checkbox = $page->findElement(WebDriverBy::name('cookieneverexp'));
                $stay_logged_checkbox->click();

                //$driver->getKeyboard()->pressKey('ENTER');
                $page->findElement(WebDriverBy::cssSelector("input[value='Login']"))->click();
                $driver->wait(5);

                //echo(count($page->findElements(WebDriverBy::id('hellomember'))) > 0);
            }
            //$page2 = $driver->getPageSource();
            //print_r($page2);
        //echo(count($driver->findElement(WebDriverBy::id('hellomember'))) > 0);
            //$captcha_token = $page->findElement(WebDriverBy::id('recaptcha-token'));
            //print_r($captcha_token);
            //$page->close();
            //die();
        }else{
            echo json_encode(array('error'=>'params missing'));
        }

    }


