<?php
namespace InvigorateSystems\ContactBook\Block\Customer;
class Create extends \Magento\Framework\View\Element\Template
{
     protected $_pageFactory;
     protected $customerSession;
     public function __construct(
          \Magento\Framework\View\Element\Template\Context $context,
          \Magento\Framework\View\Result\PageFactory $pageFactory,
          \Magento\Customer\Model\Session $customerSession,
          array $data = []
          )
     {
          $this->customerSession = $customerSession;
          $this->_pageFactory = $pageFactory;
          return parent::__construct($context,$data);
     }
     public function execute()
     {
          return $this->customerSession->getCustomer()->getId();
     }
}