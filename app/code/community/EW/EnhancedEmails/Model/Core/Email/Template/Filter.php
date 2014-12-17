<?php

class EW_EnhancedEmails_Model_Core_Email_Template_Filter extends Mage_Core_Model_Email_Template_Filter
{
    public function dateformatDirective($construction)
    {
        $params = $this->_getIncludeParameters($construction[2]);
        if(!isset($params['var'])) { //sanity guard clause
            return '';
        }

        $dateString = $params['var'];
        $dateOriginalFormat = isset($params['orignalFormat']) ? $params['orignalFormat'] : Zend_Date::ISO_8601;
        $includeTime = isset($params['include_time']);

        $dateFormatted = Mage::getModel('core/locale')->storeDate($this->getStoreId(), $dateString, $includeTime);

        if(isset($params['format'])) {
            $timezone = Mage::app()->getStore($this->getStoreId())->getConfig(Mage_Core_Model_Locale::XML_PATH_DEFAULT_TIMEZONE);
            $date = new Zend_Date($dateString, $dateOriginalFormat); //@todo: locale, 3rd parameter?
            $date->setTimezone($timezone);

            if (!$includeTime) {
                $date->setHour(0)
                    ->setMinute(0)
                    ->setSecond(0);
            }

            $dateFormatted = $date->toString($params['format']);
        }

        return $dateFormatted;
    }
}