<html>


<!--

██████╗ ███████╗████████╗   ████████╗██╗    ██╗███████╗███████╗████████╗
██╔════╝ ██╔════╝╚══██╔═╝   ╚══██╔══╝██║    ██║██╔════╝██╔════╝╚══██╔══╝
██║  ███╗█████╗     ██║ █████╗ ██║   ██║ █╗ ██║█████╗  █████╗     ██║
██║   ██║██╔══╝     ██║ ╚════╝ ██║   ██║███╗██║██╔══╝  ██╔══╝     ██║
╚██████╔╝███████╗   ██║        ██║   ╚███╔███╔╝███████╗███████╗   ██║
 ╚═════╝ ╚══════╝   ╚═╝        ╚═╝    ╚══╝╚══╝ ╚══════╝╚══════╝   ╚═╝

-->
<head>
</head>
<body>
  <?php
    // jsonのパス
    define( "FILE_NAME", "XXXXXXXXXXXXX.json" );
    $filename = 'XXXXXXXXXXXXX.json';
    // jsonを生成するタイミング(1時間)
    $check_minute = 60 * 60;

    // ファイルの存在を確認
    if (file_exists(FILE_NAME)) {
      $file_time = filemtime(FILE_NAME);
      $cur_time = time();
      $dif_time = $cur_time - $file_time;

      if ($check_minute < $dif_time) {
        get_tweet();
      }
    } else {
      get_tweet();
    }

    function get_tweet() {
      //twitter認証
      $consumerKey = "XXXXXXXXXXXXX";
      $consumerSecret = "XXXXXXXXXXXXX";
      $accessToken = "XXXXXXXXXXXXX";
      $accessTokenSecret = "XXXXXXXXXXXXX";

      //TwitterOAuth認証
      require_once('twitteroauth/twitterOAuth.php');
      $twObj = new TwitterOAuth($consumerKey, $consumerSecret, $accessToken, $accessTokenSecret);

      //取得するときのオプションを設定
      $options = array(
        "count" => 100, //取得するツイート数
      );

      $tlRequest=$twObj->OAuthRequest(
        "https://api.twitter.com/1.1/statuses/home_timeline.json",
        "GET",
        $options
      );
      //オープン
      $fp = fopen(FILE_NAME,'w+');
      //jsonを上書き
      fwrite($fp, $tlRequest);
      //クローズ
      fclose($fp);
    }
  ?>
<body>
</html>
