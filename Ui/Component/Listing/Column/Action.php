<?php
namespace InvigorateSystems\ContactBook\Ui\Component\Listing\Column;
use Magento\Ui\Component\Listing\Columns\Column;

// InvigorateSystems\ContactBook\Ui\Component\Listing\Column\DeleteAction
/**
 * Class Actions
 */
class Action extends Column
{
    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                // here we can also use the data from $item to configure some parameters of an action URL
                $item[$this->getData('name')] = [
                    'edit' => [
                        'href' => $this->getContext()->getUrl('contactbook/create/insert',['id' => $item['contact_id'] ] ),
                        'label' => __('Edit')
                    ],
                    'remove' => [
                        'href' => $this->getContext()->getUrl('contactbook/create/delete',['id' => $item['contact_id'] ] ),
                        'label' => __('Delate')
                    ],
                ];
            }
        }
        return $dataSource;
    }
}