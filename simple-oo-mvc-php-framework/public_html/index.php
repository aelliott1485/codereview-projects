<?php
// Source - https://codereview.stackexchange.com/q/154574
// Posted by Shaun Bebbers, modified by community. See post 'Timeline' for change history
// Retrieved 2026-10-15, License - CC BY-SA 3.0

use Application\Core\Framework\Core;

require_once(serverPath('/core/FrameworkCore.php'));
require_once(serverPath('/core/GlobalHelpers.php'));

header('X-Content-Type-Options: nosniff');
header('X-XSS-Protection: 1');
header('Strict-Transport-Security: max-age=31536000; includeSubDomains');
session_set_cookie_params(0, '/', getDomain(host(), ($https = isHttps())), $https, true);
if (session_id() == "") {
    session_start();
}

class Index
{
    protected $core;
    public $timeZone = "Europe/London";

    /**
     * This will initiate the core to load the view
     * according to the uri path, one may also
     * change the default timezone for the project
     * by altering the public $timeZone string above
     * for a list of valid timezones, see:
     * http://php.net/manual/en/timezones.php
     *
     * @param na
     * @return
     * @version 0.0.2
     * @author  sbebbington
     * @date    24 Jan 2017 - 09:49:15
     * @todo
     */
    public function __construct()
    {
        $this->core = new Core();
        setTimeZone($this->timeZone);
        $this->core->loadPage();
    }
}

/**
 * This will correctly route to the application
 * directory on your server
 *
 * @param string
 * @return  string
 * @version 0.0.2
 * @author  Shaun
 * @date    2 Feb 2017 - 13:01:13
 * @todo
 */
function serverPath(string $routeTo = '')
{
    $_x = str_replace("\\", "/", dirname(__FILE__)) . '/application';
    $_x = str_replace("public_html/", "", $_x);
    $_x .= $routeTo;
    return str_replace("//", "/", $_x);
}

// Creates new instance and therefore initiates the controllers, models and views etc...
$page = new Index();
