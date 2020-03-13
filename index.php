<?php
session_start();
require_once dirname(__FILE__).'/facebook_login/initialization.php'; //引入 Facebook 登入初始設定
?>
<?php
    $title = "客家三民";
    $maintitle = "客家";
?>
<!doctype html>
<html lang="zh">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="description" content="">
      <title><?php echo $title ?> 2.0 | 每日一<?php echo $maintitle ?>，一年四季客好客滿，<?php echo $maintitle ?>三民</title>
      <!-- Tocas UI：CSS 與元件 -->
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tocas-ui/2.3.3/tocas.css">
      <link rel="stylesheet" href="/assets/style.css">
      <!-- Tocas JS：模塊與 JavaScript 函式 -->
      <script src="https://cdnjs.cloudflare.com/ajax/libs/tocas-ui/2.3.3/tocas.js"></script>


    </head>
    <body>
        <div class="ts top fixed basic menu">
            <div class="ts container">
                <?php if (isset($accessToken)) : require_once dirname(__FILE__) . '/facebook_login/statuslogin.php'; ?>
                <a class="item active" href="/"><?php echo $maintitle ?>專區</a>
                <a class="item" onclick="adminRequest()">客文管理</a>
                <div class="right menu">
                    <span class="item">您好，<img class="ts circular image" src="<?php echo $profile["picture"]["url"]; ?>" style="height:1.4em;"> <?php echo $profile["first_name"]; ?></span>
                    <a class="item" href="logout.php?url=https://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">Logout</a>
                </div>
                <?php else : ?>
                <?php
                $url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; //取得目前頁面網址
                $loginUrl = $helper->getLoginUrl($url, $permissions); //取得 Facebook 登入網址
                ?>
                <a class="item active" href="/"><?php echo $title ?></a>
                <div class="right menu">
                    <a class="item" href="<?php echo $loginUrl; ?>">Login</a>
                </div>
                <?php endif; ?>
            </div>
            <script>
                function adminRequest() {
                    ts('.snackbar').snackbar({
                    content: '新功能啦還沒出來～',
                    action: '仍要進入',
                    actionEmphasis: 'negative',
                    onAction: () => {
                        alert('叫你滾！');
                    }
                    });
                }
            </script>
        </div>
		<header class="ts fluid padded heading slate" style="padding:70px;">
			<div class="ts narrow container">
				<h1 class="ts header"><?php echo $title ?> 2.0</h1>
				<div class="ts huge sub header">
				    維持網路秩序，你我有責。<br>
				    每日一<?php echo $maintitle ?>，一年四季客好客滿。
				</div>
			</div>
		</header>
		<div class="ts container container-index">
		    <?php if (isset($accessToken)) : require_once dirname(__FILE__) . '/facebook_login/statuslogin.php'; ?>
			<div class="submit-section">
				<h2>立即<?php echo $maintitle ?></h2>
				<form id ="submit-post" class="ts form" action="/#" method="POST" enctype="multipart/form-data">
					<div id="body-field" class="required resizable field">
						<label><?php echo $maintitle ?>內容</label>
						<textarea minlength="5" id="body-area" name="contact" rows="6" placeholder="請在這輸入您的<?php echo $maintitle ?>內容（至少5字）。"></textarea>
					</div>
					<style>
					    #body-area, #captcha-input {
                          border: 2px solid currentColor;
                        }
                        #body-area:invalid {
                          border: 2px dashed red;
                        }
                        /*#body-area:invalid:focus {*/
                        /*  background-image: linear-gradient(pink, lightgreen);*/
                        /*}*/
					</style>
					<div class="inline field">
						<label>附加圖片</label>
						<div class="four wide"><input type="file" id="img" name="img" accept="image/png, image/jpeg, image/gif" class="ts clickable basic dashed slate"></p></div>
					</div>
					<div class="inline field">
						<label>客文類型</label>
						<div class="ts radio checkbox">
                            <input id="comtext" type="radio" name="comtype" checked="checked">
                            <label for="comtext">客文就好！</label>
                        </div>
                        <div class="ts radio checkbox">
                            <input id="comimage" type="radio" name="comtype">
                            <label for="comimage">客文字圖！</label>
                        </div>
					</div>
					<div class="ts info message">
                        <div class="header">發文叮嚀</div>
                        <p>請先閱讀 Facebook 社群守則，就這樣 Have Fun!</p>
                    </div>
					<!--<div id="captcha-field" class="required inline field">-->
					<!--	<label>驗證問答</label>-->
					<!--	<div class="two wide"><input id="captcha-input" name="captcha"></div>-->
					<!--	<span>&nbsp; 請輸入「」（四個字）</span>-->
					<!--</div>-->
					<!--<input name="csrf_token" id="csrf_token" type="hidden" value="sazM3Q2d" />-->
					<input onclick="OpenSnackbar()" id="submit" type="submit" class="ts fluid button" value="客下去！" />
				</form>
				<script>
				    $('#submit').click(function() {
                        // $(this).removeClass('myclass');
                        $(this).addClass('.loading');
                    });
				</script>
<!--<canvas id="myCanvas" width="500" height="300"-->
<!--style="background:#000;">-->
<!--Your browser does not support the canvas element.-->
<!--</canvas>-->

<!--<script>-->
<!--var canvas = document.getElementById("myCanvas");-->
<!--var ctx = canvas.getContext("2d");-->
<!--ctx.font = "30px Arial";-->
<!--ctx.fillStyle = '#FFFFFF';-->
<!--</script>-->
				<script>
                    function OpenSnackbar() {
                        ts('.snackbar').snackbar({
                        content: '！',
                        // action: '關閉',
                        // actionEmphasis: 'negative',
                        // onAction: () => {
                        //     $(".snackbar").(hide)
                        // }
                        });
                    }
                </script>
			</div>
			<?php else : ?>
            <?php
            $url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; //取得目前頁面網址
            $loginUrl = $helper->getLoginUrl($url, $permissions); //取得 Facebook 登入網址
            ?>
            <div class="ts positive segment">
                <div class="ts big header">歡迎使用 <?php echo $title ?> 2.0</div>
                <p>
                    為維護網路善良風氣，我們要求您使用 Facebook 登入進行匿名發言
                    ，不過請您放心，我們不會公開身分，即使是管理階層也不能查詢您的個資。
                </p>
                <button class="ts ts primary big button" onclick="OpenSnackbar()">使用 Facebook 登入</button>
                <script>
                    function OpenSnackbar() {
                        ts('.snackbar').snackbar({
                        content: '戳右上角的 Login',
                        // action: '還原',
                        // actionEmphasis: 'negative',
                        // onAction: () => {
                        //     alert('檔案已順利還原！');
                        // }
                        });
                    }
                </script>
            </div>
            <div class="ts info segment">
                <div class="ts big header">全站發文統計</div>
                <div class="ts positive statistic">
                    <div class="value">301+</div>
                    <div class="label">認可通過</div>
                </div>
                <div class="ts negative statistic">
                    <div class="value">13</div>
                    <div class="label">下架處理</div>
                </div>
            </div>
            <?php endif; ?>
		</div>
        <div class="ts container" style="display:none;">
            <?php echo $_GET['id'];?>
            <?php if (isset($accessToken)) : require_once dirname(__FILE__) . '/facebook_login/statuslogin.php'; ?>
            <p>您好 <a href="<?php echo $profile["link"]; ?>" target="_blank"><?php echo $profile["first_name"]; ?></a>！</p>
            <br>
            <p>取得的資料陣列<br><?php print_r($profile); ?></p>
            <br>
            <p>全名：<font color="#883584"><?php echo $profile["name"]; ?></font>
                <br>名子：<font color="#883584"><?php echo $profile["first_name"]; ?></font>
                <br>姓氏：<font color="#883584"><?php echo $profile["last_name"]; ?></font>
                <br>Email：<font color="#883584"><?php echo $profile["email"]; ?></font>
                <br>Facebook 個人動態網址：<a href="<?php echo $profile["link"]; ?>" target="_blank"><?php echo $profile["link"]; ?></a>
                <br>大頭照圖片高度：<font color="#883584"><?php echo $profile["picture"]["height"]; ?></font>
                <br>大頭照圖片寬度：<font color="#883584"><?php echo $profile["picture"]["width"]; ?></font>
                <br>大頭照網址：<font color="#883584"><?php echo $profile["picture"]["url"]; ?></font>
                <br><img src="<?php echo $profile["picture"]["url"]; ?>">
                <br>使用者 Facebook ID：<font color="#883584"><?php echo $profile["id"]; ?></font></p>
            <br>
            <h3><a href="logout.php?url=https://<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">登出</a></h3>
            <?php else : ?>
            <?php
            $url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; //取得目前頁面網址
            $loginUrl = $helper->getLoginUrl($url, $permissions); //取得 Facebook 登入網址
            ?>
            <p><font color="#ff0000">您尚未登入 Facebook！</font></p>
            <h3><a href="<?php echo $loginUrl; ?>">使用 Facebook 登入</a></h3>
            <?php endif; ?>
        </div>
        <div class="ts snackbar">
            <div class="content"></div>
            <a class="action"></a>
        </div>
        <footer>
        	<center>
        		<p>由三民高中 111級 <a target="_blank" href="https://me.imych.one/">黃猷珵</a> 開發設計<br />
        	</center>
        </footer>
    </body>
</html>
