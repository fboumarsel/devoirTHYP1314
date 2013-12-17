<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Etunote;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Etunote\Model\Etunote;
use Etunote\Model\EtunoteTable;
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
                     'Etunote' => __DIR__ . '/src/Etunote',
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
     			'factories' => array(
     					'Etunote\Model\EtunoteTable' =>  function($sm) {
     						$tableGateway = $sm->get('EtunoteTableGateway');
     						$table = new EtunoteTable($tableGateway);
     						return $table;
     					},
     					'EtunoteTableGateway' => function ($sm) {
     						$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
     						$resultSetPrototype = new ResultSet();
     						$resultSetPrototype->setArrayObjectPrototype(new Etunote());
     						return new TableGateway('etunote', $dbAdapter, null, $resultSetPrototype);
     					},
     			),
     	);
     }
}
