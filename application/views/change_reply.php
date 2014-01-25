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
          prompt : '回复内容至少6位'
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
          themeType : 'simple',
          resizeType : 1,
          allowPreviewEmoticons : false,
          allowImageUpload : false,
          items : [
            'fontname', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold', 'italic', 'underline',
            'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
            'insertunorderedlist', '|', 'emoticons', 'image', 'link']
        });
      });
</script>
 <div class="container middle column">
      <h2 class="ui header">
        <i class="edit icon"></i>
        编辑回复
      </h2>
      <div class="ui form segment">
      <form action="<?php echo site_url("/reply/change/".$reply->id);?>" method="post">
          <div class="field">
            <label>回复内容：</label>
            <textarea placeholder="Content" id="editor" name="content" type="text" value="">
            <?php echo set_value('content');?>
              <?php if (isset($reply)): ?>
                <?php echo $reply->content ?>
              <?php endif ?>
            </textarea>
          </div>
        <input class="ui blue submit button" type="submit" value="更新">
        </form>
        <div class="ui error message"></div>
        <?php echo validation_errors();?>
      </div>
    </div>