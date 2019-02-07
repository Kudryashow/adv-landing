<?php
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
$host = 'bear.rmq.cloudamqp.com';
$port = 5672;
$user = 'ogkhqcqq';
$pass = '5lN8AHG4y3zy6KsXlR4rF3UQwXto6pf7';
$vhost = 'ogkhqcqq';
$exchange = 'subscribers';
$queue = 'gurucoder_subscribers';

$connection = new AMQPStreamConnection($host, $port, $user, $pass, $user);
$channel = $connection->channel();

$channel->queue_declare($queue, false, false, false, false);
$channel->exchange_declare($exchange, 'direct', false, true, false);
$channel->queue_bind($queue, $exchange);

$messageBody = json_encode([
    'email' => 'john.doe@derp.com',
   'subscribed' => true
]);

$message = new AMQPMessage($messageBody, [
    'content_type' => 'application/json',
    'delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT]);
$channel->basic_publish($message, $exchange);
$channel->close();
$connection->close();