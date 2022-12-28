<?php

namespace InvigorateSystems\ContactBook\Controller\Adminhtml\Create;
use Magento\Framework\Controller\ResultFactory;
class Insert extends \Magento\Framework\App\Action\Action
{
	/** @var \Magento\Framework\View\Result\PageFactory  */

	protected $resultPageFactory;
	protected $_request;
    protected $_ContactFactory;
    protected $coreRegistry;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $resultPageFactory,
		\Magento\Framework\App\Request\Http $request,
		\Magento\Framework\Registry $coreRegistry,
      	\InvigorateSystems\ContactBook\Model\Contact $ContactFactory
	) {
		$this->resultPageFactory = $resultPageFactory;
		$this->_request = $request;
		 $this->coreRegistry = $coreRegistry;
        $this->_ContactFactory = $ContactFactory;
		parent::__construct($context);
	}

	/**
	* Load the page defined in view/adminhtml/layout/samplenewpage_sampleform_index.xml
	*
	* @return \Magento\Framework\View\Result\Page
	*/

	public function execute()
	{
		$id = $this->_request->getParam('id');
		if($id){
			$row_data = $this->_ContactFactory->load($id);
			if(!$row_data->getContactId()){
				$this->messageManager->addError(__('Invalid Record.'));	
				$this->_redirect('contactbook/create/index');
                return;		
			}
			$this->coreRegistry->register('row_data', $row_data); // madti nthi kayay
		}
	 	$title = $id ? __('Edit Contact Record '): __('Add New Contact');
	 	$resultPage = $this->resultPageFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend($title);

		// print_r($resultPage);
			// exit("edit");
		return $this->resultPageFactory->create();
	}
}