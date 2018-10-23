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
define('LOGIN_PAGE', "index.php?action=login;ccode=");
define('EXEC_PATH', 'index.php?action=post;board=33.0');
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
        $params = $service->getRequestData();

        if($service->isValid())
        {
            $host = 'http://localhost:4444/wd/hub'; // this is the default
            $driver = RemoteWebDriver::create($host, DesiredCapabilities::chrome());
            $page = $driver->get(BASE_URL . LOGIN_PAGE . $params->ccode);

            if(count($page->findElements(WebDriverBy::id('hellomember'))) < 1)
            {
                $login = $service->makeLogin($page, $driver);

                if(!$login)
                {
                    http_response_code(500);
                    echo json_encode(array('error' => 'Error making login, please check provided credentials.'));
                }
            }

            $service->createPost($driver);
            $page->close();
        }else{
            http_response_code(500);
            echo json_encode(array('error'=>'Params missing'));
        }

    }


