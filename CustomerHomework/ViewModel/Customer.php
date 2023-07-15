<?php

namespace Perspective\CustomerHomework\ViewModel;

use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Framework\Api\SortOrder;

class Customer implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    private $_customerFactory;

    /**
     * @var \Magento\Framework\Api\SearchCriteriaBuilderFactory
     */
    private $_searchCriteriaBuilderFactory;

    /**
     * @var \Magento\Framework\Api\SortOrderBuilder
     */
    private $_sortOrderBuilder;

    /**
     * @var \Magento\Customer\Api\CustomerRepositoryInterface
     */
    private $_customerRepository;

    public function __construct(

        \Magento\Customer\Model\CustomerFactory $customerFactory,
        \Magento\Framework\Api\SearchCriteriaBuilderFactory $searchCriteriaBuilderFactory,
        \Magento\Framework\Api\SortOrderBuilder $sortOrderBuilder,
        \Magento\Customer\Api\CustomerRepositoryInterface $customerRepository
    ) {

        $this->_customerFactory = $customerFactory;
        $this->_searchCriteriaBuilderFactory = $searchCriteriaBuilderFactory;
        $this->_sortOrderBuilder = $sortOrderBuilder;
        $this->_customerRepository = $customerRepository;
    }

    public function getCustomerCollection()
    {
        $collection = $this->_customerFactory->create()->getCollection()->load();

        return $collection;
    }

    public function getCustomer()
    {
        $searchCriteriaBuilder = $this->_searchCriteriaBuilderFactory->create();
        
        /*$searchCriteriaBuilder->addFilter(
            CustomerInterface::LASTNAME,
            "E%",
            'like'
        );*/
        $searchCriteriaBuilder->addFilter(
            CustomerInterface::EMAIL,
            "%gmail.com",
            'like'
        );


        $sortOrder = $this->_sortOrderBuilder
            ->setField('lastname')  //FIELD_NAME
            ->setDirection(SortOrder::SORT_ASC) // SORT_TYPE
            ->create();

            
            
            
        $searchCriteriaBuilder->addSortOrder($sortOrder);
        $searchCriteria = $searchCriteriaBuilder->create();
        //$searchCriteria->setPageSize(5);
        $productCollection = $this->_customerRepository->getList($searchCriteria);
        

        return $productCollection->getItems();
    }
}
