<?php

namespace InvigorateSystems\ContactBook\Model;

use Magento\Cron\Exception;
use Magento\Framework\Model\AbstractModel;

class Contact extends AbstractModel
{
   
    protected $_dateTime;

    
    protected function _construct()
    {
        $this->_init(\InvigorateSystems\ContactBook\Model\ResourceModel\Contact::class);
    }
    
}