<?php
// Source - https://codereview.stackexchange.com/q/154574
// Posted by Shaun Bebbers, modified by community. See post 'Timeline' for change history
// Retrieved 2026-10-15, License - CC BY-SA 3.0

namespace Application\Core\Framework;

require_once(serverPath('/core/HtmlBuilder.php'));

## filepath ../application/core
class Core extends \Application\Core\Framework\HtmlBuilder
{
    public $segment;
    public $host;
    public $allowedSegments = ['home'];
    public $pageController = ['home' => "HomeController"];
    public $partial;
    public $controller;
    public $title;
    public $description;
    public $serverPath;
    public $root;
    public $flash;
    public $filePath;
    public $uriPath;
    public $http;
    private $errorReporting = [
        'http://framework.php.local',
        'https://framework.php.local'
    ];
    private $allowedFileExts = [
        'htm',
        'html',
        'asp',
        'aspx',
        'js',
        'php',
        'phtml',
    ];
    public $canonical = '';

    public function __construct()
    {
        parent::__construct();
        $this->host = 'http' . (isHttps() ? 's' : '') . '://' . host();
        if (in_array($this->host, $this->errorReporting)) {
            error_reporting(-1);
            ini_set('display_errors', '1');
        }
        $this->uriPath = '';
        $page = array_filter(explode('/', $_SERVER['REQUEST_URI']), 'strlen');
        if (count($page) > 1) {
            foreach ($page as $key => $data) {
                if ($key != count($page)) {
                    $this->uriPath .= "{$data}/";
                }
            }
        }
        $this->segment = !empty($page) ? strtolower($page[count($page)]) : "";

        if (!empty($_GET)) {
            $pieces = explode('?', $this->segment);
            $this->segment = $pieces[0];
            if (isset($pieces[1]) && strlen($pieces[1]) > 0) {
                $_GET = array();
                $get = explode("&", $pieces[1]);
                foreach ($get as $data) {
                    $_data = explode("=", $data);
                    $_GET[$_data[0]] = urldecode($_data[1]);
                }
            }
        }

        if (strpos($this->segment, ".") > 0) {
            $pieces = explode(".", $this->segment);
            if (in_array($pieces[count($pieces) - 1], $this->allowedFileExts)) {
                $this->segment = $pieces[count($pieces) - 2];
                $this->canonical = "<link rel=\"canonical\" href=\"{$this->host}/{$this->segment}\">" . PHP_EOL;
            }
        }
        $this->serverPath = serverPath();

        $this->root = str_replace("\\", "/", $_SERVER['DOCUMENT_ROOT']);
        $this->controller = new \stdClass();
        $this->flash = new \stdClass();
        $this->partial = [
            'header' => serverPath("/view/partial/header.phtml"),
            'footer' => serverPath("/view/partial/footer.phtml"),
        ];
    }

    /**
     * Sets the meta page titles in the views
     *
     * @param string
     * @return  string
     * @version 0.0.2
     * @author  sbebbington
     * @date    2 Feb 2017 - 13:04:10
     * @todo
     */
    public function setTitle(string $page = '')
    {
        $titles = [
            'home' => 'Example FrameWork.php skeleton site',
        ];
        return $titles["{$page}"];
    }

    /**
     * Sets the meta page descriptions in the views
     *
     * @param string
     * @return  string
     * @version 0.0.1
     * @author  sbebbington
     * @date    2 Feb 2017 - 13:04:47
     * @todo
     */
    public function setDescription(string $page = '')
    {
        $descriptions = [
            'home' => 'The Skeleton',
        ];
        return $descriptions["{$page}"];
    }

    /**
     * Bug fixed edition of the using ZF type view variables
     *
     * @param
     * @return
     * @version 0.0.3a
     * @author  sbebbington
     * @date    2 Feb 2017 - 13:05:41
     * @todo
     */
    public function setView($instance, string $masterKey = '')
    {
        foreach ($instance as $key => $data) {
            if ($masterKey === '') {
                $this->$key = $data;
            } else {
                $this->$masterKey->$key = $data;
            }
        }
    }

    /**
     * This will load the view and related controllers
     * It has an added exception for Jamie's admin html
     * template. This version should now allow Zend-alike
     * view variables - so if you set an object in a page
     * controller as $this->view->objName, you can use
     * $this->objName in the PHP/HTML view or something.
     *
     * @param na
     * @return  void
     * @version 0.0.3
     * @author  sbebbington
     * @date    6 Feb 2017 - 11:15:14
     * @todo
     */
    public function loadPage()
    {
        if ($this->segment == "") {
            $this->segment = 'home';
        }

        if (in_array($this->segment, $this->allowedSegments) == false || !file_exists(
        serverPath("/view/{$this->uriPath}{$this->segment}.phtml")
        )) {
            $this->setView(array("_404Error" => 1));
            $this->title = '404 error - page not found, please try again';
            $this->description = 'There\'s a Skeleton in the Sandbox';
            require_once(serverPath("/view/404.phtml"));
            exit;
        }

        if (in_array($this->segment, $this->allowedSegments) == true) {
            $this->title = $this->setTitle($this->segment);
            $this->description = $this->setDescription($this->segment);
            foreach ($this->pageController as $instance => $controller) {
                if ($this->segment == $instance) {
                    require_once(serverPath("/controller/{$controller}.php"));
                    $this->controller->$instance = new $controller();
                    if (isset($this->controller->$instance->view)) {
                        $this->setView($this->controller->$instance->view);
                        $this->controller->$instance->view = null;
                    }
                }
            }

            if (isset($_SESSION['flashMessage']) && !empty($_SESSION['flashMessage'])) {
                $this->setView($_SESSION['flashMessage'], "flash");
            }
            require_once(serverPath("/view/{$this->uriPath}{$this->segment}.phtml"));
        }
    }
}
