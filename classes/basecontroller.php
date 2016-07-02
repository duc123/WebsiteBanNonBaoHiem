<?php

/**
 * Description of basecontroller
 *
 * @author duc
 */
abstract class BaseController {
    protected $urlvalues;
    protected $action;
    
    public function __construct($action,$urlvalues) {
        $this->action = $action;
        $this->urlvalues = $urlvalues;
    }
    
    public function executeAction(){
        return $this->{$this->action}();
    }
    
}
