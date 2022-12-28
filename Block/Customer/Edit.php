<?php
namespace InvigorateSystems\ContactBook\Block\Customer;


class Edit extends \Magento\Framework\View\Element\Template
{

     // protected $_pageFactory;
     // protected $_coreRegistry;
     protected $customerSession;
     protected $ContactLoader;
     protected $_request;
     protected $response;


     public function __construct(
          \Magento\Framework\View\Element\Template\Context $context,
          \Magento\Customer\Model\Session $customerSession,
          \Magento\Framework\App\Request\Http $request,
          \Magento\Framework\App\Response\Http $response,
          \InvigorateSystems\ContactBook\Model\Contact $ContactLoader,
          array $data = []
          )
     {
          $this->_ContactLoader = $ContactLoader;
          $this->customerSession = $customerSession;
          $this->response = $response;
          $this->_request = $request;
          return parent::__construct($context,$data);
     }

     public function execute()
     {
          return $this->customerSession->getCustomer()->getId();
     }
     public function getContactIds(){
          return $this->_request->getParam("id");    
     }

     public function getEditRecord()
     {
          $id = $this->_request->getParam("id");
          $cid = $this->_request->getParam("cid");
          $collection = $this->_ContactLoader->load($id);
          if($collection->getCustomerId()==$cid && $collection->getContactId() == $id ) {
               return $collection;
          } else{
               $this->response->setRedirect($this->getUrl('contactbook/customer/index'));
          }
     }

}
