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
 * @category   Mage
 * @package    Mage_Admin
 * @copyright  Copyright (c) 2008 Irubin Consulting Inc. DBA Varien (http://www.varien.com)
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */


class Mage_Core_Model_Mysql4_Design_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
	protected function _construct()
	{
		$this->_init('core/design');
	}

	public function joinStore(){
	    $this->getSelect()
            ->join(array('s'=>$this->getTable('core/store')), 's.store_id = main_table.store_id', array('s.name'));

	    return $this;
	}

	public function addDateFilter($date = null)
    {
        if (is_null($date))
            $date = date("Y-m-d");

        $this->getSelect()
            ->where('main_table.date_from <= ?', $date)
            ->where('main_table.date_to >= ?', $date);

        return $this;
    }

    public function addStoreFilter($storeId)
    {
        $this->getSelect()
            ->where('main_table.store_id = ?', $storeId);

        return $this;
    }
}
