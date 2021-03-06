<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>KPS - 慶應ピアノソサイエティー</title>

  <link rel="shortcut icon" type="image/png" href="assets/img/brand.png">

  <meta property="og:title" content="KPS - 日本語も美しく表示できるBootstrapテーマ">
  <meta property="og:type" content="website">
  <meta property="og:url" content="http://honokak.osaka/">
  <meta property="og:image" content="http://honokak.osaka/assets/img/sample.png">
  <meta property="og:description" content="Honokaは日本語表示に最適化されたオリジナルBootstrapテーマです。">

  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:site" content="@MITLicense">
  <meta name="twitter:creator" content="@MITLicense">
  <meta name="twitter:title" content="KPS - 日本語も美しく表示できるBootstrapテーマ">
  <meta name="twitter:image" content="http://honokak.osaka/assets/img/sample.png">
  <meta name="twitter:description" content="Honokaは日本語表示に最適化されたオリジナルBootstrapテーマです。">

  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="assets/css/rild.css">
  <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

  <!--[if lt IE 9]>
    <script src="//oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>
<body>

  <header>
    <div class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a href="/~j140098t/kps_honoka/" class="navbar-brand">KPS</a>
          <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
          <ul class="nav navbar-nav">
            <li><a href="#">Top</a></li>
            <li><a href="#concert">Concert</a></li>
            <!-- <li><a href="#">Blog</a></li>
            <li><a href="#">Portpolio</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="#">Help</a></li> -->
          </ul>
          <!-- search -->
          <ul class="nav navbar-nav navbar-right">
            <li><a href="php/users/signin/login.php">Member's Link</a></li>
          </ul>
        </div>
      </div>
    </div>
  </header>

  <div class="jumbotron special">
    <div class="piano"></div>
    <div class="container">
      <div class="row">
        <div class="col-xs-12 outline">
          <h1>Staging Test HP</h1>
          <h1>for</h1>
          <h1>慶應ピアノソサィエティー</h1>
          <p>理工学部実験で試験的に作られたサイトです。</p>
          <!-- <div class="download">
            <a href="//github.com/windyakin/Honoka/releases" class="btn btn-warning btn-lg"><i class="fa fa-github-alt"></i> Download from GitHub</a>
            <a href="/bootstrap-ja.html" class="btn btn-primary btn-lg"><i class="fa fa-play"></i> Watch Demo</a>
          </div> -->
          <div class="basedon small">
            <span class="last-version"></span> ・ KPSは <a href="http://www.gakuji.keio.ac.jp/life/dantai/">文連</a> に加盟している慶應の公認学生団体です
          </div>
        </div>
      </div>
    </div>
  </div>


  <section class="section section-default" id="intro">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 subtitle">
          <h1>ようこそ慶應ピアノソサイエティへ</h1>
          <p>Welcome to Keio Piano Society</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-center">
          <p>アカウントを持っていない場合は、サイトの管理者にご連絡ください。</p>
        </div>
      </div>
    </div>
  </section>

  <section class="section section-inverse" id="concert">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 subtitle">
          <h1>演奏会情報</h1>
          <p>最新の演奏会情報を掲載しています。</p>
        </div>
      </div>
      <div class="row">

<?php
$local_endpoint = "http://localhost/kps_honoka/";
$staging_endpoint = "http://131.113.100.213/~j140098t/kps_honoka/";
$endpoint = $staging_endpoint;
$path = "php/main/concert/";

$database = "j140098t";

$db_conn = pg_connect ("host=localhost dbname=$database user=j140098t");

if (!$db_conn) {
  echo "Failed connecting to postgres database $database\n";
  exit;
}

$qu = pg_query($db_conn, "SELECT c.concert_id, c.concert_name, h.hall_name, c.concert_year, c.concert_month, c.concert_day,
  c.concert_begin_time_hour, c.concert_begin_time_min, c.concert_open_time_hour, c.concert_open_time_min
  FROM kps_concert c, kps_hall h where c.concert_hall = h.hall_id order by c.concert_id desc");

$i = 0;
while ($data = pg_fetch_object($qu)) {
    if ($i > 2) break;
    $date = $data->concert_year.'/'.str_pad($data->concert_month, 2, 0, STR_PAD_LEFT).'/'.str_pad($data->concert_day, 2, 0, STR_PAD_LEFT);
    $begin = str_pad($data->concert_begin_time_hour, 2, 0, STR_PAD_LEFT).':'.str_pad($data->concert_begin_time_min, 2, 0, STR_PAD_LEFT);
    $open = str_pad($data->concert_open_time_hour, 2, 0, STR_PAD_LEFT).':'.str_pad($data->concert_open_time_min, 2, 0, STR_PAD_LEFT);

echo <<< EOD
          <div class="col-md-4">
          <div class="panel panel-info">
            <div class="panel-heading">
              <h3 class="panel-title">$data->concert_name</h3>
            </div>
            <div class="panel-body">
            <div class="bs-component">
              <div class="panel panel-default">
                <div class="panel-body">
                  $data->hall_name
                </div>
              </div>
              <ul class="list-group">
                <li class="list-group-item">
                  <span class="badge">$date</span>
                  開催日
                </li>
                <li class="list-group-item">
                  <span class="badge">$begin</span>
                  開場
                </li>
                <li class="list-group-item">
                  <span class="badge">$open</span>
                  開演
                </li>
              </ul>
            </div>
            </div>
          </div>
          </div>
EOD;
$i++;
  }

pg_free_result($qu);
pg_close($db_conn);

?>

      </div>
    </div>
  </section>

  <!-- <section class="section section-default" id="intro">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 subtitle">
          <h1>ようこそ慶應ピアノソサイエティへ</h1>
          <p>Welcome to Keio Piano Society</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-center">
          <p>アカウントを持っていない場合は <a href="//github.com/windyakin/Honoka#readme">README</a> または <a href="//github.com/windyakin/Honoka/wiki">Wiki</a> をご確認ください</p>
        </div>
      </div>
    </div>
  </section>

  <section class="section section-inverse" id="concert">
    <div class="container">
      <div class="row">
        <div class="col-xs-12 subtitle">
          <h1>ようこそ慶應ピアノソサイエティへ</h1>
          <p>Welcome to Keio Piano Society</p>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-center">
          <p>アカウントを持っていない場合は <a href="//github.com/windyakin/Honoka#readme">README</a> または <a href="//github.com/windyakin/Honoka/wiki">Wiki</a> をご確認ください</p>
        </div>
      </div>
    </div>
  </section>

  <section class="section section-default" id="contact">
    <div class="container">
    <div class="bs-docs-section">
      <div class="row">
        <div class="col-lg-12">
          <div class="page-header">
            <h1 id="forms">Contact</h1>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-6">
          <div class="well bs-component">
            <form class="form-horizontal">
              <fieldset>
                <legend>Forms</legend>
                <div class="form-group">
                  <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                  <div class="col-lg-10">
                    <input type="text" class="form-control" id="inputEmail" placeholder="Email">
                  </div>
                </div>
                <div class="form-group">
                  <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                  <div class="col-lg-10">
                    <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                    <div class="checkbox">
                      <label>
                        <input type="checkbox"> Checkbox
                      </label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="textArea" class="col-lg-2 control-label">Textarea</label>
                  <div class="col-lg-10">
                    <textarea class="form-control" rows="3" id="textArea"></textarea>
                    <span class="help-block">A longer block of help text that breaks onto a new line and may extend beyond one line.</span>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-lg-2 control-label">Radios</label>
                  <div class="col-lg-10">
                    <div class="radio">
                      <label>
                        <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
                        Option one is this
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                        Option two can be something else
                      </label>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="select" class="col-lg-2 control-label">Selects</label>
                  <div class="col-lg-10">
                    <select class="form-control" id="select">
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                    <br>
                    <select multiple="" class="form-control">
                      <option>1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-lg-10 col-lg-offset-2">
                    <button type="reset" class="btn btn-default">Cancel</button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>
              </fieldset>
            </form>
          </div>
        </div>
        <div class="col-lg-4 col-lg-offset-1">

            <form class="bs-component">
              <div class="form-group">
                <label class="control-label" for="focusedInput">Focused input</label>
                <input class="form-control" id="focusedInput" type="text" value="This is focused...">
              </div>

              <div class="form-group">
                <label class="control-label" for="disabledInput">Disabled input</label>
                <input class="form-control" id="disabledInput" type="text" placeholder="Disabled input here..." disabled="">
              </div>

              <div class="form-group has-warning">
                <label class="control-label" for="inputWarning">Input warning</label>
                <input type="text" class="form-control" id="inputWarning">
              </div>

              <div class="form-group has-error">
                <label class="control-label" for="inputError">Input error</label>
                <input type="text" class="form-control" id="inputError">
              </div>

              <div class="form-group has-success">
                <label class="control-label" for="inputSuccess">Input success</label>
                <input type="text" class="form-control" id="inputSuccess">
              </div>

              <div class="form-group">
                <label class="control-label" for="inputLarge">Large input</label>
                <input class="form-control input-lg" type="text" id="inputLarge">
              </div>

              <div class="form-group">
                <label class="control-label" for="inputDefault">Default input</label>
                <input type="text" class="form-control" id="inputDefault">
              </div>

              <div class="form-group">
                <label class="control-label" for="inputSmall">Small input</label>
                <input class="form-control input-sm" type="text" id="inputSmall">
              </div>

              <div class="form-group">
                <label class="control-label">Input addons</label>
                <div class="input-group">
                  <span class="input-group-addon">$</span>
                  <input type="text" class="form-control">
                  <span class="input-group-btn">
                    <button class="btn btn-default" type="button">Button</button>
                  </span>
                </div>
              </div>
            </form>

        </div>
      </div>
    </div>
    </div>
  </section>

<aside class="social">
  <div class="social-button">
    <ul>
      <li><iframe src="https://ghbtns.com/github-btn.html?user=windyakin&repo=Honoka&type=star&count=true" frameborder="0" scrolling="0" width="90px" height="20px"></iframe></li>
      <li><a href="https://twitter.com/share" class="twitter-share-button" data-lang="ja" data-dnt="true">ツイート</a></li>
      <li><div class="fb-like" data-href="http://honokak.osaka/" data-layout="button_count" data-action="like" data-show-faces="false" data-share="false"></div></li>
      <li><a href="http://b.hatena.ne.jp/entry/" class="hatena-bookmark-button" data-hatena-bookmark-layout="standard-balloon" data-hatena-bookmark-lang="ja" title="このエントリーをはてなブックマークに追加"><img src="https://b.st-hatena.com/images/entry-button/button-only@2x.png" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;"></a></li>
    </ul>
  </div>
</aside>

<section class="section section-default point">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 subtitle">
        <h2>HonokaはオリジナルBootstrapテーマです</h2>
        <p>HonokaはBootstrapテーマの一つですが、以下の特徴を持っています。</p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3 col-sm-6 point-box">
        <div class="point-circle start">
          <i class="fa fa-check"></i>
        </div>
        <div class="point-description">
          <h4>Easy to Start</h4>
          <p>HonokaはBootstrapを元に製作されているため、非常に高い互換性を持っています。マークアップに関する規約はほとんど変わりません。</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 point-box">
        <div class="point-circle replace">
          <i class="fa fa-refresh"></i>
        </div>
        <div class="point-description">
          <h4>Replace Bootstrap</h4>
          <p>既にBootstrapを使って作成したウェブサイトがある場合は、CSSを置き換えるだけで簡単にHonokaを利用できます。</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 point-box">
        <div class="point-circle compass">
          <i class="fa fa-github-alt"></i>
        </div>
        <div class="point-description">
          <h4>Open Source</h4>
          <p>作成に使用したSASSファイルは全て公開されています。変数の定義ファイルを変更することで自分好みの設定に変更することも可能です。</p>
        </div>
      </div>
      <div class="col-md-3 col-sm-6 point-box">
        <div class="point-circle japanese">
          <span class="icon-jp"></span>
        </div>
        <div class="point-description">
          <h4>Optimized Japanese</h4>
          <p>本家Bootstrapでは指定されていない日本語フォントに関する指定が行われているため、美しく日本語を表示できます。</p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section section-inverse japanese-font">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 subtitle">
        <h2>Honokaは日本語を美しく表示します</h2>
        <p>本家Bootstrapでは指定されていない日本語のフォント指定を行っているので、日本語も美しく表示されます。</p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="well bootstrap-default text-justify">
          <h3>従来の日本語表示</h3>
          <p>
            秋葉原と神田と神保町という3つの街のはざまにある伝統校、音ノ木坂学院は統廃合の危機に瀕していた。
            学校の危機に、2年生の高坂穂乃果を中心とした9人の女子生徒が立ち上がる。
            私たちの大好きな学校を守るために、私たちができること……。それは、アイドルになること！ アイドルになって学校を世に広く宣伝し、入学者を増やそう！
            ここから、彼女たちの「みんなで叶える物語」（スクールアイドルプロジェクト）が始まった！
          </p>
        </div>
      </div>
      <div class="col-md-6">
        <div class="well text-justify">
          <h3>Honokaの日本語表示</h3>
          <p>
            秋葉原と神田と神保町という3つの街のはざまにある伝統校、音ノ木坂学院は統廃合の危機に瀕していた。
            学校の危機に、2年生の高坂穂乃果を中心とした9人の女子生徒が立ち上がる。
            私たちの大好きな学校を守るために、私たちができること……。それは、アイドルになること！ アイドルになって学校を世に広く宣伝し、入学者を増やそう！
            ここから、彼女たちの「みんなで叶える物語」（スクールアイドルプロジェクト）が始まった！
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section section-default getting-started">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 subtitle">
        <h2>さあ、はじめましょう。</h2>
        <p>導入はとっても簡単です</p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12 text-center">
        <div class="form-group">
          <a href="//github.com/windyakin/Honoka/releases" class="btn btn-primary btn-lg"><i class="fa fa-github-alt"></i> Download from GitHub</a>
          <p class="help-block">Last version v<span class="last-version"></span> ・ <a href="//github.com/windyakin/Honoka/blob/master/LICENSE">MIT License</a></p>
        </div>
        <p>使い方やファイルの説明など、詳しくは <a href="//github.com/windyakin/Honoka#readme">README</a> または <a href="//github.com/windyakin/Honoka/wiki">Wiki</a> をご確認ください</p>
      </div>
    </div>
  </div>
</section>

<section class="section section-inverse available-bower">
  <div class="bower-logo"></div>
  <div class="container">
    <div class="row">
      <div class="col-xs-12 subtitle">
        <h2>Available on the Bower</h2>
        <p>Honokaは<a href="http://bower.io/">Bower</a>からも利用できます</p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-8 col-md-offset-2 col-xs-12 text-center">
        <div class="input-group input-group-lg">
          <input type="text" class="form-control" id="command" value="bower install --save-dev $(node -e &#34;$(curl -fsSL https://cdn.honokak.osaka/last.js)&#34; windyakin Honoka)" onclick="this.select();" readonly="readonly">
          <span class="input-group-btn">
            <button type="button" class="btn btn-default" data-clipboard-target="#command"><i class="fa fa-clipboard"></i></button>
          </span>
        </div>
        <p class="help-block">v3.3.5-c 以降から対応</p>
      </div>
    </div>
  </div>
</section>

<section class="section section-default used-by">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 subtitle">
        <h2>Honokaを使って作られたウェブサイト</h2>
        <p>HonokaやそのForkテーマで構築されたウェブサイトを紹介します</p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="thumbnail">
          <a href="https://proconist.net/"><img src="//cdn.honokak.osaka/assets/img/proconist.png"></a>
          <div class="caption text-center">
            <h4>Proconist.net</h4>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="thumbnail">
          <a href="http://sugoi.windyakin.net/"><img src="//cdn.honokak.osaka/assets/img/sugoi.png"></a>
          <div class="caption text-center">
            <h4>この高専がすごい！</h4>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="thumbnail">
          <a href="http://yashihei.net/"><img src="//cdn.honokak.osaka/assets/img/yashihei.png"></a>
          <div class="caption text-center">
            <h4>yashihei.net</h4>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-4">
        <div class="thumbnail">
          <a href="http://sysken.org/advent2015/"><img src="//cdn.honokak.osaka/assets/img/sysken.png"></a>
          <div class="caption text-center">
            <h4>SYSKEN Advent Calendar</h4>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="thumbnail">
          <a href="http://timers-inc.com/"><img src="//cdn.honokak.osaka/assets/img/timers-inc.png"></a>
          <div class="caption text-center">
            <h4>TIMERS Inc</h4>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="thumbnail">
          <a href="http://ost.procon-online.net/"><img src="//cdn.honokak.osaka/assets/img/ost.png"></a>
          <div class="caption text-center">
            <h4>PROCON O.S.T. Project</h4>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section section-inverse fork">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 subtitle">
        <h2>HonokaのForkテーマ</h2>
        <p>Honokaをベースにして作られた他のBootstrapテーマ</p>
      </div>
    </div>
    <div class="row">
      <div class="col-md-6">
        <div class="thumbnail">
          <a href="//nkmr6194.github.io/Umi/"><img src="//cdn.honokak.osaka/assets/img/umi.png"></a>
          <div class="caption text-center">
            <h4>Umi</h4>
            <p>"Umi"は"Honoka"に<a href="https://bootswatch.com/flatly/">Bootswatch Flatly</a>の配色を適応したテーマです。</p>
            <div>
              <a href="//nkmr6194.github.io/Umi/" class="btn btn-primary">Umiの特設ページ <i class="fa fa-external-link"></i></a>
              <a href="//github.com/NKMR6194/Umi" class="btn btn-default">Umi on GitHub <i class="fa fa-github-alt"></i></a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="thumbnail">
          <a href="http://nico.kubosho.com/"><img src="//cdn.honokak.osaka/assets/img/nico.png"></a>
          <div class="caption text-center">
            <h4>Nico</h4>
            <p>"Nico"は"Honoka"にピンク系の配色を適応したテーマです。</p>
            <div>
              <a href="http://nico.kubosho.com/" class="btn btn-primary">Nicoの特設ページ <i class="fa fa-external-link"></i></a>
              <a href="//github.com/kubosho/Nico" class="btn btn-default">Nico on GitHub <i class="fa fa-github-alt"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-offset-3 col-md-6">
        <div class="thumbnail">
          <a href="//rinhoshizo.la/"><img src="//cdn.honokak.osaka/assets/img/rin.png"></a>
          <div class="caption text-center">
            <h4>Rin</h4>
            <p>"Rin"は"Honoka"を元にしたMaterial Design風のテーマです。</p>
            <div>
              <a href="//rinhoshizo.la/" class="btn btn-primary">Rinの特設ページ <i class="fa fa-external-link"></i></a>
              <a href="//github.com/raryosu/Rin" class="btn btn-default">Rin on GitHub <i class="fa fa-github-alt"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="section section-default featured">
  <div class="container">
    <div class="row">
      <div class="col-xs-12 subtitle">
        <h2>Honoka has been featured on</h2>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 text-center">
        <ul class="list-inline featured-list">
          <li><a href="http://www.moongift.jp/2015/06/honoka-%E6%97%A5%E6%9C%AC%E8%AA%9E%E3%82%82%E7%B6%BA%E9%BA%97%E3%81%AB%E8%A1%A8%E7%A4%BA%E3%81%A7%E3%81%8D%E3%82%8Bbootstrap%E3%83%86%E3%83%BC%E3%83%9E/"><img src="http://cdn.honokak.osaka/assets/img/moongift.png" alt="MOONGIFT"></a></li>
          <li><a href="http://coliss.com/articles/build-websites/operation/work/bootstrap-theme-honoka.html"><img src="http://cdn.honokak.osaka/assets/img/coliss.png" alt="コリス"></a></li>
          <li><a href="http://stocker.jp/diary/web-news-may2015/"><img src="http://cdn.honokak.osaka/assets/img/stockerjp.png" alt="Stocker.jp / diary"></a></li>
        </ul>
      </div>
    </div>
  </div>
</section> -->


<footer class="small">
  <div class="social-button">
    <ul>
      <li><iframe src="https://ghbtns.com/github-btn.html?user=windyakin&repo=Honoka&type=star&count=true" frameborder="0" scrolling="0" width="90px" height="20px"></iframe></li>
      <li><a href="https://twitter.com/share" class="twitter-share-button" data-lang="ja" data-dnt="true">ツイート</a></li>
      <li><a href="http://b.hatena.ne.jp/entry/" class="hatena-bookmark-button" data-hatena-bookmark-layout="standard-balloon" data-hatena-bookmark-lang="ja" title="このエントリーをはてなブックマークに追加"><img src="https://b.st-hatena.com/images/entry-button/button-only@2x.png" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;"></a></li>
    </ul>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-xs-12 text-center copyright">
        &copy; 2015 Honoka
      </div>
    </div>
  </div>
</footer>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-61413040-1', 'auto');
  ga('send', 'pageview');

</script>

<script src="//cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.5.5/clipboard.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
new Clipboard('.btn');
$(document).ready(function(e) {
	$.when(
		$.ajax({
			url: 'https://api.github.com/repos/windyakin/Honoka/releases/latest',
			type: 'get',
			dataType: 'json'
		}),
		$.ajax({
			url: 'https://cdn.rawgit.com/windyakin/Honoka/master/bower.json',
			type: 'get',
			dataType: 'json'
		})
	)
	.done(function(last, base) {
		$('.last-version').text(last[0].tag_name.split('v')[1]);
		$('.base-version').text(base[0].devDependencies.bootstrap);
	});
});
</script>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');</script>
<div id="fb-root"></div>
<script>(function(d, s, id) {var js, fjs = d.getElementsByTagName(s)[0];if (d.getElementById(id)) return;js = d.createElement(s); js.id = id;js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&appId=238369762859730&version=v2.3";fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));</script>
<script type="text/javascript" src="https://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
</body>
</html>
