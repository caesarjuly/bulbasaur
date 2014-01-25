<script type="text/javascript">
  $(document)
  .ready(function() {
    
   $('.ui.form')
  .form({
    title: {
      identifier : 'title',
      rules: [
        {
          type   : 'empty',
          prompt : '请输入问题'
        },
        {
          type   : 'length[6]',
          prompt : '问题至少6位'
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
        <i class="add icon"></i>
        提问
      </h2>
      <div class="ui form segment">
      <form action="<?php echo site_url("/question/add/");?>" method="post">
          <div class="field">
            <label>问题</label>
            <input placeholder="Title" name="title" type="text" value="<?php echo set_value('title'); ?>">
          </div>
          <div class="field">
            <label>问题说明：</label>
            <textarea placeholder="Content" id="editor" name="content" type="text" value=""></textarea>
          </div>
        <input class="ui blue submit button" type="submit" value="提交">
        </form>
        <div class="ui error message"></div>
        <?php echo validation_errors();?>
      </div>
    </div>