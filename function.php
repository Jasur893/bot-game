<?php
function dump($what)
{
    echo '<pre>';
        print_r($what);
    echo '</pre>';
}

function json($arr)
{
    return json_encode($arr, JSON_PRETTY_PRINT);
}

function bot($method = "getMe", $params = [])
{
    $url = "https://api.telegram.org/bot". API_KEY . "/" . $method;
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
//        CURLOPT_SSL_VERIFYPEER => false,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => $params,
//        CURLOPT_HTTPHEADER => ['Content-Type: multipart/form-data'] php7.0 da olib tashlangan, o'rniga new CurlFile ishlatish kerak
    ]);

    $res = curl_exec($curl);
    curl_close($curl);
    if (!curl_error($curl)) return json_decode($res, true);
}

function html($text)
{
    return str_replace(['<', '>'], ['&#60', '&#62'], $text);
}

function reformat($json)
{
    return json_encode(json_decode($json, true), JSON_PRETTY_PRINT);
}

if($logging){
    if(file_get_contents('php://input')){
        file_put_contents("log.json",reformat(file_get_contents('php://input')));
    };
};

function bot_info($revoke = false)
{
    global $admin, $system_pass;
    $admin_info = bot('getChat', ['chat_id' => $admin]);
    $channel = bot('getChat', ['chat_id' => $my_channel]);
    $group = bot('getChat', ['chat_id' => $my_group]);
    $cms_url = str_replace("app.php", "index.php", "https://".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI']);
    $hook_url = "https://".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI'];

    return "Bot haqida ma'lumot:
        👨‍💻Tizim admini: <a href='tg://user?id=".$admin."'>@".$admin_info['result']['first_name']."</a>.
        ⚙️Bot Web CMS: <a href='".$cms_url."'>Web interface</a>.
        🔑CMS paroli: <tg-spoiler>".$system_pass."</tg-spoiler>👁.
        📑Bot dasturi manzili:
        <code>".$hook_url."</code>";
}


function delete($params = [])
{
    if ($params['chat_id'] && $params['mess_id']) {
        return bot('deleteMessage', [
           'chat_id' =>  $params['chat_id'],
            'message_id' => $params['mess_id']
        ]);
    }
}


