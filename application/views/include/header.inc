<!DOCTYPE html>
<head>
  <!-- Standard Meta -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

  <!-- Site Properities -->
  <title>学生问答社区</title>

  <link rel="stylesheet" type="text/css" href="<?php echo  base_url("src");?>/packaged/css/semantic.css">

  <script src="<?php echo  base_url("src");?>/jquery-2.0.3.min.js"></script>
  <script src="<?php echo  base_url("src");?>/packaged/javascript/semantic.min.js"></script>
  <script>
    $(document)
  .ready(function() {

    $('.ui.dropdown')
      .dropdown()
      ;
    });
  </script>


  <link rel="stylesheet" type="text/css" href="<?php echo  base_url("src");?>/style.css">
</head>
<body id="main">
  <div class="ui inverted menu" >
<div class="container">
  <a class=" item" href="<?php echo  base_url();?>">
    <i class="home icon"></i> 学生问答社区
  </a>
  <?php if ($this->session->userdata('is_logged')) { ?>
    <div class="ui dropdown item right">
        <?php echo $this->session->userdata('username'); ?>
         <i class="icon dropdown"></i>
        <div class="menu">
          <a class="item" href="<?php echo site_url("user/view_set"); echo "/".$this->session->userdata('id');?>"><i class="settings icon"></i> 设置</a>
          <a class="item" href="<?php echo site_url("user/logout");?>"><i class="sign out icon"></i> 登出</a>
        </div>
      </div>
    <?php if ($this->session->userdata('is_admin')) { ?>
    <a class="item right" href="<?php echo site_url("user/manage");?>">
      <i class="user icon"></i> 用户管理
    </a>
    <?php }else { ?>
    <a class="item right" href="<?php echo site_url("user/view_home/".$this->session->userdata('id'));?>">
      <i class="user icon"></i> 我的主页
    </a>
    <?php } ?>
    <a class="item right" href="<?php echo site_url("question/view_add");?>">
      <i class="add icon"></i> 提问
    </a>
    
 <?php } else {?>
  <a class="item right ui blue medium login button">
    <i class="sign in icon"></i> 
    登录
  </a>
  <?php }; ?>
  <a class="item right"  href="<?php echo  base_url();?>">
    <i class="question icon"></i> 问题列表
  </a>
  
 
  </div>
</div>
  