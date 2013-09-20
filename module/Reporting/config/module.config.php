<?php
return array(
		'controllers' => array(
				'invokables' => array(
						'Reporting\Controller\Reporting' => 'Reporting\Controller\ReportingController',
				),
		),
		
		// The following section is new and should be added to your file
		'router' => array(
				'routes' => array(
						'reporting' => array(
								'type'    => 'segment',
								'options' => array(
										'route'    => '/reporting[/][:action][/:id][/:order]',
										'constraints' => array(
												'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
												'id'     => '[0-9]+',
												'order'  => '[a-zA-Z][a-zA-Z0-9_-]*',
										),
										'defaults' => array(
												'controller' => 'Reporting\Controller\Reporting',
												'action'     => 'index',
										),
								),
						),
				),
		),
		
		'view_manager' => array(
				'template_path_stack' => array(
						'reporting' => __DIR__ . '/../view',
				),
		),
);