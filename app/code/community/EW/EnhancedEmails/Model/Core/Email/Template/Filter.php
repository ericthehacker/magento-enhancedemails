<?php

class EW_EnhancedEmails_Model_Core_Email_Template_Filter extends Mage_Core_Model_Email_Template_Filter
{
    const DATEFORMAT_ORIGINAL_FORMAT_DEFAULT = 'Y-M-d H:m:s';

    /**
     * Directive to format variable using Zend_Date formatting capabilities
     *
     * @param $construction
     * @return string|Zend_Date
     * @throws Zend_Date_Exception
     */
    public function dateformatDirective($construction)
    {
        $params = $this->_getIncludeParameters($construction[2]);
        if(!isset($params['var'])) { //sanity guard clause
            return '';
        }

        $dateString = $params['var'];
        $dateOriginalFormat = isset($params['originalFormat']) ? $params['originalFormat'] : self::DATEFORMAT_ORIGINAL_FORMAT_DEFAULT;
        $includeTime = isset($params['include_time']);

        $dateFormatted = Mage::helper('core')->formatDate(
            Mage::getModel('core/locale')->storeDate($this->getStoreId(), $dateString, $includeTime, $dateOriginalFormat)
        );

        if(isset($params['format'])) {
            $timezone = Mage::getStoreConfig(Mage_Core_Model_Locale::XML_PATH_DEFAULT_TIMEZONE, $this->getStoreId());
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