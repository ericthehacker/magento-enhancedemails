<?php

class EW_EnhancedEmails_Model_Core_Email_Template extends Mage_Core_Model_Email_Template
{
    protected $_eventPrefix = 'core_email_template';

    /**
     * Get filter object for template processing logic
     * and dispatch event
     *
     * @return Mage_Core_Model_Email_Template_Filter
     */
    public function getTemplateFilter()
    {
        $wasNull = empty($this->_templateFilter);
        $templateFilter = parent::getTemplateFilter();

        Mage::dispatchEvent(
            $this->_eventPrefix . '_get_template_filter_after',
            array(
                'template_filter'   => $templateFilter,
                'template'          => $this,
                'was_null'          => $wasNull
            )
        );

        return $templateFilter;
    }
}