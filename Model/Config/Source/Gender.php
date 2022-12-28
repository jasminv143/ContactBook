<?php
namespace InvigorateSystems\ContactBook\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class Gender implements ArrayInterface
{
    public function toOptionArray()
    {
        $result = [];
        foreach ($this->getOptions() as $value => $label) {
            $result[] = [
                 'value' => $value,
                 'label' => $label,
             ];
        }

        return $result;
    }

    public function getOptions()
    {
        return [
            'male' => __('Male'),
            'female' => __('Female'),
        ];
    }
}
