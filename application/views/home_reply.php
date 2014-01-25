 <div class="container middle column">
      
      <h2 class="ui header">
        <i class="home icon"></i>
        <?php echo $user->username ?>的主页
      </h2>
	<div style="display: block;" class="ui grid">
      <div class="row">
      <div class="four wide column">
          <div class="ui raised segment">
            <div class="ui ribbon label">姓名</div>
            <p>
            	<?php if ($user->name): ?>
            		<?php echo $user->name ?>
            	<?php else: ?>
            		这是个懒虫，名字都不写~
            	<?php endif ?>
            </p>
            <div class="ui teal ribbon label">专业</div>
            <p>
            	<?php if ($user->major): ?>
            		<?php echo $user->major ?>
            	<?php else: ?>
            		这人好懒，专业都不写~
            	<?php endif ?>
            </p>
            <div class="ui red ribbon label">班级</div>
            <p>
            	<?php if ($user->class): ?>
            		<?php echo $user->class ?>
            	<?php else: ?>
            		简直太懒了，班级都不写，小伙伴们怎么找到你~
            	<?php endif ?>
            </p>
          </div>
        </div>
        <div class="twelve wide column">
          <div class="ui segment">
            <div class="ui top attached label"><?php echo $user->username ?>的回答</div>
            <div class="floating ui teal label"><?php echo count($replys) ?></div>
	            <div class="ui home list">
	            <?php if (isset($replys)): ?>
            	<?php $count = count($replys) ?>
            	<?php for ($i=0; $i < $count; $i++) { ?>
				  <div class="item">
				    <i class="mail outline icon"></i>
				    <div class="content">
				      <a class="header" href="<?php echo site_url("question/view_detail/".$replys[$i]->question_id);?>">
				      	<?php $query = $this->question_model->get_question_byId($replys[$i]->question_id);?>
				      	<?php echo $query->title; ?>
				      </a>
				      <div class="description"><?php echo $replys[$i]->content ?></div>
				    </div>
				  </div>
				<?php } ?>
           		<?php endif ?>
          		</div>
        	</div>
      </div>
    </div>
</div>
</div>