<?php

namespace Perspective\ErsteViewModule\ViewModel;

class ErsteViewModel implements \Magento\Framework\View\Element\Block\ArgumentInterface
{
    public function sayHello()
    {
        return __('Learn Magento 2 ViewModel Layout');
    }
}
