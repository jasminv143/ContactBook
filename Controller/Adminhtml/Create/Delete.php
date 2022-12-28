<?php
namespace InvigorateSystems\ContactBook\Controller\Adminhtml\Create;

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
          \InvigorateSystems\ContactBook\Model\Contact $ContactFactory,
          \Magento\Customer\Model\Session $customerSession
          )
    {
        $this->_pageFactory = $pageFactory;
        $this->_request = $request;
        $this->customerSession = $customerSession;
        $this->_ContactFactory = $ContactFactory;
        return parent::__construct($context);
    }

    public function getCustomerSessionId(){
          return $this->customerSession->getCustomer()->getId();
    }

    public function execute()
    {   
        
        $id = $this->_request->getParam('id');
        $cid = $this->_request->getParam('cus');
        $delete = $this->_request->getParam('delete');

        $collection = $this->_ContactFactory->load($id);
        if($collection){
            $result = $this->_ContactFactory->setId($id);
            $result = $result->delete();
        } else {
            $this->messageManager->addError(__("Invaild Record"));
            return $this->_redirect('contactbook/create/index'); 
        }
        $this->messageManager->addSuccess(__(' Record Delete.', ));
        if($delete == "cus"){
            return $this->_redirect('customer/index/edit', ['id'=>$cid]);     
        }
        return $this->_redirect('contactbook/create/index'); 
        
    }
}
