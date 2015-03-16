<?php

return array(
    'controllers' => array(
        'invokables' => array(
            'Supplier\Controller\Supplier' => 'Supplier\Controller\SupplierController',
        ),
    ),
    // The following section is new and should be added to your file
    'router' => array(
        'routes' => array(
            'supplier' => array(
                'type' => 'segment',
                'options' => array(
                    'route' => '/suppliers[/:id]',
                    'constraints' => array(
                        'id' => '[0-9]+',
                    ),
                    'defaults' => array(
                        'controller' => 'Supplier\Controller\Supplier'
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'strategies' => array(
            'ViewJsonStrategy',
        ),
    ),
    'doctrine' => array(
        'driver' => array(
            'supplier_entities' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(__DIR__ . '/../src/Supplier/Model')
            ),
            'orm_default' => array(
                'drivers' => array(
                    'Supplier\Model' => 'supplier_entities'
                )
            )
        )
    )
);
