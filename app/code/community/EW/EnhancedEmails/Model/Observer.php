<?php

class EW_EnhancedEmails_Model_Observer extends Mage_Core_Model_Abstract
{
    /**
     * Allow template filter store to be selected
     * Observes: core_email_template_get_template_filter_after
     *
     * @param Varien_Event_Observer $observer
     */
    public function selectTemplateFilterStore(Varien_Event_Observer $observer) {
        if(!$observer->getWasNull()){
            return; //only run once
        }

        /* @var $filter Mage_Core_Model_Email_Template_Filter */
        $filter = $observer->getTemplateFilter();
        /* @var $template EW_EnhancedEmails_Model_Core_Email_Template */
        $template = $observer->getTemplate();

        if($template->hasStoreId()) {
            $filter->setStoreId($template->getStoreId());
        }
    }
}