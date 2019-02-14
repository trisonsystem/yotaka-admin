<?php
  
  $path_host  = $this->config->config['base_url'];
  $keyword    = $this->config->config['keyword'];

  $len      = 3;
  // $base     = '012345678901234567890123456789ABCDEFTHIJKLMNOPQRSTUBWSYZ';
  $base     = '012345678901234567890123456789';
  $max    = strlen($base)-1;
  $captcha  ='';
  mt_srand((double)microtime()*1000000);
  while (strlen($captcha )<$len+1) $captcha .=$base{mt_rand(0,$max)};
  setcookie($keyword."captcha",$captcha);

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>Admin Sunmoney</title>
        <meta name="description" content="Login Admin 88Wallet Page" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1, user-scalable=no" />

        <link rel="shortcut icon" href="<?php echo $path_host ?>assets/images/favicon.png">
        <link rel="stylesheet" href="<?php echo $path_host ?>assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="<?php echo $path_host ?>assets/font-awesome/4.2.0/css/font-awesome.min.css" />
        <link rel="stylesheet" href="<?php echo $path_host ?>assets/css/admin-login.css?v=22" />

        <script src="<?php echo $path_host ?>assets/js/jquery.2.1.1.min.js"></script>
       
    </head>

    <body class="login-layout">
        <div class="container">
          <div class="main-boxlogin">
            <div class="divLogo">
              <img src="<?php echo $path_host;?>/assets/images/logo.png?v=2" >
            </div>
            <form id="flogin" name="flogin" method="post" action="chkLogin">
              <div class="input-group">
                <?php if (!empty($_COOKIE[$keyword.'error']) != ''): ?>
                  <span class="help-block">
                      <strong style="color:red"><?php echo $_COOKIE[$keyword.'error']; ?></strong>
                  </span>
                  <?php setcookie($keyword."error",''); ?>
                <?php endif; ?> 
              </div>
              <div style="margin-bottom: 10px" class="input-group">
                <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input id="usr" type="text" class="form-control" name="usr" value="" maxlength="15" placeholder="Username">
              </div>
              <div style="margin-bottom: 10px" class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                  <input id="pwd" type="password" class="form-control" name="pwd" maxlength="15" placeholder="Password">
              </div>
              <div style="margin-top:10px" class="form-group">
                  <div class="col-sm-4 left" style="padding:0px;">
                        <input id="CaptchaCode" type="text" class="form-control" name="CaptchaCode" maxlength="4" required="">         
                  </div>
                  <div class="col-sm-4 center divcapcha">
                        <input id="capcha" name="captcha" type="text" class="form-control" value="<?php echo $captcha;?>" readonly="readonly">
                  </div>
                  <div class="col-sm-4 right" style="padding:0px;">
                        <button class="btn btn-success btn-block btn-login" type="submit">Login</button>
                  </div>
              </div>
            </form>
          </div>
        </div>

        <script src="assets/js/jquery.form-validator.min.js"></script>
        <script type="text/javascript">
            $.validate({        
                modules : 'security',
              });
        </script>
    </body>
</html>