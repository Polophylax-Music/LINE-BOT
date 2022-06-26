<?php
require_once __DIR__ . '/vendor/autoload.php';

$httpClient = new \LINE\LINEBot\HTTPClient\CurlHTTPClient(getenv('CHANNEL_ACCESS_TOKEN'));
$bot = new \LINE\LINEBot($httpClient, ['channelSecret' => getenv('CHANNEL_SECRET')]);
$signature = $_SERVER['HTTP_' . \LINE\LINEBot\Constant\HTTPHeader::LINE_SIGNATURE];
$events = $bot->parseEventRequest(file_get_contents('php://input'),$signature);

foreach($events as $event){
	if(strpos($event->getText(),'こんにちは') !== false){
		$bot->replyText($event->getReplyToken(), 'こんにちは。');
	}else if(strpos($event->getText(),'おはよう') !== false){
		$bot->replyText($event->getReplyToken(), 'おはようございます。');
	}else if(strpos($event->getText(),'こんばんは') !== false){
		$bot->replyText($event->getReplyToken(), 'こんばんは。');
	}else if(strpos($event->getText(),'おやすみ') !== false){
		$bot->replyText($event->getReplyToken(), 'おやすみなさい。');
	}else{
		$bot->replyText($event->getReplyToken(), $event->getText().'で検索しました。'."\n".'https://www.google.co.jp/search?q='.$event->getText());
	}
}
?>