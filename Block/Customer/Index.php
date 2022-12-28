<?php
namespace InvigorateSystems\ContactBook\Block\Customer;

    use Magento\Framework\App\RequestInterface;
    use \InvigorateSystems\ContactBook\Model\Contact;

class Index extends \Magento\Framework\View\Element\Template
{
    protected $customCollectionsModelFactory;
    protected $request;
    protected $customerSession;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        Contact $customCollectionsModelFactory,
        RequestInterface $request,
        \Magento\Customer\Model\Session $customerSession,
        array $data = []
    ) {
        $this->customerSession = $customerSession;
        $this->_customCollectionsModelFactory = $customCollectionsModelFactory;
        $this->_request = $request;
        parent::__construct($context, $data);
    }
    public function tesTing(){
        exit("hello");
    }
    public function getCustomerSessionId(){
        return $this->customerSession->getCustomer()->getId();
    }
    public function getEmptyContactsMessage(){
        return __('You have placed no Contact.');
    }
    public function getCustomCollection()
    {
        
        $collection = $this->_customCollectionsModelFactory->getCollection();
        $collection->addFieldToFilter("customer_id", $this->getCustomerSessionId());
        $collection->load();
        return $collection;
    }
}
