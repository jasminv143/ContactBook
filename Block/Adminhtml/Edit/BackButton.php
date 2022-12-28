<?php

namespace InvigorateSystems\ContactBook\Block\Adminhtml\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class BackButton implements ButtonProviderInterface
{
    /**
     * @return array
     */
    protected $urlBuilder;

    protected $registry;

    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\App\Request\Http $request,
        \Magento\Framework\Registry $registry
    ) {
        $this->urlBuilder = $context->getUrlBuilder();
        $this->_request = $request;
        $this->registry = $registry;
    }

    public function getUrl($route = '', $params = [])
    {
        return $this->urlBuilder->getUrl($route, $params);
    }
    public function getParamURL(){
        $cid = $this->_request->getParam('cus');
        $edit = $this->_request->getParam('edit');
        if($edit == "cus"){
            return $this->getUrl('customer/index/edit',[ "id" => $cid]);     
        }
        return $this->getUrl('contactbook/create/index');
    }

    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'on_click' => sprintf("location.href = '%s';", $this->getParamURL()),
            'class' => 'back',
            'sort_order' => 10
        ];
    }

    /**
     * Get URL for back (reset) button
     *
     * @return string
     */
   
}
