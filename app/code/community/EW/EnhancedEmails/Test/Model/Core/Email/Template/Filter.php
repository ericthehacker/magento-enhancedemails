<?php

class EW_EnhancedEmails_Test_Model_Core_Email_Template_Filter extends EcomDev_PHPUnit_Test_Case
{
    /**
     * test dateformatDirective functionality
     *
     * @test
     * @loadFixture
     * @dataProvider dataProvider
     * @param $inputString
     * @param $expectation
     * @return bool
     */
    public function dateformatDirective($inputString, $locale, $expectation) {
        Mage::getSingleton('core/locale')->setLocale($locale)
                                         ->setDefaultLocale($locale)
                                         ->setLocaleCode($locale);

        $filter = new EW_EnhancedEmails_Model_Core_Email_Template_Filter();
        $value = $filter->filter($inputString);

        $this->assertEquals($expectation, $value);
    }
}