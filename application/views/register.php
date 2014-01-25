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
          type   : 'maxLength[45]',
          prompt : '密码最多45位'
        }
      ]
    },
    name: {
      identifier : 'name',
      rules: [
        {
          type   : 'maxLength[45]',
          prompt : '姓名最多45位'
        }
      ]
    },
    major: {
      identifier : 'major',
      rules: [
        {
          type   : 'maxLength[64]',
          prompt : '专业最多64位'
        }
      ]
    },
    class: {
      identifier : 'class',
      rules: [
        {
          type   : 'maxLength[45]',
          prompt : '专业最多45位'
        }
      ]
    }

  });

  });
</script>
 <div class="container middle column">
      
      <h2 class="ui header">
        <i class="user icon"></i>
        注册新用户
      </h2>
      <div class="ui form segment">
      <form action="<?php echo site_url("/user/register"); ?>" method="post">
         <div class="two fields">
          <div class="field">
            <label>用户名</label>
            <input placeholder="Username" name="username" type="text" value="<?php echo set_value('username'); ?>">
          </div>
          <div class="field">
            <label>密码</label>
            <input placeholder="Password" name="password" type="password" value="<?php echo set_value('password');?>">
          </div>
          </div>
        <div class="three fields">
          <div class="field">
            <label>姓名</label>
            <input placeholder="Name" name="name" type="text" value="<?php echo set_value('name'); ?>">
          </div>
          <div class="field">
            <label>专业</label>
            <input placeholder="Major" name="major" type="text" value="<?php echo set_value('major'); ?>">
          </div>
          <div class="field">
            <label>班级</label>
            <input placeholder="Class" name="class" type="text" value="<?php echo set_value('class'); ?>">
          </div>
        </div>
        <input class="ui blue submit button" type="submit" value="注册">
        </form>
        <div class="ui error message"></div>
        <?php echo validation_errors();?>
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