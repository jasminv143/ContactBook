<?php
namespace InvigorateSystems\ContactBook\Controller\Adminhtml\Create;

use Magento\Framework\App\Filesystem\DirectoryList;

class Save extends \Magento\Framework\App\Action\Action
{
     protected $_pageFactory;
     protected $_ContactFactory;
     protected $_filesystem;

     public function __construct(
          \Magento\Framework\App\Action\Context $context,
          \Magento\Framework\View\Result\PageFactory $pageFactory,
          \Magento\Framework\App\Request\Http $request,
          \InvigorateSystems\ContactBook\Model\Contact $ContactFactory,
          \Magento\Framework\Filesystem $filesystem
          )
     {
          $this->_pageFactory = $pageFactory;
          $this->_ContactFactory = $ContactFactory;
          $this->_filesystem = $filesystem;
          $this->_request = $request;
          return parent::__construct($context);
     }

     public function execute()
     {
          $returnToEdit = (bool)$this->getRequest()->getParam('back', false);          
          if ($this->getRequest()->isPost()) {
               $input = $this->getRequest()->getPostValue();
               if(isset($input['contact']["contact_id"])){
                    $this->_ContactFactory->load($input['contact']['contact_id']);
                    $this->_ContactFactory->addData($input['contact']);
                    $this->_ContactFactory->setId($input["contact"]['contact_id']);
                    $this->_ContactFactory->save();
                    $this->messageManager->addSuccess(__(' Record Updated.', ));
               }else{
                    $this->messageManager->addSuccess(__(' New Record Insert.',));
                    $this->_ContactFactory->setData($input["contact"])->save();
               }
               if($returnToEdit){
                    if(isset($input['contact']["edit"])){
                         return $this->_redirect('contactbook/create/insert',['id'=>$input['contact']["contact_id"],"edit"=>"cus", "cus"=>$input['contact']["cid"]]);
                    }
                    elseif (isset($input['contact']["contact_id"])) {
                         return $this->_redirect('contactbook/create/insert',["id"=>$input['contact']["contact_id"]]);
                    }
                    return $this->_redirect('contactbook/create/insert');
               } else {
                    if(isset($input['contact']["edit"])){
                         return $this->_redirect('customer/index/edit',['id'=>$input['contact']["cid"]]);
                    }
                    return $this->_redirect('contactbook/create/index');
               }
          }
     }
}