<?php
/**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */

namespace InvigorateSystems\ContactBook\Model;
use InvigorateSystems\ContactBook\Model\ResourceModel\Contact\CollectionFactory;
/**
 * 
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var array
     */
  protected $_request;
   public function __construct(
        \InvigorateSystems\ContactBook\Model\ResourceModel\Contact\CollectionFactory $mycollectionFactory,
        \Magento\Framework\App\Request\Http $request,
        $name,
        $primaryFieldName,
        $requestFieldName,
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $data);
        $this->collection = $mycollectionFactory->create();
        $this->_request = $request;
    }
    // @codingStandardsIgnoreEnd
    public function getData()
    {
        
      $id = $this->_request->getParam("id");
      $edit = $this->_request->getParam("edit");
      $cid = $this->_request->getParam("cus");
      if($id){
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $blog) {
            $this->loadedData[$blog->getId()]["contact"] = $blog->getData();
        }

        if($edit == "cus"){
            $this->loadedData[$blog->getId()]["contact"]["edit"] = "true";
            $this->loadedData[$blog->getId()]["contact"]["cid"] = $cid;   
        }
        return $this->loadedData;
      }
      else{
        return "";
      }
    }
}