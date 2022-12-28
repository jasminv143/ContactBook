<?php
namespace InvigorateSystems\ContactBook\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;
use Magento\Framework\Data\OptionSourceInterface;
use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory as CustomerCollectionFactory;
use Magento\Framework\App\RequestInterface;

class customerId implements OptionSourceInterface
{
     protected $customerCollectionFactory;
    /**
     * @var RequestInterface
     */
    protected $request;
    /**
     * @var array
     */
    protected $customerTree;
    /**
     * @param CustomerCollectionFactory $customerCollectionFactory
     * @param RequestInterface $request
     */
    public function __construct(
        CustomerCollectionFactory $customerCollectionFactory,
        RequestInterface $request
    ) {
        $this->customerCollectionFactory = $customerCollectionFactory;
        $this->request = $request;
    }
    /**
     * {@inheritdoc}
     */
    public function toOptionArray()
    {
        return $this->getCustomerTree();
    }
    /**
     * Retrieve categories tree
     *
     * @return array
     */
    protected function getCustomerTree()
    {
        if ($this->customerTree === null) {
            $collection = $this->customerCollectionFactory->create();
            $collection->addNameToSelect();
            foreach ($collection as $customer) {
                $customerId = $customer->getEntityId();
                if (!isset($customerById[$customerId])) {
                    $customerById[$customerId] = [
                        'value' => $customerId
                    ];
                }
                $customerById[$customerId]['label'] = $customer->getEntityId()." ".$customer->getName() ;
            }
            $this->customerTree = $customerById;
        }
        return $this->customerTree;
    }   
    // public function toOptionArray()
    // {
    //     $result = [];
    //     foreach ($this->getOptions() as $value => $label) {
    //         $result[] = [
    //              'value' => $value,
    //              'label' => $label,
    //          ];
    //     }

    //     return $result;
    // }

    // public function getOptions()
    // {
    //     return [
    //         'male' => __('Male'),
    //         'female' => __('Female'),
    //     ];
    // }
}
