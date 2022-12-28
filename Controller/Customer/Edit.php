<?php
namespace InvigorateSystems\ContactBook\Controller\Customer;
use InvigorateSystems\ContactBook\Helper\Data;

class Edit extends \Magento\Framework\App\Action\Action
{
     protected $_pageFactory;
     protected $_request;
     protected $_coreRegistry;

     public function __construct(
          \Magento\Framework\App\Action\Context $context,
          \Magento\Framework\View\Result\PageFactory $pageFactory,
          Data $helperData,
          \Magento\Framework\App\Request\Http $request,
          \Magento\Framework\Registry $coreRegistry
          )
     {
          $this->_pageFactory = $pageFactory;
          $this->_request = $request;
          $this->helperData = $helperData;
          $this->_coreRegistry = $coreRegistry;
          return parent::__construct($context);
     }

    public function execute()
    {
          if($this->helperData->isLoggedIn()){
               return $this->_pageFactory->create();
          } else {
               $this->messageManager->addError(__("Please Login"));
               return $this->_redirect('customer/account/login');
          }
    }

}
