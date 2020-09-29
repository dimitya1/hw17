<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class BotUpdates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bot:updates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run cycle to use telegram API';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $offset = 0;

        while (true) {
            $json = file_get_contents("https://api.telegram.org/bot1249383220:AAG2HTTt6SegvcCejD9ex2-NRpyhtw4ISaQ/getUpdates?offset=" . $offset);
            $data = json_decode($json, true);

            foreach ($data['result'] as $message) {
                $offset = $message['update_id'] + 1;

                $chatID = $message['message']['chat']['id'];

                $text = $message['message']['text'];

                if($order = \App\Models\Order::find($text)) {
                    $answer = urlencode('Order: ' . $order->title . "\n" .
                        'Status: ' . ($order->status ? 'Completed' : 'In progress'));
                } else {
                    $answer = 'Oops! There are no orders with id ' . $text . '!';
                }

                $headers = ['message', 'answer'];
                $answers = [[
                    "message" => $text,
                    "answer" => $answer,
                ]];
                $this->table($headers, $answers);
                file_get_contents("https://api.telegram.org/bot1249383220:AAG2HTTt6SegvcCejD9ex2-NRpyhtw4ISaQ/sendMessage?chat_id={$chatID}&text={$answer}");
            }
            sleep(2);
        }
    }
}
