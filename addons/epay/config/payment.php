<?php

return [
    'alipay' => [
        'app_id'         => '2018091361391297',
        'notify_url'     => '/addons/epay/api/notify/type/alipay', //请勿修改此配置
        'return_url'     => '/addons/epay/api/returnx/type/alipay', //请勿修改此配置
        'ali_public_key' => 'MIIBIjANBgkqhkiG9w0BAQEFAAOCAQ8AMIIBCgKCAQEAwUIGwCYwc/t9hAsOwvgWmyB/U6IIpGtgrNqx6YqDjB55tJhpJ+MhtzjeFzIX+G1vg/GGgK/Adb5gJajZ/HzjUuuqpFEvlt73OijmGw0ZFTfj5ymna23Sb5mXDVckfuXbXVP6/P61J/QGBBLx+8ZjKwiGcSg8s7vHPHHTil28X6IMvFiVfOPmNm8HENqRn7t2TDHqxiF9Xu+2FvxXCCZo8/miVGuWsP0lQup+srhIYqy2+L2Yy8zhvoQBJLZhhBqV0tyAKIoudxGWb5Hm/aFL0M3aJ9Ufk0XNq1HyuE0VyGobXqti3SkNLht+jL8fDDo4o5Ug0Ts68c6tQKaAtL7lKQIDAQAB',
        // 加密方式： **RSA2**
        'private_key'    => 'MIIEpAIBAAKCAQEArCIb1oQcQF7QW9cL/GcoIqjAen4FuICco4fb52KwUhxs1Rfv613/BYI1SCgn+uiVtCLvhCFvtupi08j56Biw5fViRRjWY5B71ClFeXguPea+4qQi8lvBh/dXB+Y4FEH9aoZG81yksznlsWWFlcrs8xD94V5KVxhxL2+EPEXAcGFSUcCCmiST7hI9KtC8XPBNMJf2lMzemKMpDOCSHhheA3LmMEia1CwHHEDS9eHPkBns5TQic32e0rBq9gl6o9VMD45YGnJsR8t2eF5kDY9Jpf7KwBDYyBJu/ZmBMOBPC2t9Mkg7qLg6HY74dFS/7pWEww+D/8eyFCJRFLzvJGnx/wIDAQABAoIBAE/LD/SFEUOVsCiiq1+5whUu/OrLeINquzHjTMEaMnodyyWNDx6gWBOJpIFqe/4Hyz3R5A3wIgU86csbIx3ANGClO4SkWt2UoJJc/2OrnmP7jwko5TpL5o7MzX9P7TcW0A6NaF5v17ltYVi2oxIpG2Yhvk62kueE4RMIMthtzSNKduZLf9VN6n3PH8FGL+cXGoAW3ZbKKxmKQmHLfdRVMCCZy0rM6f5VwXC2gdn5vJlIDSlMi+37KWo70j52xxiCW+P4FFhyswA940DAxqkh5D90vIILDAt88o00YVZPYf77ercTelPDL/GczBYBEVuP9dMwND/9VFN48XABx55ie0ECgYEA4dcxvpi/dKni1rjH9LJOU6mhw4GGdVwW8VO4opXYriuRkixQR+ypTSt117OWwtvZHs4/MO2/CtldV0reIPXcLrBe+WL0J1KH6ch9RlSH0W76DMUfuW2c3hvUAGOlEvutzmHVBkWG03kYdkcNZpl8JYfNimlZPDz4qUCBHqscJekCgYEAwx7SiABV2tg+Yuclyo30+up8M7Om7iSsEiPjaevtRVmIT35sb4cC6eJMshyuKI3J5ut+sOtxu4iQ9S3F4YW3JeFCG6uaWfdP/dEuV6XhGZ+Z5KbZI79eKBIU7Xtrf+R7tIXW3dMefn/z4cc9YJLwcNVYoWBaZwC+5lisMdEGH6cCgYBmS2f/0gZenJjf86C2qJEr+hkIikHSJN1LgEWQd1lHQvrT//h5K6xgBQCCrJjsOFK3Tmp3CilPi7do08OboGGUUFUklvrKWOqxLRv5YE6IwcDHSf6dqhW00VwMtRXPbGqEofGwvotcfGxlHrfmMj12bnXebOt7io6Dc3FI5+5/CQKBgQCB0HXdSevU593Jy2NXOc7tSShM9Y9wDTH1966LgA2iAAkyajgWk0qa9JZ2QaKVFJBpc/AcIOjQDfHzTPrEKkRJjW6AHlFY3bN4eL1OTuxOMeMfPupkYCNyoWUPAvfoZMjwt8LWXmmBW/uUEQyCvf/98dM/um0q7lITypb1pc1fLQKBgQC6UmiS7xiVznohnYiPVzXG6Lk/e77rLfMg5fKw+VF04oaQtD7cSyYRutBdtUasmlV0RkaAn+86A4rpMUkPs6AGaEkAhGT3o+kru/xQIuPwNq7k/ylEv4irwS2RuXI6COI78rKoZ872lyo4d+/5vF8fzguQ8SJBAaNIRAmCGCJcuw==',
        'log'            => [
            // optional
            'file'  => LOG_PATH . '/epaylogs/alipay-' . date("Y-m-d") . '.log',
            'level' => 'debug'
        ],
        'mode'           => 'dev', // optional,设置此参数，将进入沙箱模式
    ],
    'wechat' => [
        'appid'       => 'wxfa09a960eab21750', // APP APPID
        'app_id'      => 'wxfa09a960eab21750', // 公众号 APPID
        'miniapp_id'  => 'wxb3fxxxxxxxxxxx', // 小程序 APPID
        'mch_id'      => '1497378702', //支付商户ID
        'key'         => 'de3f539619038cf782c1d3f141aead4a',
        'notify_url'  => '/addons/epay/api/notify/type/wechat', //请勿修改此配置
        'cert_client' => ADDON_PATH . '/epay/certs/apiclient_cert.pem', // optional, 退款，红包等情况时需要用到
        'cert_key'    => ADDON_PATH . '/epay/certs/apiclient_key.pem',// optional, 退款，红包等情况时需要用到
        'log'         => [
            // optional
            'file'  => LOG_PATH . '/epaylogs/wechat' . date("Y-m-d") . '.log',
            'level' => 'debug'
        ],
    ]
];