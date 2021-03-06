<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Magento
 * @package     Mage_DesignEditor
 * @subpackage  unit_tests
 * @copyright   Copyright (c) 2013 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class Mage_DesignEditor_Model_Config_Control_QuickStylesTest extends PHPUnit_Framework_TestCase
{
    public function testGetSchemaFile()
    {
        /** @var $moduleReader Mage_Core_Model_Config_Modules_Reader|PHPUnit_Framework_MockObject_MockObject */
        $moduleReader = $this->getMockBuilder('Mage_Core_Model_Config_Modules_Reader')
            ->setMethods(array('getModuleDir'))
            ->disableOriginalConstructor()
            ->getMock();

        $moduleReader->expects($this->any(), $this->any())
            ->method('getModuleDir')
            ->will($this->returnValue('/base_path/etc'));

        /** @var $quickStyle Mage_DesignEditor_Model_Config_Control_QuickStyles */
        $quickStyle = $this->getMock('Mage_DesignEditor_Model_Config_Control_QuickStyles', null, array(
            'moduleReader' => $moduleReader, 'configFiles' => array('sample')
        ), '', false);

        $property = new ReflectionProperty($quickStyle, '_moduleReader');
        $property->setAccessible(true);
        $property->setValue($quickStyle, $moduleReader);

        $this->assertStringMatchesFormat('%s/etc/quick_styles.xsd', $quickStyle->getSchemaFile());
    }
}
