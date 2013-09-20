<?php
namespace Reporting;

use Reporting\Model\Reporting;
use Reporting\Model\ReportingTable;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;


class Module
{
	public function getAutoloaderConfig()
	{
		return array(
				'Zend\Loader\ClassMapAutoloader' => array(
						__DIR__ . '/autoload_classmap.php',
				),
				'Zend\Loader\StandardAutoloader' => array(
						'namespaces' => array(
								__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
						),
				),
		);
	}

	public function getConfig()
	{
		return include __DIR__ . '/config/module.config.php';
	}
	
	public function getServiceConfig()
	{
		return array(
				//note:
				//trick to use one table for reading but a view (doing (x,y)-->geometry after insert) for inserting data
				//table : postgresql relation (table) : obstruction_report
				//insert view : postgresql relation (view) : insert_view
				//for now x,y should not benever edited!
				'factories' => array(
						'Reporting\Model\ReportingTable' =>  function($sm) {
							$tableGateway = $sm->get('ReportingTableGateway');
							$table = new ReportingTable($tableGateway);
							return $table;
						},
						'ReportingTableGateway' => function ($sm) {
							$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
							$resultSetPrototype = new ResultSet();
							$resultSetPrototype->setArrayObjectPrototype(new Reporting());
							return new TableGateway('obstruction_report', $dbAdapter, null, $resultSetPrototype);
						},
						'Reporting\Model\InsertViewTable' =>  function($sm) {
							$tableGateway = $sm->get('InsertViewTableGateway');
							$table = new ReportingTable($tableGateway);
							return $table;
						},
						'InsertViewTableGateway' => function ($sm) {
							$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
							$resultSetPrototype = new ResultSet();
							$resultSetPrototype->setArrayObjectPrototype(new Reporting());
							return new TableGateway('insert_view', $dbAdapter, null, $resultSetPrototype);
						},
				),
		);
	}
}