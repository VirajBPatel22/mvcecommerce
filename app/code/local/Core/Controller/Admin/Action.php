<?php
class Core_Controller_Admin_Action extends Core_Controller_Front_Action{
    protected $_allowedActions =[];
    public function __construct()
    {
        $this->_init();
    }
    protected function _init(){
        $isLogin = $this->getSession()
        ->get('login');
        if(!in_array($this->getRequest()->getActionName(),$this->_allowedActions) ){
            if(is_null($this->getSession()->get('login'))){
                $this->redirect("admin/account/login");
            }

            if($isLogin === 1){
    
            }
            else{
                $this->redirect("admin/account/login");
            }
        }
        
    }
}

?>