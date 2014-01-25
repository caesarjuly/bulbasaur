<script type="text/javascript">
  $(document)
  .ready(function() {
    
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
        <i class="edit icon"></i>
        编辑用户
      </h2>
      <div class="ui form segment">
      <form action="<?php echo site_url("/user/change"); if ($user) echo '/'.$user->id;?>" method="post">
         <div class="two fields">
          <div class="field">
            <label>用户名</label>
            <input placeholder="Username" readonly="readonly" name="username" type="text" value="<?php echo set_value('username');  if ($user) echo $user->username;?>">
          </div>
          <div class="field">
            <label>密码</label>
            <input placeholder="不填即不改变" name="password" type="password" value="">
          </div>
          </div>
        <div class="three fields">
          <div class="field">
            <label>姓名</label>
            <input placeholder="Name" name="name" type="text" value="<?php echo set_value('name'); if ($user) echo $user->name;?>">
          </div>
          <div class="field">
            <label>专业</label>
            <input placeholder="Major" name="major" type="text" value="<?php echo set_value('major'); if ($user) echo $user->major;?>">
          </div>
          <div class="field">
            <label>班级</label>
            <input placeholder="Class" name="class" type="text" value="<?php echo set_value('class'); if ($user) echo $user->class;?>">
          </div>
        </div>
        <input class="ui blue submit button" type="submit" value="更新">
        </form>
        <div class="ui error message"></div>
        <?php echo validation_errors();?>
      </div>
    </div>