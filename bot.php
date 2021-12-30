<?php 

$TOKEN="5029460056:AAFJ9m5ZgfxAqzUh6UIrJLhnwajPl5ZFfUU";
$ADMIN="201555521";
define('API_KEY',$TOKEN);
//-----------------------------------------------------------------------------
function Bot($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
//-----------------------------------------------------------------------------
//متغیر ها :
// msg
$config=json_decode(file_get_contents("data/config.json"),true);
$bans=file_get_contents("data/bans.txt");
$usernamebot=$config["username"];
$botid=$config["botid"];
$channel1=$config["channel1"];
$channel2=$config["channel2"];
$PV=$config["PV"];
$GP=$config["gp"];
$DUTY=$config["duty"];
$stats=file_get_contents("stats.txt");
######################################
if($DDD!=1){
    $admins=file_get_contents('data/admins');
######################################
if(!file_exists('data/config.json')){
    $admins="$ADMIN";
    $url= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    $url= str_replace(['//','/index.php/index.php'],['/','/index.php'],$url.'/index.php');
    echo file_get_contents("https://api.telegram.org/bot".API_KEY."/setwebhook?url=https://$url");
Bot('SendMessage',['chat_id'=>$ADMIN,'text'=>'Config Started ...']);
mkdir('data');
mkdir('user');
    file_put_contents('data/admins',"$ADMIN");
$result=bot('getme')->result;
$usernamebot = $result->username;
$botid = $result->id;
$DT=['username'=>$usernamebot,'botid'=>$botid,'gp'=>'','PV'=>'','channel1'=>'','channel2'=>'','duty'=>''];
    file_put_contents('stats.txt',"$ADMIN\n");
    file_put_contents("data/config.json",json_encode($DT));
     file_put_contents("data/bans.json",json_encode([]));
Bot('SendMessage',['chat_id'=>$ADMIN,'text'=>'Config Success !Plz Re /start']);
exit;
}#####################################
$Dev = explode('-',$admins); // put id of admins
//-----------------------------------------------------------------------------------------------
$input=file_get_contents('php://input');
file_put_contents('update.txt',$input);
if(!$input and !$DDD)  exit;
$update = json_decode($input);
$message = $update->message;
$from_id = $message->from->id;
$chat_id = $message->chat->id;
$message_id = $message->message_id;
$first_name = $message->from->first_name;
$username = $message->from->username;
$textmassage = $message->text;
$text = $textmassage;
$messageid = $update->callback_query->message->message_id;
$tc = $update->message->chat->type;
$chatid = $update->callback_query->message->chat->id;
$fromid = $update->callback_query->from->id;
$fd=$from_id.$fromid;
$md=$messageid.$message_id;
if(strpos($bans,"$fd\n") !== false and $fd != $Dev[0]) exit;
if(strlen($channel1) > 4) $JOIN1=Bot('getChatMember',['chat_id'=>"@$channel1",'user_id'=>"$from_id"])->result->status;
if(strlen($channel2) > 4 and $channel2 != $channel1) $JOIN2=Bot('getChatMember',['chat_id'=>"@$channel2",'user_id'=>"$from_id"])->result->status;
$cd=$chat_id.$chatid;
$data = $update->callback_query->data;
$membercall = $update->callback_query->id;
$firstname = $update->message->from->first_name;
$username = $update->message->from->username;

//==================================================================

if($fd and strpos("\n$stats","\n$fd\n") === false)  file_put_contents('stats.txt',"$fd\n$stats");
$juser=json_decode(file_get_contents("user/$from_id.json"),true);
$mjson=json_decode(file_get_contents("data/m.json"),true);
$tstart=$mjson["start"];
$tsend=$mjson["send"];
$bsend=$mjson["bsend"];
$thelp=$mjson["help"];
$bhelp=$mjson["bhelp"];
if(strlen($bhelp)<3 ) $bhelp=null;
$babout=$mjson["babout"];
if(strlen($babout)<3 ) $babout=null;
$tabout=$mjson["about"];
if(!$tstart) $tstart='Welcome';
if(!$tsend and $tsend!='0') $tsend='Sended !' ;
//==================================================================

$Akey=json_encode([
'keyboard'=>[
	  	  	 [
		['text'=>"⚙️ امار ربات"]
		 ],[
	  	['text'=>"📝 متن پیام ارسال شد"],['text'=>"📝 متن استارت"]
	  ],[
	      ['text'=>'📝 متن دکمه درباره'],['text'=>"📝 متن دکمه راهنما"]
	     ],[
	         ['text'=>"📢 ثبت کانال دو"],['text'=>"📢 ثبت کانال یک"]
	         ],[
	         ['text'=>'🕹 خاموش / روشن کردن ربات']
	         ],[
	  	['text'=>"📭 ارسال به کاربران"],['text'=>"📭 فروارد به کاربران"]
	  ],[
	      ['text'=>'📓 لیست کاربران سیاه']
	      ]
       ],
  'resize_keyboard'=>true
   ]);
   $mkey=json_encode([
    'keyboard'=>[
		 		  	[
	  	['text'=>"$bhelp"],['text'=>"$babout"]
	  ],
   ],
      'resize_keyboard'=>true
   ]);
//==================================================================
if($chat_id != $fd and $chat_id != $GP and $fd != $Dev[0]){
    Bot('leaveChat',['chat_id'=>$cd]);
    exit;
}elseif($fd != $ADMIN and $DUTY=='OFF'){
    Bot('sendmessage',[
        "chat_id"=>$cd,
        "text"=>"🔴 ربات در حال حاضر خاموش میباشد !\n⏳ ساعاتی دیگر مراجعه کنید دوست عزیز.",
        'reply_markup'=>json_encode(['remove_keyboard'=>true])
		]);
    exit;
    }elseif($bhelp and $thelp and $text==$bhelp){
    Bot('sendmessage',[
        "chat_id"=>$cd,
        "text"=>"$thelp",
        'reply_markup'=>$mkey
		]);
    exit;
    }elseif($babout and $tabout and $text==$babout){
    Bot('sendmessage',[
        "chat_id"=>$cd,
        "text"=>"$tabout",
        'reply_markup'=>$mkey
		]);
    exit;
    }elseif($chat_id and $chat_id != $fd and $chat_id != $GP and $fd == $Dev[0]){
    Bot('sendmessage',[
        "chat_id"=>$cd,
        "text"=>"آیا این گروه برای پیامرسانی انتخاب شود ؟",
        'reply_markup'=>json_encode(['inline_keyboard'=>[
            [['text'=>'بله','callback_data'=>'Yes']],
            [['text'=>'خیر','callback_data'=>'No']],
            ]])
		]);
    exit;
}elseif($text=='/PV' and $cd == $GP and $fd == $ADMIN){

     Bot('editMessageText',[
        "chat_id"=>$cd,
        'message_id'=>$md,
        "text"=>"پیامرسانی در گروه لغو شد !",
		]);
		$config["gp"]='';
		$config["PV"]='ON';
		file_put_contents('data/config.json',json_encode($config));
		Bot('leaveChat',['chat_id'=>$GP]);
    exit;
}elseif($data=='Yes' and $fd == $ADMIN){
    if($cd==$GP){
         Bot('editMessageText',[
        "chat_id"=>$cd,
        'message_id'=>$md,
        "text"=>"این گروه قبلا تنظیم شده!\nبرای خاموش کردن فروارد به گروه دستور /pV\nبرای تغییر گروه ربات را در گروه جدید ادد کنید.",
		]);
    }else{
     Bot('leaveChat',['chat_id'=>$GP]);
    Bot('editMessageText',[
        "chat_id"=>$cd,
        'message_id'=>$md,
        "text"=>"این گروه برای پیامرسانی انتخاب شد\n\n/PV - لغو و پیامرسانی در پیوی ",
		]);
		$config["gp"]=$cd;
		$config["PV"]='OFF';
		file_put_contents('data/config.json',json_encode($config));
    }
    exit;
}elseif($data){
         Bot('editMessageText',[
        "chat_id"=>$cd,
        'message_id'=>$md,
        "text"=>"گروه رد شد",
		]);
		 Bot('leaveChat',['chat_id'=>$cd]);
        exit;
        }elseif($update->message->reply_to_message && $cd == $GP){
    $reply_text=$update->message->reply_to_message->text;
    $userid=explode('#',$reply_text)[1];
    if($text=='/ban'){
$user_id=$userid;

if(!in_array($fd,$Dev)){
    Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"فقط ادمین و مدیر میتونن بن کنن!"]);
    }elseif(strpos("$bans","$user_id\n") !== false){
 Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"کاربری با شناسه $user_id از قبل بن شده است !"]);
}elseif(Bot('sendmessage',['chat_id'=>$user_id,'text'=>"شما از ربات مسدود شدید !"])->result){
    file_put_contents("data/bans.txt","$user_id\n".$bans);
    Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"کاربری با شناسه $user_id با موفقیت مسدود شد .
#BAN"]);
}
}elseif($text=='/unban'){
$user_id=$userid;
if(!in_array($fd,$Dev)){
    Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"فقط ادمین و مدیر میتونن بن کنن!"]);
    }elseif(strpos("$bans","$user_id\n") !== false){
     Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"کاربری با شناسه $user_id آزاد شد ."]);
        	file_put_contents("data/bans.txt",str_replace("$user_id\n","",$bans));
}else{
     Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"کاربری با شناسه $user_id مسدود نیست !"]);
}
}elseif($text=='حذف' or $text=='/delete' or $text=='delete'or $text=='Delete'){
        $rid=$update->message->reply_to_message->message_id;
        $mid=explode('*',$reply_text)[1];
        if($fd!=$ADMIN){
        Bot('sendmessage',[
        "chat_id"=>$ADMIN,
        "text"=>"گزارش:
ادمین پشتیبان : $fd
دریافت کننده: $userid

پاسخ ارسالی حذف شده :",
		]);
	bot('ForwardMessage',[
	'chat_id'=>$ADMIN,
	'from_chat_id'=>$userid,
	'message_id'=>$mid
	]);
        }
	bot('DeleteMessage',[
	'chat_id'=>$userid,
	'message_id'=>$mid
	]);
	bot('DeleteMessage',[
	'chat_id'=>$GP,
	'message_id'=>$rid
	]);
	bot('DeleteMessage',[
	'chat_id'=>$GP,
	'message_id'=>$message_id
	]);

        Bot('deleteMessage',['chat_id'=>$cd,'message_id'=>$mid]);
    }elseif($userid){

$contact = $message->contact;
$stick = $message->sticker->file_id;
$vid = $message->video->file_id;
$vidn = $message->video_note->file_id;
$voi = $message->voice->file_id;
$doc = $message->document->file_id;
$photo = $message->photo;
$pic = $photo[count($photo) - 1]->file_id;
$aud = $message->audio->file_id;
$caption = $message->caption;
if($caption == true){$text = $caption;}
$fid = "$vid$doc$stick$con$voi$pic$aud$vidn";
if($doc){
    $MID=Bot('sendDocument',[
        "chat_id"=>$userid,
        "document"=>$doc,
        "caption"=>$caption])->result->message_id;
}elseif($vid){
    $MID=Bot('sendVideo',[
        "chat_id"=>$userid,
        "video"=>$vid,
        "caption"=>$caption])->result->message_id;
}elseif($aud){
    $MID=Bot('sendAudio',[
        "chat_id"=>$userid,
        "audio"=>$aud,
        "caption"=>$caption])->result->message_id;
}elseif($pic){
    $MID=Bot('sendPhoto',[
        "chat_id"=>$userid,
        "photo"=>$pic,
        "caption"=>$caption])->result->message_id;
}elseif($stick){
    $MID=Bot('sendSticker',[
        "chat_id"=>$userid,
        "sticker"=>$stick])->result->message_id;
}elseif($voi){
    $MID=Bot('sendVoice',[
        "chat_id"=>$userid,
        "voice"=>$voi,
        "caption"=>$caption])->result->message_id;
}elseif($con){
    $MID=Bot('sendContact',[
        "chat_id"=>$userid,
        "phone_number"=>$contact->phone_number,
        "first_name"=>$contact->first_name,
        "last_name"=>$contact->last_name,
        ])->result->message_id;
}elseif($vidn){
    $MID=Bot('sendvideonote',[
	'chat_id'=>$userid,
	'video_note'=>$vidn,
	])->result->message_id;
}else{
   $MID=Bot('sendmessage',[
        "chat_id"=>$userid,
        "text"=>"$textmassage",
		])->result->message_id;
}
Bot('sendmessage',[
        "chat_id"=>$chat_id,
        "text"=>"پیام شما برای #$userid# ارسال شد ✔️\nMSG-ID *$MID*"
		]);

    }else{
        Bot('sendmessage',[
        "chat_id"=>$chat_id,
        "text"=>"‼️ باید رو پیام اطلاعات کاربر Reply کرده و بصورت متنی پاسخ دهید!",
		]);
    }
}elseif($cd==$GP){

}elseif(strlen($channel1) > 4 and ($JOIN1 == 'kicked' or $JOIN1 == 'left' or $JOIN1==null) and strlen($channel2) > 4  and ($JOIN2 == 'kicked' or $JOIN2 == 'left' or $JOIN2==null)){
     Bot('sendmessage',[
        "chat_id"=>$cd,
        "text"=>"⚠️ برای استفاده از ربات باید در کانال های زیر عضو شده باشید !
🔰پس از عضویت در دو کانال زیر ربات را /start کنید:
1-📢  @$channel1
2-📢  @$channel2
",
        'reply_markup'=>json_encode(['remove_keyboard'=>true])
		]);

    }elseif( strlen($channel1) > 4 and ($JOIN1 == 'kicked' or $JOIN1 == 'left' or $JOIN1==null)){
    Bot('sendmessage',[
        "chat_id"=>$cd,
        "text"=>"⚠️ برای استفاده از ربات باید در کانال  زیر عضو شده باشید !
🔰پس از عضویت در کانال زیر ربات را /start کنید:
📢 @$channel1",
        'reply_markup'=>json_encode(['remove_keyboard'=>true])
		]);
    }elseif(strlen($channel2) > 4 and $channel1 != $channel2 and ($JOIN2 == 'kicked' or $JOIN2 == 'left' or $JOIN2==null)){
    Bot('sendmessage',[
        "chat_id"=>$cd,
        "text"=>"⚠️ برای استفاده از ربات باید در کانال  زیر عضو شده باشید !
🔰پس از عضویت در کانال زیر ربات را /start کنید:
📢 @$channel2",
        'reply_markup'=>json_encode(['remove_keyboard'=>true])
		]);
    }
	elseif($textmessage=='/id'){
    	Bot('sendmessage',[
        "chat_id"=>$cd,
        "text"=>"$fd",
		]);
}elseif($textmassage=='/start'){
   Bot('sendmessage',[
        "chat_id"=>$cd,
        "text"=>"$tstart",
        'reply_markup'=>$mkey
		]);
		$juser["fild"]["step"]="none";
$juser = json_encode($juser,true);
file_put_contents("user/$from_id.json",$juser);
}elseif($fd != $ADMIN){

if(strlen($tsend)>1)
    Bot('sendmessage',[
'chat_id'=>$cd,
'text'=>"$tsend",
'reply_to_message_id'=>$msgid
 ]);

    if($PV=='OFF'){
       $msgid=bot('ForwardMessage',[
	'chat_id'=>$GP,
	'from_chat_id'=>$cd,
	'message_id'=>$message_id
	])->result->message_id;
	Bot('sendmessage',[
'chat_id'=>$GP,
'text'=>"
فرستنده #$fd#
[نام : $firstname](tg://user?id=$fd)\n.",
'parse_mode'=>'MarkDown',
'reply_to_message_id'=>$msgid
 ]);
    }else{
        $msgid=bot('ForwardMessage',[
	'chat_id'=>$ADMIN,
	'from_chat_id'=>$cd,
	'message_id'=>$message_id
	])->result->message_id;
	Bot('sendmessage',[
'chat_id'=>$ADMIN,
'text'=>"
فرستنده #$fd#
[نام : $firstname](tg://user?id=$fd)\n.",
'parse_mode'=>'MarkDown',
'reply_to_message_id'=>$msgid
 ]);
    }
}
//#################################################################################
elseif($cd != $GP and $PV !='OFF' and $update->message->reply_to_message->message_id and $from_id == $Dev[0] and $tc == "private"){

    $reply_text=$update->message->reply_to_message->text;
    $userid=explode('#',$reply_text)[1];
     if($text=='/ban'){
$user_id=$userid;
if(!in_array($fd,$Dev)){
    Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"فقط ادمین و مدیر میتونن بن کنن!"]);
    }elseif(strpos("$bans","$user_id\n") !== false){
 Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"کاربری با شناسه $user_id از قبل بن شده است !"]);
}elseif(Bot('sendmessage',['chat_id'=>$user_id,'text'=>"شما از ربات مسدود شدید !"])->result){
    file_put_contents("data/bans.txt","$user_id\n".$bans);
    Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"کاربری با شناسه $user_id با موفقیت مسدود شد .
#BAN"]);
}
}elseif($text=='/unban'){
$user_id=$userid;
if(!in_array($fd,$Dev)){
    Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"فقط ادمین و مدیر میتونن بن کنن!"]);
    }elseif(strpos("$bans","$user_id\n") !== false){
     Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"کاربری با شناسه $user_id آزاد شد ."]);
        	file_put_contents("data/bans.txt",str_replace("$user_id\n","",$bans));
}else{
     Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"کاربری با شناسه $user_id مسدود نیست !"]);
}
}elseif($text=='حذف' or $text=='/delete' or $text=='delete'or $text=='Delete'){
        $rid=$update->message->reply_to_message->message_id;
        $mid=explode('*',$reply_text)[1];
	bot('DeleteMessage',[
	'chat_id'=>$userid,
	'message_id'=>$mid
	]);
	bot('DeleteMessage',[
	'chat_id'=>$GP,
	'message_id'=>$rid
	]);
	bot('DeleteMessage',[
	'chat_id'=>$GP,
	'message_id'=>$message_id
	]);

        Bot('deleteMessage',['chat_id'=>$cd,'message_id'=>$mid]);
    }elseif($userid){

$contact = $message->contact;
$stick = $message->sticker->file_id;
$vid = $message->video->file_id;
$vidn = $message->video_note->file_id;
$voi = $message->voice->file_id;
$doc = $message->document->file_id;
$photo = $message->photo;
$pic = $photo[count($photo) - 1]->file_id;
$aud = $message->audio->file_id;
$caption = $message->caption;
if($caption == true){$text = $caption;}
$fid = "$vid$doc$stick$con$voi$pic$aud$vidn";
if($doc){
    Bot('sendDocument',[
        "chat_id"=>$userid,
        "document"=>$doc,
        "caption"=>$caption]);
}elseif($vid){
    Bot('sendVideo',[
        "chat_id"=>$userid,
        "video"=>$vid,
        "caption"=>$caption]);
}elseif($aud){
    Bot('sendAudio',[
        "chat_id"=>$userid,
        "audio"=>$aud,
        "caption"=>$caption]);
}elseif($pic){
    Bot('sendPhoto',[
        "chat_id"=>$userid,
        "photo"=>$pic,
        "caption"=>$caption]);
}elseif($stick){
    Bot('sendSticker',[
        "chat_id"=>$userid,
        "sticker"=>$stick]);
}elseif($voi){
    Bot('sendVoice',[
        "chat_id"=>$userid,
        "voice"=>$voi,
        "caption"=>$caption]);
}elseif($con){
    Bot('sendContact',[
        "chat_id"=>$userid,
        "phone_number"=>$contact->phone_number,
        "first_name"=>$contact->first_name,
        "last_name"=>$contact->last_name,
        ]);
}elseif($vidn){
    Bot('sendvideonote',[
	'chat_id'=>$userid,
	'video_note'=>$vidn,
	]);
}else{
   Bot('sendmessage',[
        "chat_id"=>$userid,
        "text"=>"👤 پاسخ پشتیبان برای شما :

`$textmassage`",
'parse_mode'=>'MarkDown'
		]);
}
Bot('sendmessage',[
        "chat_id"=>$chat_id,
        "text"=>"پیام شما برای #$userid# ارسال شد ✔️\nMSG-ID *$MID*"
		]);

    }else{
        Bot('sendmessage',[
        "chat_id"=>$chat_id,
        "text"=>"‼️ باید رو پیام اطلاعات کاربر Reply کرده و بصورت متنی پاسخ دهید!"
		]);
    }
    //==============================================================
//panel admin
}

elseif($textmassage=="/panel" or $textmassage=="panel" or $textmassage=="مدیریت"){
if ($tc == "private" and in_array($fd,$Dev)){
Bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"🚦 ادمین عزیز به پنل مدریت ربات خوش امدید",
	  'reply_markup'=>$Akey
 ]);

}else{
Bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"$tc 1",
	  'reply_markup'=>$Akey
 ]);

}
}
elseif($textmassage=="برگشت 🔙"){
if ($tc == "private") {
if (in_array($from_id,$Dev)){
Bot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"🚦 به منوی مدیریت بازگشتید",
	  'reply_markup'=>$Akey
 ]);
$juser["fild"]["step"]="none";
$juser = json_encode($juser,true);
file_put_contents("user/$from_id.json",$juser);
}
}
}
elseif($textmassage=="⚙️ امار ربات"){
if (in_array($from_id,$Dev)){
$alluser = count(explode("\n",$stats)) - 1;
$N10=explode("\n",$stats)[10];
	$news=explode("$N10",$stats)[0];
	Bot('sendmessage',[
		'chat_id'=>$chat_id,
		'text'=>"
⚙️تعداد عضو ها : $alluser
$news
"
		]);
		}
}
elseif($juser["fild"]["step"]=="set channel" and $fd == $ADMIN){
if (in_array($from_id,$Dev)){
    $cid=$textmassage;
    $get=Bot('GetChatMember',['chat_id'=>'@'.$cid,'user_id'=>$from_id])->result->status;
    if($get or $textmassage=='0'){
        Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"📌 @$cid
✅کانال مورد نظر برای اسپانسری ثبت شد .
$get",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"]
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
 $config['channel1']=str_replace('@','',$textmassage);
 file_put_contents('data/config.json',json_encode($config));
    }else{
Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"⭕ خطا : مطمئن شوید ربات در کانال ادمین است !",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"]
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
    }
}
}elseif($juser["fild"]["step"]=="ADD ADM" and $from_id == $ADMIN){
$ID=explode('?start=',$textmassage)[1];
if(!$ID){$ID=$textmassage;}

if(strpos("$admins","$ID") !== false){
    Bot('SendMessage',['chat_id'=>"$ADMIN",'text'=>"⚠️ کاربری با این ایدی در لیست ادمین ها هست !",'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"]
	]
   ],
      'resize_keyboard'=>true
   ])]);
}elseif(Bot('SendMessage',['chat_id'=>"$ID",'text'=>'🔱 شما توسط مدیر ربات ادمین شدید !!','reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"]
	]
   ],
      'resize_keyboard'=>true
   ])])->result->message_id){
    Bot('SendMessage',['chat_id'=>"$ADMIN",'text'=>"🔰 کاربری مورد نظر ادمین شد .",'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"]
	]
   ],
      'resize_keyboard'=>true
   ])]);
    file_put_contents('data/admins',"$admins-$ID");
}else{
    Bot('SendMessage',['chat_id'=>"$ADMIN",'text'=>"⚠️خطا : مطمئن شوید ایدی وارد شده درست بوده و کاربر مورد نظر در ربات عضو باشد !",
    'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"]
	]
   ],
      'resize_keyboard'=>true
   ])]);
}
}elseif($juser["fild"]["step"]=="REM ADM" and $from_id==$ADMIN){
   if(strpos("$admins","-$textmassage") !== false and $textmassage != $ADMIN){
       $ID=$textmassage;
       $OK=Bot('SendMessage',['chat_id'=>"$ID",'text'=>'📛 شما توسط مدیر ربات برکنار شدید !!','reply_markup'=>json_encode([
    'remove_keyboard'=>true])])->result->message_id;
       if($OK){
    Bot('SendMessage',['chat_id'=>"$ADMIN",'text'=>"🔰 کاربر مورد نظر از لیست ادمین ها حذف شد !",
    'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"]
	]
   ],
      'resize_keyboard'=>true
   ])]);
   $UJS=json_decode(file_get_contents("user/$ID.json"),true);
   $UJS["fild"]['step']='none';
   file_put_contents("user/$ID.json",json_encode($UJS,true));
   $str=str_replace("-$ID",'',$admins);
   file_put_contents('data/admins',$str);
       }else{

    Bot('SendMessage',['chat_id'=>"$ADMIN",'text'=>"⚠️ خطا : ایدی فرد را کامل وارد کنید !",
    'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"]
	]
   ],
      'resize_keyboard'=>true
   ])]);
       }
   }else{
       Bot('SendMessage',['chat_id'=>"$ADMIN",'text'=>"⚠️خطا : مطمئن شوید ایدی درست وارد شده و کاربر در ربات ادمین هست ! !",
    'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"]
	]
   ],
      'resize_keyboard'=>true
   ])]);
   }
}

elseif($juser["fild"]["step"]=="set channel 2" and $fd == $ADMIN){
if (in_array($from_id,$Dev)){
    $cid=$textmassage;
    $get=Bot('GetChatMember',['chat_id'=>'@'.$cid,'user_id'=>$from_id])->result->status;
    if($get or $textmassage=='0'){
        Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"📌 @$cid
✅کانال مور نظر برای ربات ثب شد .",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"]
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
 $config['channel2']=str_replace('@','',$textmassage);
 file_put_contents('data/config.json',json_encode($config));
    }else{
Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"⭕ خطا : مطمئن شوید ربات در کانال ادمین است !",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"]
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
    }
}
}
elseif ($textmassage == '/cancel_fwd_pv'){
if (in_array($from_id,$Dev)){
    Bot('sendmessage',['chat_id'=>$chat_id,'text'=>"♻️ فروارد پیام به کاربران متوقف شد . "]);
    $send = json_decode(file_get_contents("user.json"),true);
    $send["fwd_pv"]["send"]='false';
$send = json_encode($send,true);
file_put_contents("user.json",$send);
}}
elseif ($textmassage == '/cancel_send_pv'){
if (in_array($from_id,$Dev)){
    Bot('sendmessage',['chat_id'=>$chat_id,'text'=>"♻️ ارسال پیام به کاربران متوقف شد . "]);
    $send = json_decode(file_get_contents("user.json"),true);
    $send["pv"]["send"]='false';
$send = json_encode($send,true);
file_put_contents("user.json",$send);
}}elseif ($textmassage == '➕افزودن ادمین' ) {
if ($from_id==$ADMIN){
         Bot('sendmessage',[
          'chat_id'=>$chat_id,
          'text'=>"📟 ایدی عددی یا ایدی /id فرد را ارسال کنید :
🖱 مثال :
123456789
",
    'reply_to_message_id'=>$message_id,
     'reply_markup'=>json_encode([
    'keyboard'=>[
  [
  ['text'=>"برگشت 🔙"]
  ]
   ],
      'resize_keyboard'=>true
   ])
 ]);
$juser["fild"]["step"]="ADD ADM";
$juser = json_encode($juser,true);
file_put_contents("user/$from_id.json",$juser);
}else{
Bot('sendmessage',[
          'chat_id'=>$chat_id,
          'text'=>"🔐 شما به این بخش دسترسی ندارید !",
    'reply_to_message_id'=>$message_id,
     'reply_markup'=>json_encode([
    'keyboard'=>[
  [
  ['text'=>"برگشت 🔙"]
  ]
   ],
      'resize_keyboard'=>true
   ])
 ]);
}
}####################################
elseif ($textmassage == '➖حذف ادمین' ) {
if ($from_id==$ADMIN){
$LIST=str_replace("$ADMIN",'',$admins);
$LIST=str_replace("-","\n",$LIST);
         Bot('sendmessage',[
          'chat_id'=>$chat_id,
          'text'=>"🔏 ایدی عددی ادمین مورد نظر را ارسال کنید
📋 لیست ادمین ها :
$LIST",
    'reply_to_message_id'=>$message_id,
     'reply_markup'=>json_encode([
    'keyboard'=>[
  [
  ['text'=>"برگشت 🔙"]
  ]
   ],
      'resize_keyboard'=>true
   ])
 ]);
$juser["fild"]["step"]="REM ADM";
$juser = json_encode($juser,true);
file_put_contents("user/$from_id.json",$juser);
}else{
Bot('sendmessage',[
          'chat_id'=>$chat_id,
          'text'=>"🔐 شما به این بخش دسترسی ندارید !",
    'reply_to_message_id'=>$message_id,
     'reply_markup'=>json_encode([
    'keyboard'=>[
  [
  ['text'=>"برگشت 🔙"]
  ]
   ],
      'resize_keyboard'=>true
   ])
 ]);
}
}elseif ($textmassage == '📢 ثبت کانال یک' and $fd == $ADMIN){
if (in_array($from_id,$Dev)){
 if($channel){$chanel=='-None-';}
         Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"📣 آدرس کانال فعلی
@$channel1
⚠️توجه ! قبل ارسال آیدی کانال ، ربات را ادمین کنید !
🔰 خب حالا آیدی کانال رو بدون @ ارسال کن :

❌ حذف و لغو کانال انتخاب شده با ارسال عدد انگلیسی : 0",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"]
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
$juser["fild"]["step"]="set channel";
$juser = json_encode($juser,true);
file_put_contents("user/$from_id.json",$juser);
}
}elseif ($textmassage == '🕹 خاموش / روشن کردن ربات' and $fd == $ADMIN){
if (in_array($from_id,$Dev)){

    if($DUTY=='OFF'){
        Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"🟢 ربات روشن شد",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"]
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);

 $config['duty']='ON';
 file_put_contents('data/config.json',json_encode($config));

    }else{
        Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"⚫️ ربات خاموش شد",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"]
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);

 $config['duty']='OFF';
 file_put_contents('data/config.json',json_encode($config));
    }

$juser["fild"]["step"]="set channel";
$juser = json_encode($juser,true);
file_put_contents("user/$from_id.json",$juser);
}
}
elseif ($textmassage == '📝 متن استارت' and $fd == $ADMIN){
if (in_array($from_id,$Dev)){
         Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"متن جدید استارت /start را ارسال کنید :",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"]
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
$juser["fild"]["step"]="set tstart";
$juser = json_encode($juser,true);
file_put_contents("user/$from_id.json",$juser);
}
}elseif ($juser["fild"]["step"] == 'set tstart') {
    $button=str_replace("\n",' ',$text);
    if(strlen($button)>1000){
        Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"متن استارت بسیار طولانی است ! \n متن کوتاه تری انتخاب کنید!",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"]
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
    }elseif ($text and $textmassage != "برگشت 🔙"){
         Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"متن استارت تنظیم شد✔️",
	  'reply_to_message_id'=>$message_id,
 ]);

$mjson["start"]="$text";
file_put_contents("data/m.json",json_encode($mjson));
}}elseif ($textmassage == '📝 متن دکمه راهنما' and $fd == $ADMIN){
if (in_array($from_id,$Dev)){
         Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"اسم دکمه راهنما چی باشه ؟",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"]
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
$juser["fild"]["step"]="set bh";
$juser = json_encode($juser,true);
file_put_contents("user/$from_id.json",$juser);
}
}elseif ($juser["fild"]["step"] == 'set bh') {
    $button=str_replace("\n",' ',$text);
    if(strlen($button)>55){
        Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"اسم دکمه باید کمتر از 25 حرف فارسی باشد !",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"]
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
    }elseif ($text and $textmassage != "برگشت 🔙"){
         Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"اسم دکمه ثبت شد حالا وقتی کاربر دکمه رو زد چه پیامی به کاربر ارسال شه",
	  'reply_to_message_id'=>$message_id,
 ]);
$juser["fild"]["step"]="set bh2";
$juser = json_encode($juser,true);
file_put_contents("user/$from_id.json",$juser);
$mjson["bhelp"]="$text";
file_put_contents("data/m.json",json_encode($mjson));
}
}elseif ($juser["fild"]["step"] == 'set bh2') {
    if(strlen($text)>1000){
        Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"متن ارسال شده بیش از حد طولانی هست !
متن مورد نظر خود را خلاصه کنید!",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"]
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
    }elseif ($text and $textmassage != "برگشت 🔙"){
         Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"دکمه $bhelp با موفقیت راه اندازی شد ",
	  'reply_to_message_id'=>$message_id,
	  'reply_markup'=>$Akey
 ]);
$juser["fild"]["step"]="none";
$juser = json_encode($juser,true);
file_put_contents("user/$from_id.json",$juser);
$mjson["help"]="$text";
file_put_contents("data/m.json",json_encode($mjson));
}
}
################################################################################
elseif ($textmassage == '📝 متن دکمه درباره' and $fd == $ADMIN){
if (in_array($from_id,$Dev)){
         Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"اسم دکمه درباره چی باشه ؟",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"]
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
$juser["fild"]["step"]="set ba";
$juser = json_encode($juser,true);
file_put_contents("user/$from_id.json",$juser);
}
}elseif ($juser["fild"]["step"] == 'set ba') {
    $button=str_replace("\n",' ',$text);
    if(strlen($button)>55){
        Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"اسم دکمه باید کمتر از 25 حرف فارسی باشد !",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"]
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
    }elseif ($text and $textmassage != "برگشت 🔙"){
         Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"اسم دکمه ثبت شد حالا وقتی کاربر دکمه رو زد چه پیامی به کاربر ارسال شه",
	  'reply_to_message_id'=>$message_id,
 ]);
$juser["fild"]["step"]="set ba2";
$juser = json_encode($juser,true);
file_put_contents("user/$from_id.json",$juser);
$mjson["babout"]="$text";
file_put_contents("data/m.json",json_encode($mjson));
}
}elseif ($juser["fild"]["step"] == 'set ba2') {
    if(strlen($text)>1000){
        Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"متن ارسال شده بیش از حد طولانی هست !
متن مورد نظر خود را خلاصه کنید!",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"]
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
    }elseif ($text and $textmassage != "برگشت 🔙"){
         Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"دکمه $babout با موفقیت راه اندازی شد ",
	  'reply_to_message_id'=>$message_id,
	  'reply_markup'=>$Akey
 ]);
$juser["fild"]["step"]="none";
$juser = json_encode($juser,true);
file_put_contents("user/$from_id.json",$juser);
$mjson["about"]="$text";
file_put_contents("data/m.json",json_encode($mjson));
}
}
################################################################################
elseif ($textmassage == '📝 متن پیام ارسال شد' and $fd == $ADMIN){
if (in_array($from_id,$Dev)){
         Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"متن جدید پیغام ارسال شدن پیام کاربران را ارسال کنید\n\nجهت نمایش ندادن پیغام عدد انگلیسی 0 را ارسال کنید.",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"]
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
$juser["fild"]["step"]="set tsend";
$juser = json_encode($juser,true);
file_put_contents("user/$from_id.json",$juser);
}
}elseif ($juser["fild"]["step"] == 'set tsend') {
    $button=str_replace("\n",' ',$text);
    if(strlen($button)>100){
        Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"متن پیغام بسیار طولانی است ! \n متن کوتاه تری انتخاب کنید!",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"]
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
    }elseif ($textmassage != "برگشت 🔙"){
         Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"متن پیغام ارسال پیام تنظیم شد✔️",
	  'reply_to_message_id'=>$message_id,
 ]);

$mjson["send"]="$text";
file_put_contents("data/m.json",json_encode($mjson));
}
}

elseif ($textmassage == '📢 ثبت کانال دو' and $fd == $ADMIN){
if (in_array($from_id,$Dev)){
 if($channel){$chanel=='-None-';}
         Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"📣 آدرس کانال فعلی
@$channel2
⚠️توجه ! قبل ارسال آیدی کانال ، ربات را ادمین کنید !
🔰 خب حالا آیدی کانال رو بدون @ ارسال کن :

❌ حذف و لغو کانال انتخاب شده با ارسال عدد انگلیسی : 0
",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"]
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
$juser["fild"]["step"]="set channel 2";
$juser = json_encode($juser,true);
file_put_contents("user/$from_id.json",$juser);
}
}
elseif ($textmassage == '📭 ارسال به کاربران' ) {
if (in_array($from_id,$Dev)){
         Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"لطفا متن خود را ارسال کنید 🚀",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"]
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
$juser["fild"]["step"]="sendtoall";
$juser = json_encode($juser,true);
file_put_contents("user/$from_id.json",$juser);
}
}
elseif ($juser["fild"]["step"] == 'sendtoall') {
if ($textmassage != "برگشت 🔙") {
         Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"پیام شما با موفقیت برای ارسال همگانی تنظیم شد  ✔️",
	  'reply_to_message_id'=>$message_id,
 ]);
$inuser = json_decode(file_get_contents("user.json"),true);
$inuser["pv"]["text"]="$textmassage";
$inuser["pv"]["tag"]=time();
$inuser["pv"]["send"]="true";
$inuser["pv"]["start"]="0";
$inuser["pv"]["sender"]="$from_id";
$inuser = json_encode($inuser,true);
file_put_contents("user.json",$inuser);
$juser["fild"]["step"]="none";
$juser = json_encode($juser,true);
file_put_contents("user/$from_id.json",$juser);
}
}

elseif ($textmassage == '📭 فروارد به کاربران' ) {
if (in_array($from_id,$Dev)){
         Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"لطفا متن خود را فروارد کنید  🚀",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"]
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
$juser["fild"]["step"]="fortoall";
$juser = json_encode($juser,true);
file_put_contents("user/$from_id.json",$juser);
}
}
elseif(preg_match('/^\/(ban )/',$text) and in_array($from_id,$Dev)){
$user_id=explode(' ',$text)[1];
if(strpos("$bans","$user_id\n") !== false){
 Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"کاربری با شناسه $user_id از قبل بن شده است !"]);
}elseif(Bot('sendmessage',['chat_id'=>$user_id,'text'=>"شما از ربات مسدود شدید !"])->result){
    file_put_contents("data/bans.txt","$user_id\n".$bans);
    Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"کاربری با شناسه $user_id با موفقیت مسدود شد .
#BAN"]);
}else{
     Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"در ربات کاربری با شناسه $user_id پیدا نشد !"]);
}
}elseif(preg_match('/^\/(unban )/',$text) and in_array($from_id,$Dev)){
$user_id=explode(' ',$text)[1];
if(strpos("$bans","$user_id\n") !== false){
     Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"کاربری با شناسه $user_id آزاد شد ."]);
        	file_put_contents("data/bans.txt",str_replace("$user_id\n","",$bans));
}else{
     Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"کاربری با شناسه $user_id مسدود نیست !"]);
}
}elseif( ($text== "/ban" or $text== "/ubban" or $text== "📓 لیست کاربران سیاه") and in_array($from_id,$Dev)){
    Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"آخرین افراد لیست سیاه :
$bans=======|اتمام لیست|========
راهنمای بن کردن :
/ban <USER-ID>
راهنمای آنبن / آزاد کردن :
/unban <USER-ID>

مثال ها :
/ban 123456789
/unban 123456789"]);
}
elseif ($juser["fild"]["step"] == 'fortoall'){
if ($textmassage != "برگشت 🔙") {
         Bot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"پیام شما با موفقیت به عنوان فروارد همگانی تنظیم شد ✔️",
	  'reply_to_message_id'=>$message_id,
 ]);
$inuser = json_decode(file_get_contents("user.json"),true);
$inuser["fwd_pv"]['fid']="$message_id";
$inuser["fwd_pv"]['fcd']="$chat_id";
$inuser["fwd_pv"]['tag']=time();
$inuser["fwd_pv"]['start']="0";
$inuser["fwd_pv"]['sender']="$from_id";
$inuser["fwd_pv"]['send']="true";
$inuser = json_encode($inuser,true);
file_put_contents("user.json",$inuser);
$juser["fild"]["step"]="none";
$juser = json_encode($juser,true);
file_put_contents("user/$from_id.json",$juser);
}
}

######################################
if(file_exists('error_log')) unlink('error_log');
}
######################################
#EzPick.iR
#ایزی پیک انتخابی آسان برای شما
#####################################
?>
