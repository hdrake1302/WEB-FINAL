<?php
class PagesController
{
    public function error()
    {

        ob_start();
        $message = "URL Not Found Or You Don't Have Access To Visit This Page";
        require_once('views/pages/error.php');
        $content = ob_get_clean();

        require_once('views/layout/template.php');
    }
}
