<?php
namespace Perspective\CategoryHomework\ViewModel;

class Category implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    /**
     * @var \Magento\Catalog\Api\Data\CategoryInterface
     */


    /**
     * @var Magento\Catalog\Api\CategoryListInterface 
     */
    private $categoryList;

    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilder
     */
    private $searchCriteriaBuilder;

    public function __construct(
        \Magento\Catalog\Api\CategoryListInterface  $categoryList,
        \Magento\Framework\Api\SearchCriteriaBuilder $searchCriteriaBuilder
    )
    {
        $this->categoryList = $categoryList;
        $this->searchCriteriaBuilder = $searchCriteriaBuilder;
        
    }
    public function getAllSystemCategory()
    {
        $categoryList = [];

            $searchCriteria = $this->searchCriteriaBuilder->create();
            $categoryList = $this->categoryList->getList($searchCriteria);

        return $categoryList->getItems() ;
    }
    
}
