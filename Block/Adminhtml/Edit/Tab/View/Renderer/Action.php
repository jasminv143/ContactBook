<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace InvigorateSystems\ContactBook\Block\Adminhtml\Edit\Tab\View\Renderer;

use Magento\Framework\Escaper;
use Magento\Framework\App\ObjectManager;

/**
 * Adminhtml newsletter queue grid block action item renderer
 */
class Action extends \Magento\Backend\Block\Widget\Grid\Column\Renderer\AbstractRenderer
{
    /**
     * @var Escaper
     */
    private $escaper;

    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry = null;

    /**
     * @param \Magento\Backend\Block\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     * @param Escaper|null $escaper
     */
    public function __construct(
        \Magento\Backend\Block\Context $context,
        \Magento\Framework\App\Request\Http $request,
        \Magento\Framework\Registry $registry,
        array $data = [],
        Escaper $escaper = null
    ) {
        $this->_coreRegistry = $registry;
        $this->_request = $request;
        $this->escaper = $escaper ?? ObjectManager::getInstance()->get(
            Escaper::class
        );
        parent::__construct($context, $data);
    }

    /**
     * Render actions
     *
     * @param \Magento\Framework\DataObject $row
     * @return string
     */
    public function render(\Magento\Framework\DataObject $row)
    {
        $id = $this->_request->getParam('id');
        $actions = [];
        $actions[] = [
            '@' => [
                'href' => $this->getUrl(
                    'contactbook/create/insert',
                    ['id' => $row->getContactId(), "edit"=>'cus', "cus"=>$id ]
                ),
                'target' => '_self',
            ],
            '#' => __('Edit'),
        ];
        $actions[] = [
            '@' => [
                'href' => $this->getUrl(
                    'contactbook/create/delete',
                    ['id' => $row->getContactId(), "delete" => 'cus', "cus"=> $id  ]
                ),
                'target' => '_self',
            ],
            '#' => __('Delete'),
        ];

        return $this->_actionsToHtml($actions);
    }

  
    /**
     * Retrieve escaped value
     *
     * @param string $value
     * @return string
     */
    protected function _getEscapedValue($value)
    {
        // phpcs:ignore Magento2.Functions.DiscouragedFunction
        return addcslashes($this->escaper->escapeHtml($value), '\\\'');
    }

    /**
     * Actions to html
     *
     * @param array $actions
     * @return string
     */
    protected function _actionsToHtml(array $actions)
    {
        $html = [];
        $attributesObject = new \Magento\Framework\DataObject();
        foreach ($actions as $action) {
            $attributesObject->setData($action['@']);
            $html[] = '<a ' . $attributesObject->serialize() . '>' . $action['#'] . '</a>';
        }
        return implode('<span class="separator">&nbsp;|&nbsp;</span>', $html);
    }
}
