<?php
namespace InvigorateSystems\ContactBook\Controller\Customer;
use InvigorateSystems\ContactBook\Helper\Data;

class Delete extends \Magento\Framework\App\Action\Action
{
    protected $_pageFactory;
    protected $_request;
    protected $_ContactFactory;
    protected $customerSession;

    public function __construct(
          \Magento\Framework\App\Action\Context $context,
          \Magento\Framework\View\Result\PageFactory $pageFactory,
          \Magento\Framework\App\Request\Http $request,
          Data $helperData,
          \InvigorateSystems\ContactBook\Model\Contact $ContactFactory,
          \Magento\Customer\Model\Session $customerSession
          )
    {
        $this->_pageFactory = $pageFactory;
        $this->_request = $request;
        $this->helperData = $helperData;
        $this->customerSession = $customerSession;
        $this->_ContactFactory = $ContactFactory;
        return parent::__construct($context);
    }

    public function getCustomerSessionId(){
          return $this->customerSession->getCustomer()->getId();
    }

    public function execute()
    {
        if($this->helperData->isLoggedIn()){
            $id = $this->_request->getParam('id');
            $cid = $this->_request->getParam('cid');
            $collection = $this->_ContactFactory->load($id);
            if($this->getCustomerSessionId() == $cid){

                if($collection->getCustomerId()==$cid && $collection->getContactId() == $id ) 
                {                
                    $result = $this->_ContactFactory->setId($id);
                    $result = $result->delete();
                    $this->messageManager->addSuccess(__('Delete Contact.'));
                    return $this->_redirect('contactbook/customer/index');
                } else{
                    $this->messageManager->addError(__("Invaild Record"));
                    return $this->_redirect('contactbook/customer/index'); 
                }
            } else{
                $this->messageManager->addError(__("Invaild Record"));
                return $this->_redirect('contactbook/customer/index'); 
            }
        } else {
               $this->messageManager->addError(__("Please Login"));
               return $this->_redirect('customer/account/login');
          }
    }
}
