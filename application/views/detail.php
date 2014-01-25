 <script type="text/javascript">
  $(document)
  .ready(function() {
    
   $('.ui.form')
  .form({
    content: {
      identifier : 'content',
      rules: [
        {
          type   : 'empty',
          prompt : '请输入回复'
        },
        {
          type   : 'length[6]',
          prompt : '回复至少6位'
        }
      ]
    }
    

  });

  });
</script>
 <script src="<?php echo  base_url("src");?>/kindeditor/kindeditor.js"></script>
 <script src="<?php echo  base_url("src");?>/kindeditor/lang/zh_CN.js"></script>
 <link rel="stylesheet" type="text/css" href="<?php echo  base_url("src");?>/kindeditor/themes/simple/simple.css">
<script>
      var editor;
      KindEditor.ready(function(K) {
        editor = K.create('textarea[name="content"]', {
          width : '100%',
          themeType : 'simple',
          resizeType : 1,
          allowPreviewEmoticons : false,
          allowImageUpload : false,
          items : [
            'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
            'removeformat', '|', 'insertorderedlist',
            'insertunorderedlist', '|', 'emoticons', 'image', 'link']
        });
      });
</script>

<div class="container middle column">
      <h1 class="ui header"><?php echo $question->title ?></h1>
      Tags: <a class="ui teal label"><?php echo $question->reply_num ?>条回复</a> 
            <a class="ui teal label"><?php convert_time($question->create_time);?>发表</a> 
            <a class="ui teal label">
              <?php if ($question->create_time == $question->change_time): ?>
                :)从未修改
              <?php else: ?>
              <?php convert_time($question->change_time) ?>修改
              <?php endif ?>
            </a>
     
      <p><?php echo $question->content ?></p>
      <?php if ($this->session->userdata('is_admin') || $this->session->userdata('id')==$question->user_id): ?>
        <div class="actions">
            <a class="reply" href="<?php echo site_url("/question/view_change/".$question->id);?>">编辑</a>
            <a class="delete" href="<?php echo site_url("/question/delete/".$question->id);?>">删除</a>
        </div>
      <?php endif ?>
      
      
      <div class="ui divider"></div>
      <div class="ui piled blue segment">
      <h2 class="ui header">
        <i class="icon inverted circular blue comment"></i> Replys
      </h2>
      <div class="ui minimal comments">
      <?php foreach ($replys as $reply): ?>
        <?php $user = $this->user_model->get_user_byId($reply->user_id); ?>
        <div class="comment">

          <div class="content">
            <a class="author" href="<?php echo site_url("user/view_home/".$user->id);?>"><?php echo $user->username ?></a>
            <div class="metadata">
              <div class="date"><?php convert_time($reply->create_time); ?></div>
            </div>
            <div class="text">
              <?php echo $reply->content ?>
            </div>
            <?php if ($this->session->userdata('is_admin') || $this->session->userdata('id')==$reply->user_id): ?>
              <div class="actions">
                  <a class="reply" href="<?php echo site_url("/reply/view_change/".$reply->id);?>">编辑</a>
                  <a class="delete" href="<?php echo site_url("/reply/delete/".$reply->id."/".$question->id);?>">删除</a>
              </div>
            <?php endif ?>
          </div>
        </div>
      <?php endforeach ?>

    <div class="ui reply form segment">
      <form class="reply" action="<?php echo site_url("/reply/add/".$question->id);?>" method="post">
          <div class="field">
            <textarea placeholder="Content" id="editor" name="content" type="text" value=""></textarea>
          </div>
        <input class="ui blue submit button" type="submit" value="回复">
        </form>
        <div class="ui error message"></div>
        <?php echo validation_errors();?>
      </div>
      </div>
  </div>
</div>
