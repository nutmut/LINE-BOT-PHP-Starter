<?php
$access_token = '4x7QqBNZJB8L62ZOJpyi2PdOrix7CVvI9z1gCHSZTGsbxW8BQb0lIDPXK7LFG525k/O4zAsNf/BgMwjc5rqSjL3Co6YCzT9tFWfmNqc4X7wXeRKWwB1ZpbgYHNnIE4s76wUhy7Wfd5sYIXnZCQOqXQdB04t89/1O/w1cDnyilFU=';
$mid='https://pacific-spire-34476.herokuapp.com/bot.php'
// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {


			// Get text sent
			$text = $event['message']['text'];
			
			$replyText = "";


			switch ($text) {
				case 'hi' :
					$replyText = "hello! how are you? ";
					$replyText += $sticker;
				break;
				case 'fine' :
					$replyText = "good to heard that. hope you have a nice day!. The weather is getting cold now. Take care yourself :)";
				break;
				case 'wyd?' :
					$replyText = "nothing so much~";
				break;
				case 'miss' :
					$replyText = "thank you (heart)";
				break;
				default:
					$replyText = $text;
			}
			
			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $replyText
			];

			//Build sticker
			$sticker = [
			 'constantType':8,
			 'contentMetadata':{
       		 	'stkid'    => 219,    # contentMetadata.STKID
       		 	'stkpkgid' => 3,    # contentMetadata.STKPKGID
       		 	'stkver'   => 100,    # contentMetadata.STKVER
       		 	}
			];


			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
				'sticker' => [$sticker],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";
		}
	}
}
echo "OK";