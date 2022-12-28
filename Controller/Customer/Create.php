<?php
namespace InvigorateSystems\ContactBook\Controller\Customer;
use InvigorateSystems\ContactBook\Helper\Data;

class Create extends \Magento\Framework\App\Action\Action
{
     protected $_pageFactory;
     protected $helperData;

     public function __construct(
          \Magento\Framework\App\Action\Context $context,
          Data $helperData,
          \Magento\Framework\View\Result\PageFactory $pageFactory
          )
     {
          $this->_pageFactory = $pageFactory;
          $this->helperData = $helperData;
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