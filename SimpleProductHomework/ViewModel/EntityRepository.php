<?php
namespace Perspective\SimpleProductHomework\ViewModel;

use Magento\Catalog\Api\Data\ProductInterface;
use Magento\Framework\Api\SortOrder;

class EntityRepository implements \Magento\Framework\View\Element\Block\ArgumentInterface
{

    /**
     * @var \Magento\Catalog\Api\ProductRepositoryInterface
     */
    private $_productRepository;

    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    private $_searchCriteriaBuilder;

    /**
     * @var Magento\Framework\Api\SortOrderBuilder
     */
    private $_sortOrderBuilder;

    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilderFactory
     */
    private $_searchCriteriaBuilderFactory;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context

     */
    public function __construct(
        \Magento\Catalog\Api\ProductRepositoryInterface $productRepository,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\Api\SortOrderBuilder $sortOrderBuilder,
        \Magento\Framework\Api\SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory
    ) {
        $this->_productRepository = $productRepository;
        $this->_searchCriteriaBuilder = $searchCriteriaBuilder;
        $this->_sortOrderBuilder = $sortOrderBuilder;
        $this->_searchCriteriaBuilderFactory = $searchCriteriaBuilderFactory;


    }

 
    public function getSimpleProducts()
    {
        $searchCriteriaBuilder = $this->_searchCriteriaBuilderFactory->create();
        
        $searchCriteriaBuilder->addFilter(
            ProductInterface::NAME,
            "E%",
            'like'
        );
        $searchCriteriaBuilder->addFilter(
            ProductInterface::PRICE,
            40,
            'gt'
        );

        $searchCriteriaBuilder->addFilter(
            ProductInterface::PRICE,
            45,
            'lt'
        );
        $sortOrder = $this->_sortOrderBuilder
            ->setField('price')  //FIELD_NAME
            ->setDirection(SortOrder::SORT_DESC) // SORT_TYPE
            ->create();

            
            
            
        $searchCriteriaBuilder->addSortOrder($sortOrder);
        $searchCriteria = $searchCriteriaBuilder->create();
        $searchCriteria->setPageSize(5);
        $productCollection = $this->_productRepository->getList($searchCriteria);
        

        return $productCollection->getItems();
    }
}

