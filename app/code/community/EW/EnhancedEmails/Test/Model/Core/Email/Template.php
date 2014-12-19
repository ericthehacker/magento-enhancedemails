<?php

class EW_EnhancedEmails_Test_Model_Core_Email_Template extends EcomDev_PHPUnit_Test_Case
{
    /**
     * test dateformatDirective functionality
     *
     * @test
     * @loadFixture
     * @dataProvider dataProvider
     * @param int $templateId
     * @param $storeId
     * @loadExpectation
     */
    public function getTemplateFilter($templateId, $storeId) {
        /** @var $template Mage_Core_Model_Email_Template */
        $template = Mage::getModel('core/email_template');
        $template->load($templateId);

        $vars = array();

        $templateProcessed = $template->getProcessedTemplate($vars, true);

        $expectations = self::expected();
        $expectation = $expectations['templates'][$templateId][$storeId];

        $this->assertEventDispatched('core_email_template_get_template_filter_after');

        $this->assertEquals($expectation, $templateProcessed);
    }
}