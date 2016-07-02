<?php

/**
 * Description of error
 *
 * @author duc
 */
class ErrorController extends BaseController {

    public function __construct($action, $urlvalues) {
        parent::__construct($action, $urlvalues);
    }

    protected function badurl() {
        include 'views/Error/badurl.php';
    }

}
