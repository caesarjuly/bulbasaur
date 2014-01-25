 <div class="container middle column">
      
      <h2 class="ui header">
        <i class="user icon"></i>
        用户管理
      </h2>
  <table class="ui table segment">
    <thead>
      <tr><th>用户名</th>
      <th>姓名</th>
      <th>专业</th>
      <th>班级</th>
      <th>管理</th>
    </tr></thead>
    <tbody>

      <?php  foreach ($users as $row) {?>
      <?php if ($row->is_admin != 1): ?>
          <tr>
          <td><?php echo $row->username;?></td>
          <td><?php echo $row->name;?></td>
          <td><?php echo $row->major;?></td>
          <td><?php echo $row->class;?></td>
          <td><a href="<?php echo site_url("user/view_change/$row->id");?>"><i class="edit icon"></i></a>
              <a href="<?php echo site_url("user/delete/$row->id");?>"><i class="remove icon"></i></a></td>
        </tr>
      <?php endif ?>
      <?php }?>
    </tbody>
    <tfoot>
      <tr><th colspan="5">
        <a class="ui blue labeled icon button" href="<?php echo site_url("user/view_add");?>"><i class="user icon"></i> 添加用户</a>
      </th>
    </tr></tfoot>
  </table>
  <?php echo $this->pagination->create_links();?>
  </div>