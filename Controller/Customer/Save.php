<?php
namespace InvigorateSystems\ContactBook\Controller\Customer;
use InvigorateSystems\ContactBook\Helper\Data;
use Magento\Framework\App\Filesystem\DirectoryList;

class Save extends \Magento\Framework\App\Action\Action
{
     protected $_pageFactory;
     protected $_ContactFactory;
     protected $_filesystem;
     protected $customerSession;

     public function __construct(
          \Magento\Framework\App\Action\Context $context,
          \Magento\Framework\View\Result\PageFactory $pageFactory,
          \InvigorateSystems\ContactBook\Model\Contact $ContactFactory,
          Data $helperData,
          \Magento\Customer\Model\Session $customerSession,
          \Magento\Framework\Filesystem $filesystem

          )
     {
          $this->_pageFactory = $pageFactory;
          $this->customerSession = $customerSession;
          $this->_ContactFactory = $ContactFactory;
          $this->helperData = $helperData;
          $this->_filesystem = $filesystem;
          return parent::__construct($context);
     }
     public function getCustomerSessionId(){
          return $this->customerSession->getCustomer()->getId();
     }

     public function execute()
     {
          if($this->helperData->isLoggedIn()){
               if ($this->getRequest()->isPost()) {
                    $input = $this->getRequest()->getPostValue();
                    if($input['submit'] == "Save"){
                         $collection = $this->_ContactFactory->load($input['contact_id']);
                         if($collection->getCustomerId()==$input['customer_id'] && $this->getCustomerSessionId() == $input['customer_id']){
                              $this->_ContactFactory->load($input['contact_id']);
                              $this->_ContactFactory->addData($input);
                              $this->_ContactFactory->setId($input['contact_id']);
                              $this->_ContactFactory->save();
                         } else {
                              $this->messageManager->addError(__("Invaild Records"));
                              return $this->_redirect('contactbook/customer/index');
                         }

                    } else {
                         $this->_ContactFactory->setData($input)->save();
                    }
                    $this->messageManager->addSuccess(__('Save Contact.'));
                    return $this->_redirect('contactbook/customer/index');
               } else { 
                    $this->messageManager->addError(__("Invaild"));
                    return $this->_redirect('contactbook/customer/index');
               }
          } else {
               $this->messageManager->addError(__("Please Login"));
               return $this->_redirect('customer/account/login');
          }
     }
}

