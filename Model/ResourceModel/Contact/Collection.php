<?php

namespace InvigorateSystems\ContactBook\Model\ResourceModel\Contact;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    public function _construct()
    {
        $this->_init('InvigorateSystems\ContactBook\Model\Contact', 'InvigorateSystems\ContactBook\Model\ResourceModel\Contact');
    }
}