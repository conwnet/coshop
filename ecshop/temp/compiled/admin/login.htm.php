<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>云博畜牧商城 - 管理登录</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<link href="styles/general.css" rel="stylesheet" type="text/css" />
<link href="styles/main.css" rel="stylesheet" type="text/css" />

<style type="text/css">
/*body,html {height: 100%; overflow: hidden;}*/
.panel-icloud .panel-right iframe {height: 300px; margin-top: 15px;}
.panel-hint{top: 3%;}
.login-body{background: url(images/login_bg_01.jpg) no-repeat center center;}

.center-wrap .z-bd{
  width: 372px;
}
.z-bd .login-panel{
  padding: 5px 20px 25px;
}
.login-cloud{
  padding:70px 10px 20px;
}
.center-wrap{
  width: 94%;
}
.center-wrap .z-bd{
  background-size: contain;
  height:391px;
}

.logo {
  color: #f44;
  font-size: 30px;
  width: 100%;
  font-weight: bold;
}

</style>

<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,validator.js,../js/transport.js')); ?>
<script language="JavaScript">
<!--
// 这里把JS用到的所有语言都赋值到这里
<?php $_from = $this->_var['lang']['js_languages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

if (window.parent != window) {
  window.top.location.href = location.href;
}
/*关闭按钮*/
function get_certificate(){
    var panel = document.getElementById('panelCloud');
    var mask  = document.getElementById('CMask')||null;
    var frame = document.getElementById('CFrame');
    if(panel&&CMask&&frame){
        panel.style.display = 'block';
        mask.style.display = 'block';
        frame.src = '<?php echo $this->_var['activate_iframe_url']; ?>';
      }
  }

  /*关闭按钮*/
  function btnCancel(item){
    var par  = item.offsetParent;
    var mask  = document.getElementById('CMask')||null;
    var frame = document.getElementById('CFrame');
    par.style.display = 'none';
    if(mask){mask.style.display = 'none';}
    frame.src = '';
  }
//-->
</script>
</head>
<body style="height: 100%;padding: 0">
<div class="form-header">
  <div class="logo">云博畜牧商城</div>
</div>
<form class="login-body" method="post" action="privilege.php" name='theForm' onsubmit="return validate()">
  <!--<div class="login-hd">
    <img src="images/shopex.png" alt="shopex" class="logo">
  </div>-->
  <div class="center-wrap" id="centerWrap">
    <!--<div class="login-center">
      <div class="bd-logo">
        <img src="images/ecshop-logo.png" width="373" height="103" border="0" alt="ECSHOP" />
      </div>
    </div>-->

    <div class="z-bd">
    <div class="message"><?php echo $this->_var['login_err']; ?></div>
      <div class="login-panel" id="loginPanel">
       <h3 class="logo-text ecshop-logo">
         <div class="logo" style="color: #03ABD0;">管理员登录</div>
       </h3>
        <div class="controls first">
          <svg class="iconphone" width="20px" height="20px" viewBox="0 0 20 20">
            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
              <g id="2-copy-2" sketch:type="MSArtboardGroup" transform="translate(-505.000000, -357.000000)" fill="#666">
                <path d="M517.388314,366.868305 C519.068314,366.001784 520.220053,364.252653 520.220053,362.231784 C520.220053,359.350479 517.883966,357.014392 515.002662,357.014392 C512.121357,357.014392 509.78527,359.350479 509.78527,362.231784 C509.78527,364.252653 510.936575,366.001784 512.616575,366.868305 C508.246575,367.938305 505.002662,371.879175 505.002662,376.57961 C505.002662,376.81961 505.197009,377.014392 505.437444,377.014392 C505.677444,377.014392 505.872227,376.81961 505.872227,376.57961 C505.872227,371.537001 509.960053,367.449175 515.002662,367.449175 C520.04527,367.449175 524.133096,371.537001 524.133096,376.57961 C524.133096,376.81961 524.327444,377.014392 524.567879,377.014392 C524.807879,377.014392 525.002662,376.81961 525.002662,376.57961 C525.002662,371.879175 521.758749,367.938305 517.388314,366.868305 L517.388314,366.868305 Z M510.654835,362.231784 C510.654835,359.830479 512.601357,357.883957 515.002662,357.883957 C517.403966,357.883957 519.350488,359.830479 519.350488,362.231784 C519.350488,364.632653 517.403966,366.57961 515.002662,366.57961 C512.601357,366.57961 510.654835,364.632653 510.654835,362.231784 L510.654835,362.231784 Z" id="id" sketch:type="MSShapeGroup"></path>
              </g>
            </g>
          </svg>
          <input type="text" name="username" placeholder="请输入您的用户名" />
        </div>
        <div class="controls two">
          <svg class="iconphone" width="20px" height="20px" viewBox="0 0 20 20">
            <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
              <g id="2-copy-2" sketch:type="MSArtboardGroup" transform="translate(-505.000000, -407.000000)" fill="#666">
                <path d="M515,418.304324 C514.12782,418.304324 513.421091,418.888119 513.421091,419.608723 C513.421091,419.995004 513.624357,420.341947 513.947394,420.580774 L513.947394,421.782554 C513.947394,422.262857 514.418637,422.652187 515.00003,422.652187 C515.581302,422.652187 516.052667,422.262857 516.052667,421.782554 L516.052667,420.580774 C516.375703,420.341947 516.579,419.995004 516.579,419.608723 C516.57897,418.888119 515.87221,418.304324 515,418.304324 L515,418.304324 L515,418.304324 Z M522.368454,414.391327 L521.315788,414.391327 L521.315788,412.217421 C521.315788,409.335657 518.488418,407 515,407 C511.511582,407 508.684212,409.335657 508.684212,412.217421 L508.684212,414.391327 L507.631576,414.391327 C506.178003,414.391327 505,415.364503 505,416.565234 L505,424.826193 C505,426.026824 506.178003,427 507.631576,427 L522.368424,427 C523.821422,427 525,426.026899 525,424.826193 L525,416.565234 C525.00003,415.364478 523.821422,414.391327 522.368454,414.391327 L522.368454,414.391327 L522.368454,414.391327 Z M515,407.869583 C517.906571,407.869583 520.263152,409.816309 520.263152,412.217396 L520.263152,414.391302 L509.737544,414.391302 L509.737544,412.217396 L509.736848,412.217396 C509.736848,409.816309 512.093459,407.869583 515,407.869583 L515,407.869583 L515,407.869583 Z M523.947364,424.826093 C523.947364,425.546622 523.240604,426.130392 522.368454,426.130392 L507.631606,426.130392 C506.759396,426.130392 506.052667,425.546622 506.052667,424.826093 L506.052667,416.565234 C506.052667,415.84468 506.759426,415.260835 507.631606,415.260835 L522.368454,415.260835 C523.240635,415.260835 523.947364,415.844705 523.947364,416.565234 L523.947364,424.826093 L523.947364,424.826093 L523.947364,424.826093 Z" id="pw" sketch:type="MSShapeGroup"></path>
              </g>
            </g>
          </svg>
          <input type="password" name="password" placeholder="<?php echo $this->_var['lang']['label_password']; ?>"/>
        </div>
        <?php if ($this->_var['gd_version'] > 0): ?>
          <div class="controls third">
            <svg class="iconphone" width="20px" height="20px" viewBox="0 0 20 20">
              <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd" sketch:type="MSPage">
                <g id="2-copy-2" sketch:type="MSArtboardGroup" transform="translate(-505.000000, -457.000000)" fill="#666">
                  <path d="M514.992364,462.720402 C514.752337,462.720402 514.558125,462.879933 514.558125,463.077076 L514.558125,468.784241 C514.558125,468.981384 514.752337,469.140915 514.992364,469.140915 C515.232364,469.140915 515.426576,468.981384 515.426576,468.784241 L515.426576,463.077076 C515.426576,462.879933 515.232364,462.720402 514.992364,462.720402 L514.992364,462.720402 Z M524.979837,460.500513 C524.421168,460.552589 523.839891,460.580179 523.242853,460.580179 C519.219511,460.580179 515.906875,459.331741 515.474864,457.726607 L515.426603,457.726607 L515.426603,457.369955 C515.426603,457.173147 515.232391,457.013259 514.992391,457.013259 C514.752364,457.013259 514.558152,457.17317 514.558152,457.369955 L514.558152,457.726629 L514.509891,457.726629 C514.077853,459.331763 510.76519,460.580201 506.741821,460.580201 C506.14481,460.580201 505.563533,460.552589 505.004891,460.500536 L505.004891,461.214799 C505.015217,461.215737 505.025462,461.216808 505.035815,461.217746 C505.015408,461.592723 505.004891,461.974732 505.004891,462.363705 C505.004891,470.440558 509.476196,476.988237 514.992391,476.988237 C520.50856,476.988237 524.979864,470.440558 524.979864,462.363705 C524.979864,461.974732 524.969321,461.592723 524.948913,461.217746 C524.959266,461.216808 524.969511,461.215759 524.979864,461.214799 L524.979864,460.500513 L524.979837,460.500513 Z M514.992364,476.274866 C509.956196,476.274866 505.873315,470.046652 505.873315,462.363705 C505.873315,461.994085 505.882962,461.631317 505.901576,461.27529 C506.178125,461.287299 506.458315,461.293638 506.741793,461.293638 C510.588886,461.293638 513.851549,460.163281 514.992364,458.597634 C516.133152,460.163281 519.395842,461.293638 523.242853,461.293638 C523.526386,461.293638 523.806576,461.287299 524.083125,461.27529 C524.101739,461.631317 524.111386,461.994107 524.111386,462.363705 C524.111386,470.046629 520.028533,476.274866 514.992364,476.274866 L514.992364,476.274866 Z M514.992364,469.85433 C514.752337,469.85433 514.558125,470.014196 514.558125,470.211004 L514.558125,470.924375 C514.558125,471.121518 514.752337,471.281094 514.992364,471.281094 C515.232364,471.281094 515.426576,471.121518 515.426576,470.924375 L515.426576,470.211004 C515.426576,470.014196 515.232364,469.85433 514.992364,469.85433 L514.992364,469.85433 Z" id="code" sketch:type="MSShapeGroup"></path>
                </g>
              </g>
            </svg>
            <input type="text" name="no-captcha" class="capital" placeholder="<?php echo $this->_var['lang']['label_captcha']; ?>" />
            <!--<input name="captchas" type="text" data-error-msg="验证码不能为空" class="Inp-v" placeholder="输入验证码"><i class="Ico"></i>-->
            <div class="" style="position: absolute; right: 8px; top: 8px;" id="number_div">
              <img src="index.php?act=captcha&<?php echo $this->_var['random']; ?>" width="102" height="34" alt="CAPTCHA" border="1" onclick= this.src="index.php?act=captcha&"+Math.random() style="cursor: pointer;" title="<?php echo $this->_var['lang']['click_for_another']; ?>" />
            </div>
          </div>
        <?php endif; ?>
        <div class="controls last">
          <input type="submit" class="btn-a" value="<?php echo $this->_var['lang']['signin_now']; ?>" class="button" />
          <span style="display: none" id="login_error_msg"></span>
        </div>
        <div class="controls bside" style="border: none">
          <input type="checkbox" value="1" name="remember" id="remember" />
          <label for="remember"><?php echo $this->_var['lang']['remember']; ?></label></td>
          <a class="link-forget cl-link-blue" href="get_password.php?act=forget_pwd"><?php echo $this->_var['lang']['forget_pwd']; ?></a>
          <a class="link-home cl-link-blue" href="../kefu">客服登录</a>
        </div>
      </div>
    </div>
  </div>
  <input type="hidden" name="act" value="signin" />
</form>
<div class="copy-right">&copy; 2017-<?php echo $this->_var['now_year']; ?> 云博畜牧商城.</div>
<script language="JavaScript">

 //三次密码输入错误,出现验证码(火狐触发不了,不过影响不大)
 (function(win,doc){
   if(!doc.getCookie('loginNum')){
     doc.setCookie('loginNum','1',1);
   }else{
     doc.setCookie('loginNum',doc.getCookie('loginNum')*1+1,1);
   }
   if(doc.getCookie('loginNum')>3){
     var oInput=doc.getElementsByClassName('capital')[0];
     var oT=doc.getElementsByClassName('third')[0];
     if(oT){
      oT.classList.add('active');
      oT.previousElementSibling.classList.add('active');
      oInput.name='captcha';
     }
   }
 })(window,document);

<!--
  document.forms['theForm'].elements['username'].focus();
  
  /**
   * 检查表单输入的内容
   */
  function validate(){
    var validator = new Validator('theForm');
    validator.required('username', user_name_empty);
    //validator.required('password', password_empty);
    if (document.forms['theForm'].elements['captcha']) {
      validator.required('captcha', captcha_empty);
    }
    return validator.passed();
  }
  
  
</script>
</body>
