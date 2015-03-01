<?php
/* @var $this \Magento\Customer\Model\Resource\Setup */
$installer = $this;
$installer->startSetup();

//$installer->addAttribute('customer', 'registration_remote_ip', array(
//'label' => 'Registration IP Address',
//'type' => 'varchar',
//'input' => 'text',
//'backend' => 'ElasticArray\CustomerRegIp\Model\Entity\Attribute\Backend\Remoteip',
//'required' => 0,
//'visible' => 0,
//));

$installer->endSetup();