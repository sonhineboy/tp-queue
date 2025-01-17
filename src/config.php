<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: yunwuxin <448901948@qq.com>
// +----------------------------------------------------------------------

return [
    'default' => 'rabbiMQ',
    'connections' => [
        'sync' => [
            'type' => 'sync',
        ],
        'database' => [
            'type' => 'database',
            'queue' => 'default',
            'table' => 'jobs',
            'connection' => null,
        ],
        'redis' => [
            'type' => 'redis',
            'queue' => 'default',
            'host' => '127.0.0.1',
            'port' => 6379,
            'password' => '',
            'select' => 0,
            'timeout' => 0,
            'persistent' => false,
        ],
        'rabbiMQ' => [
            'type' => 'rabbitMq',
            'dsn' => env('RABBITMQ.RABBITMQ_DSN', null),
            'host' => env('RABBITMQ.RABBITMQ_HOST', '127.0.0.1'),
            'port' => env('RABBITMQ.RABBITMQ_PORT', 5672),
            'vhost' => env('RABBITMQ.RABBITMQ_VHOST', '/'),
            'login' => env('RABBITMQ.RABBITMQ_LOGIN', 'admin'),
            'password' => env('RABBITMQ.RABBITMQ_PASSWORD', 'admin'),
            'queue' => env('RABBITMQ.RABBITMQ_QUEUE', 'default'),
            'options' => [
                'exchange' => [
                    'name' => env('RABBITMQ_EXCHANGE_NAME',"default_exchange"),
                    /*
                    * Determine if exchange should be created if it does not exist.
                    */
                    'declare' => env('RABBITMQ_EXCHANGE_DECLARE', true),
                    /*
                    * Read more about possible values at https://www.rabbitmq.com/tutorials/amqp-concepts.html
                    */
                    'type' => env('RABBITMQ_EXCHANGE_TYPE', \Interop\Amqp\AmqpTopic::TYPE_DIRECT),
                    'passive' => env('RABBITMQ_EXCHANGE_PASSIVE', false),
                    'durable' => env('RABBITMQ_EXCHANGE_DURABLE', true),
                    'auto_delete' => env('RABBITMQ_EXCHANGE_AUTODELETE', false),
                    'arguments' => env('RABBITMQ_EXCHANGE_ARGUMENTS'),
                ],

                'queue' => [
                    /*
                    * Determine if queue should be created if it does not exist.
                    */
                    'declare' => env('RABBITMQ_QUEUE_DECLARE', true),
                    /*
                    * Determine if queue should be binded to the exchange created.
                    */
                    'bind' => env('RABBITMQ_QUEUE_DECLARE_BIND', true),
                    /*
                    * Read more about possible values at https://www.rabbitmq.com/tutorials/amqp-concepts.html
                    */
                    'passive' => env('RABBITMQ_QUEUE_PASSIVE', false),
                    'durable' => env('RABBITMQ_QUEUE_DURABLE', true),
                    'exclusive' => env('RABBITMQ_QUEUE_EXCLUSIVE', false),
                    'auto_delete' => env('RABBITMQ_QUEUE_AUTODELETE', false),
                    'arguments' => env('RABBITMQ_QUEUE_ARGUMENTS'),
                ],
            ],

            /*
             * Determine the number of seconds to sleep if there's an error communicating with rabbitmq
             * If set to false, it'll throw an exception rather than doing the sleep for X seconds.
             */
            'sleep_on_error' => env('RABBITMQ_ERROR_SLEEP', 5),

            /*
             * Optional SSL params if an SSL connection is used
             */
            'ssl_params' => [
                'ssl_on' => env('RABBITMQ_SSL', false),
                'cafile' => env('RABBITMQ_SSL_CAFILE', null),
                'local_cert' => env('RABBITMQ_SSL_LOCALCERT', null),
                'local_key' => env('RABBITMQ_SSL_LOCALKEY', null),
                'verify_peer' => env('RABBITMQ_SSL_VERIFY_PEER', true),
                'passphrase' => env('RABBITMQ_SSL_PASSPHRASE', null),
            ],
        ]
    ],
    'failed' => [
        'type' => 'none',
        'table' => 'failed_jobs',
    ],
];
