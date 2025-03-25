<?php
class Admin_Controller_Account extends Core_Controller_Admin_Action
{
    protected $_allowedActions = [
        'login',
        'loginPost'
    ];
    public function loginAction()
    {
        
        $layout = $this->getLayout();
        $view = $layout->createBlock('Admin/Account_Login')
            ->setTemplate('admin/account/login.phtml');
            $layout->getChild('content')
                ->addchild('login', $view);
            $layout->toHtml();
    }
    public function loginPostAction()
    {
        $session = Mage::getSingleton('core/session');
        $params = $this->getRequest()->getParams('login');
        $adminmodel = Mage::getModel('admin/user')
            ->getCollection()
            ->addFieldToFilter('username', ["=" => $params['login']['user']]);
        $data = $adminmodel->getData();
        if (!empty($data)) {
            if ($params['login']['user'] == $data[0]->getUsername() && $params['login']['password'] == $data[0]->getPasswordHash()) {
                $session->set('login', 1);
                header("Location: http://localhost/ecommerecemvc/admin/dashboard/list");
            } else {
                $session->remove('login');
                header("Location: http://localhost/ecommerecemvc/admin/account/login");
            }
        } else {
            $session->remove('login');
            header("Location: http://localhost/ecommerecemvc/admin/account/login");
        }
    }
    public function logoutAction()
    {
        Mage::getSingleton('core/session')
            ->remove('login');
        header("Location: http://localhost/ecommerecemvc/admin/account/login");

    }
}
