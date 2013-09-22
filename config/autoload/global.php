<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return array(
    'db' => array(
        'driver'         => 'Pdo',
        'dsn'            => 'pgsql:host='.@$_ENV['OPENSHIFT_POSTGRESQL_DB_HOST'].';port='.@$_ENV['OPENSHIFT_POSTGRESQL_DB_PORT'].';dbname=water',
        'username'       => @$_ENV['OPENSHIFT_POSTGRESQL_DB_USERNAME'],
        'password'       => @$_ENV['OPENSHIFT_POSTGRESQL_DB_PASSWORD'],
    ),
    'service_manager' => array(
        'factories' => array(
            'Zend\Db\Adapter\Adapter'
                    => 'Zend\Db\Adapter\AdapterServiceFactory',
        ),
    ),
);
