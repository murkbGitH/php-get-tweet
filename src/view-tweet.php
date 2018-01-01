<html>


<!--

██╗   ██╗██╗███████╗██╗    ██╗   ████████╗██╗    ██╗███████╗███████╗████████╗
██║   ██║██║██╔════╝██║    ██║   ╚══██╔══╝██║    ██║██╔════╝██╔════╝╚══██╔══╝
██║   ██║██║█████╗  ██║ █╗ ██║█████╗██║   ██║ █╗ ██║█████╗  █████╗     ██║
╚██╗ ██╔╝██║██╔══╝  ██║███╗██║╚════╝██║   ██║███╗██║██╔══╝  ██╔══╝     ██║
 ╚████╔╝ ██║███████╗╚███╔███╔╝      ██║   ╚███╔███╔╝███████╗███████╗   ██║
  ╚═══╝  ╚═╝╚══════╝ ╚══╝╚══╝       ╚═╝    ╚══╝╚══╝ ╚══════╝╚══════╝   ╚═╝

-->
<head>
</head>
<body>
  <!--twitter_wrap-->
  <div id="twitter_wrap">
    <div id="twitter_area" class="clearfix">
    <?php
      // ファイルからJSONを読み込み
      $json = file_get_contents("XXXXXXXXXXXXX.json");
      // 文字化けするかもしれないのでUTF-8に変換
      $json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
      // オブジェクト毎にパース
      // trueを付けると連想配列として分解して格納してくれます。
      $oObj = json_decode($json, true);
      // パースに失敗した時は処理終了
      if ($oObj === NULL) {
        echo 'エラー';
        return;
      }
      // 表示
      if (!empty($oObj)) {
        foreach($oObj as $key => $val){
          $name = $oObj[$key]['user']['name'];
          $screen_name = $oObj[$key]['user']['screen_name'];
          $text = $oObj[$key]['text'];
          // パターン
          $pattern = '/((?:https?|ftp):\/\/[-_.!~*\'()a-zA-Z0-9;\/?:@&=+$,%#]+)/u';
          // 置換後の文字列
          $replacement = '<a href="\1"  target="_blank">\1</a>';
          // 置換
          $text = preg_replace($pattern,$replacement,$text);
          echo'<div class="twitter_box">';
            if (empty($oObj[$key]['extended_entities']['media'][0]['media_url'])) { // Twitterでアップした画像がなければ
            } else { // Twitterでアップした画像があれば
              echo '<div style="width:100%; height:100%; margin:0 auto; background:url('.$oObj[$key]['extended_entities']['media'][0]['media_url'].') no-repeat center top; background-size: cover;"></div>';
              echo '<img src="'.$oObj[$key]['extended_entities']['media'][0]['media_url'].'" alt="'.$oObj[$key]['extended_entities']['media'][0]['media_url'].'" width="100%">';
            }
            echo'<dl>';
              echo'<dt><a href="https://twitter.com/'.$screen_name.'" target="_blank">'.$name.'</a></dt>';
              echo'<dd>'.$text.'</dd>';
            echo'</dl>';
          echo'</div>';
        }
      }
    ?>
    </div>
  </div>
  <!--//twitter_wrap-->
<body>
</html>
