<?php
namespace InvigorateSystems\ContactBook\Block\Adminhtml\Edit\Tab\View;
use Magento\Customer\Controller\RegistryConstants;
use InvigorateSystems\ContactBook\Block\Adminhtml\Edit\Tab\View\Renderer\Action;

class Contact extends \Magento\Backend\Block\Widget\Grid\Extended
{
   
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\App\Request\Http $request,
        \Magento\Backend\Helper\Data $backendHelper,
        \InvigorateSystems\ContactBook\Model\ResourceModel\Contact\CollectionFactory $collectionFactory,
        \Magento\Framework\Registry $coreRegistry,
        \InvigorateSystems\ContactBook\Model\Contact $blogFactory,
        array $data = []
    ) {
        
        $this->_coreRegistry = $coreRegistry;
        $this->blogFactory = $blogFactory;
        $this->_request = $request;
        $this->_collectionFactory = $collectionFactory;
        parent::__construct($context, $backendHelper, $data);
    }

    protected function _construct()
    {
        parent::_construct();
        $this->setId('contact_view_grid');
        $this->setDefaultSort('contact_id');
        $this->setDefaultDir('desc');
        $this->setUseAjax(true);
        $this->setEmptyText(__('No Contact Found'));
    }
    protected function _prepareGrid()
    {
        $this->setId('contact_view_grid' . $this->getWebsiteId());
        parent::_prepareGrid();
    }
    
    protected function _preparePage()
    {
        $this->getCollection()->setPageSize(5)->setCurPage(1);
    }

    
    protected function _prepareCollection()
    {
        $id = $this->_request->getParam('id');
        $model = $this->blogFactory->getCollection()->addFieldToFilter("customer_id", $id)->load();
        $this->setCollection($model);

        return parent::_prepareCollection();
    }

    
     protected function _prepareColumns()
    {
        $this->addColumn(
            'product_id',
            ['header' => __('ID'), 'index' => 'contact_id', 'align' => 'left', 'type' => 'number', 'width' => '5px']
        );

        $this->addColumn(
            'name',
            [
                'header' => __('Name'),
                'align' => 'center',
                'index' => 'name',
            ]
        );

        $this->addColumn(
            'gender',
            [
                'header' => __('Gender'),
                'align' => 'center',
                'index' => 'gender',
            ]
        );

        $this->addColumn(
            'email',
            [
                'header' => __('Email'),
                'align' => 'center',
                'index' => 'email',
            ]
        );

        $this->addColumn(
            'city',
            [
                'header' => __('City'),
                'align' => 'center',
                'index' => 'city',
            ]
        );

        $this->addColumn(
            'phone_number',
            [
                'header' => __('Phone Number'),
                'index' => 'phone_number',
                'align' => 'center',
            ]
        );
        $this->addColumn(
            'created_at',
            [
                'header' => __('Create At'),
                'type' => 'datetime',
                'align' => 'center',
                'index' => 'created_at',
            ]
        );
        $this->addColumn(
            'updated_at',
            [
                'header' => __('Update At'),
                'type' => 'datetime',
                'align' => 'center',
                'index' => 'updated_at',
            ]
        );
         $this->addColumn(
            'action',
            [
                'header' => __('Action'),
                'align' => 'center',
                'filter' => false,
                'sortable' => false,
                'renderer' => Action::class
            ]
        );

        return parent::_prepareColumns();
        return "";
    }

    
    public function getHeadersVisibility()
    {
        return $this->getCollection()->getSize() >= 0;
        return "";
    }

    
    public function getRowUrl($row)
    {
        return $this->getUrl('catalog/product/edit', ['id' => $row->getProductId()]);
        return "";
    }
}
