<?php
include_once FRW_COMPONENTS . 'Component.php';

class NotificationComponent extends Component {

    public $message = '';

    public function initiate(array $config = array())
    {
        parent::initiate($config);
    }

    public function beforeAction()
    {
    }

    public function afterAction($view)
    {
        if(empty($_SESSION['notifications'])) return;
        $output = '';
        foreach ($_SESSION['notifications'] as $notification) {
            ob_start();
            $this->message = $notification[1];
            include APP_TEMPLATES . 'Notifications/'.$notification[0].'.php';
            $output .= ob_get_clean();
        }

        $view->write('notification', $output);
        unset($_SESSION['notifications']);
    }

    public function success($content) {
        $this->custom('success', $content);
    }

    public function error($content) {
        $this->custom('error', $content);
    }

    public function info($content) {
        $this->custom('info', $content);
    }

    public function custom($template, $content) {
        if(empty($_SESSION['notifications'])) {
            $_SESSION['notifications'] = array(array($template, $content));
        } else {
            array_push($_SESSION['notifications'], array($template, $content));
        }
    }

}