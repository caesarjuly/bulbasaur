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
    }

  });

  });
</script>
    <div class="container middle column">
      
      <h2 class="ui header">
        <i class="inbox icon"></i>
        问题列表
      </h2>
      
      <div class="ui divided animated selection list " >
      <?php if (isset($questions)): ?>
        <?php  foreach ($questions as $row) {?>
        <div class="item">
        <i class="large chat icon"></i>
        <div class="right floated">
        <?php convert_time($row->create_time);?><br><br><?php echo $row->reply_num; ?>条回复</div>
        <div class="content">
        <div class="header "> <a href="<?php echo site_url("user/view_home/".$row->user_id);?>"> <?php echo $row->username; ?> </a>发表问题</div>
          <a class="header" href="<?php echo site_url("question/view_detail/$row->question_id");?>"><?php echo $row->title; ?></a>
          <div class="description"><?php echo $row->content ?></div>
        </div>
      </div>
      <?php } ?>
      </div>
      <?php endif ?>

      <div class="ui divider"></div>

      <?php echo $this->pagination->create_links();?>
    
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