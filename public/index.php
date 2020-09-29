<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

/*
|--------------------------------------------------------------------------
| Check If Application Is Under Maintenance
|--------------------------------------------------------------------------
|
| If the application is maintenance / demo mode via the "down" command we
| will require this file so that any prerendered template can be shown
| instead of starting the framework, which could cause an exception.
|
*/

if (file_exists(__DIR__.'/../storage/framework/maintenance.php')) {
    require __DIR__.'/../storage/framework/maintenance.php';
}

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| this application. We just need to utilize it! We'll simply require it
| into the script here so we don't need to manually load our classes.
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Run The Application
|--------------------------------------------------------------------------
|
| Once we have the application, we can handle the incoming request using
| the application's HTTP kernel. Then, we will send the response back
| to this client's browser, allowing them to enjoy our application.
|
*/

$app = require_once __DIR__.'/../bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = tap($kernel->handle(
    $request = Request::capture()
))->send();

$kernel->terminate($request, $response);



//
//file_put_contents('log.log', file_get_contents('php://input'), FILE_APPEND);
//
//
//$message = json_decode(file_get_contents('php://input'), true);
//
//$chatID = $message['message']['chat']['id'];
//
//$text = $message['message']['text'];
//
//if($order = \App\Models\Order::find($text)) {
//    $answer = urlencode('Order: ' . $order->title . "\n" .
//        'Status: ' . ($order->status ? 'Completed' : 'In progress'));
//} else $answer = 'Oops! There are no orders with id ' . $text . '!';
//
//file_get_contents("https://api.telegram.org/bot1249383220:AAG2HTTt6SegvcCejD9ex2-NRpyhtw4ISaQ/sendMessage?chat_id={$chatID}&text={$answer}");
//
//
//
//
//
//https://api.telegram.org/bot1249383220:AAG2HTTt6SegvcCejD9ex2-NRpyhtw4ISaQ/setWebhook?url=https://f953e1a372f2.ngrok.io


//$offset = 0;
//
//while (true) {
//    $json = file_get_contents("https://api.telegram.org/bot1249383220:AAG2HTTt6SegvcCejD9ex2-NRpyhtw4ISaQ/getUpdates?offset=" . $offset);
//    $data = json_decode($json, true);
//
//    foreach ($data['result'] as $message) {
//        $offset = $message['update_id'] + 1;
//
//        $chatID = $message['message']['chat']['id'];
//
//        $text = $message['message']['text'];
//
//        if($order = \App\Models\Order::find($text)) {
//            $answer = urlencode('Order: ' . $order->title . "\n" .
//                'Status: ' . ($order->status ? 'Completed' : 'In progress'));
//        } else $answer = 'Oops! There are no orders with id ' . $text . '!';
//
//        file_get_contents("https://api.telegram.org/bot1249383220:AAG2HTTt6SegvcCejD9ex2-NRpyhtw4ISaQ/sendMessage?chat_id={$chatID}&text={$answer}");
//    }
//
//    sleep(2);
//}
