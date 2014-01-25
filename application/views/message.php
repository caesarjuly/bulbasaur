<script type="text/javascript">
	$(document)
  .ready(function() {

    $('.ui.modal')
    .modal('attach events', '.login.button', 'show')
    ;
    
   $('.ui.form')
  .form({
    username: {
      identifier : 'username',
      rules: [
        {
          type   : 'empty',
          prompt : '请输入用户名'
        },
        {
          type   : 'maxLength[45]',
          prompt : '用户名最多45位'
        }
      ]
    },
    password: {
      identifier : 'password',
      rules: [
        {
          type   : 'empty',
          prompt : '请输入密码'
        },
        {
          type   : 'length[6]',
          prompt : '密码至少6位'
        },
        {
          type   : 'maxLength[45]',
          prompt : '密码最多45位'
        }
      ]
    }

  });

  });
</script>
    <div class="container middle column">
      <div class="ui success message">
        <div class="header">
          <meta http-equiv="Refresh" content="2;url=<?php echo site_url($url)?>">
          <?php echo $message; ?>
          
        </div>
        <a href="<?php echo site_url($url)?>">点此立即返回！</a>
      </div>
     
    </div>
    
<div class="ui modal">
      
      <div class="mid400">
      <div class="ui form segment">
      <form action="<?php echo site_url("/user/login");?>" method="post">
        <div class="field">
          <label>用户名</label>
          <div class="ui left labeled icon input">
            <input placeholder="Username" name="username" type="text">
            <i class="user icon"></i>
            <div class="ui corner label">
              <i class="icon asterisk"></i>
            </div>
          </div>
        </div>
        <div class="field">
          <label>密码</label>
          <div class="ui left labeled icon input">
            <input type="password" name="password" placeholder="Password">
            <i class="lock icon"></i>
            <div class="ui corner label">
              <i class="icon asterisk"></i>
            </div>
          </div>
        </div>
        <input class="ui blue submit button" type="submit" value="登录">
        <a href="<?php echo site_url('user/view_register');?>" class="ui green register button">注册</a>
        </form>
        <div class="ui error message"></div>
      </div>
    </div>
  </div>	