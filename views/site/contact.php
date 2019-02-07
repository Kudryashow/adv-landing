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

function process_message(AMQPMessage $message)
{
    $messageBody = json_decode($message->body);
    $email =  $messageBody->email;

    file_put_contents($email . '.json', $message->body);

    echo "\n--------\n";
    echo $message->body;
    echo "\n--------\n";
    $message->delivery_info['channel']->basic_ack($message->delivery_info['delivery_tag']);
    if ($message->body === 'quit') {
        $message->delivery_info['channel']->basic_cancel($message->delivery_info['consumer_tag']);
    }
}
$consumerTag = 'local.ubuntu.consumer';

$channel->basic_consume($queue, $consumerTag, false, false, false, false, 'process_message');

function shutdown ($channel, $connection)
{
    $channel->close();
    $connection->close();
}

register_shutdown_function('shutdown', $channel, $connection);

while (count($channel->callbacks)) {
    $channel->wait();
}
