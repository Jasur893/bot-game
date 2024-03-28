<?php
session_start();
date_default_timezone_set('Asia/Tashkent');

const API_KEY = "7082582670:AAGf28rhjU9yy4duHpZTK6-ZsAQ2pM7G4Ak";

// admin akkaunti id raqamini ushbu bot orqali bilishingiz mumkin @infomiruz_idbot
$admin = "1078608772";
$system_pass = '123';
//$my_group =   "-1002103718377"; // assosiy superGroup
$logging = true;


$share_btn = [
    'share_btn' => "Do'stlarni taklif qilish 👨🏿‍🤝‍👨🏾",
    'share_text' => "😍😎 Salom, biz dostlarimiz bilan yangi guruhda, sovgalar oyinini tashkil etdik, omadingizni sinab kormaysizmi ?!",
    'share_link' => "https://t.me/My9393Bot"
];
$db_mysql  = [
    'status' => false,
    'host' => "localhost",
    'name' => "game_bot",
    'user' => "root",
    "pass" => ""
];
$comands = [
    [
        'commands' => json_encode([
            ['command' => "/info", 'description' => "Bot faoliyati haqida."],
            ['command' => "/start", 'description' => "Botni qayta ishga tushirish."],
            ['command' => "/startgame", 'description' => "Mavjud barcha o'yinlar."],
        ]),
        'scope' => json_encode([
            'type' => "chat",
            'chat_id' => $admin
        ])
    ],
    [
        'commands' => json_encode([ // guruhlarda adminlar uchun
            ['command' => "/start", 'description' => "Botni qayta ishga tushirish."],
            ['command' => "/startgame", 'description' => "Mavjud barcha o'yinlar."],
        ]),
        'scope' => json_encode([
            'type' => "all_private_chats"
        ])
    ]
];
$games_list = [
    [
        'list_text' => "Mevalar kartasi ✌️",
        'short_name' => "cards",
        'url' => "https://74ba-94-232-25-6.ngrok-free.app/games/cards/"
    ],
    [
        'list_text' => "Omadshou Virtual 🏵",
        'short_name' => "omadshou",
        'url' => "https://74ba-94-232-25-6.ngrok-free.app/games/omadshou/"
    ],
    [
        'list_text' => "Temple Run 2 🏵",
        'short_name' => "temple_run",
        'url' => "https://poki.com/en/g/temple-run-2"
    ],
];

$games_name_list = [];
foreach ($games_list as $game) {
    array_push($games_name_list, $game['short_name']);
}