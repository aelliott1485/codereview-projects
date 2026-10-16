<?php
// Source - https://codereview.stackexchange.com/q/154574
// Posted by Shaun Bebbers, modified by community. See post 'Timeline' for change history
// Retrieved 2026-10-15, License - CC BY-SA 3.0

namespace Application\Controller;

use Application\Library;

require_once(serverPath('/library/Library.php'));

class ControllerCore
{
    public $post;
    public $view;
    public $lib;
    public $sql;
    public $host;

    public function __construct()
    {
        $this->lib = new \Application\Library\Library();
        if (!isset($_SESSION['flashMessage'])) {
            $_SESSION['flashMessage'] = array();
        }
        if (empty($this->post)) {
            $this->post = array();
        }
        if (!empty($_POST)) {
            $this->setPost();
        }
        $this->view = new \stdClass();
        $this->host = host();
    }

    /**
     * Sanitizes posted data
     *
     * @param Array
     * @return  na
     * @version 0.0.3
     * @author  Linden && Shaun
     * @date    7 Oct 2016 14:54:10
     * @todo
     */
    public function setPost()
    {
        foreach ($_POST as $key => $data) {
            $this->post[$key] = is_string($data) ? trim($data) : $data;
        }
    }

    /**
     * This should empty the super global $_POST and the controller $this->post
     *
     * @param na
     * @return  array
     * @version 0.0.1
     * @author  Shaun
     * @date    16 Jun 2016 11:25:04
     * @todo
     */
    public function emptyPost()
    {
        $_POST = array();
        $this->post = $_POST;
    }

    /**
     * Clears PHP session cookies
     *
     * @param na
     * @return
     * @version 0.0.2
     * @author  Shaun
     * @date    14 Sep 2016 14:29:23
     * @todo
     */
    public function emptySession()
    {
        if (session_id() != "") {
            session_destroy();
        }
        $this->session = null;
    }

    /**
     * Sets flash messages (recommend using string for value param)
     *
     * @param string, string | int | boolean
     * @return  na
     * @version 0.0.1
     * @author  Shaun
     * @date    14 Sep 2016 09:48:53
     * @todo
     */
    public function setFlashMessage($key, $value)
    {
        $_SESSION['flashMessage'][$key] = $value;
    }

    /**
     * Checks if flash message exists
     *
     * @param string
     * @return  boolean
     * @version 0.0.1
     * @author  Shaun
     * @date    14 Sep 2016 10:18:04
     * @todo
     */
    public function getFlashMessage($key)
    {
        return isset($_SESSION['flashMessage'][$key]);
    }

    /**
     * Clears flash messages
     *
     * @param string|array
     * @return  na
     * @version 0.0.1
     * @author  Shaun
     * @date    15 Sep 2016 10:40:49
     * @todo
     */
    public function clearFlashMessage($key)
    {
        if (is_array($key)) {
            foreach ($key as $_key => $_data) {
                $_SESSION['flashMessage'][$_data] = null;
            }
        } else {
            $_SESSION['flashMessage'][$key] = null;
        }
    }
}
