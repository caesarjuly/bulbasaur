<?php 
    $config = array(
               array(
                     'field'   => 'username',
                     'label'   => '用户名',
                     'rules'   => 'trim|required|max_length[45]|xss_clean'
                  ),
               array(
                     'field'   => 'password',
                     'label'   => '密码',
                     'rules'   => 'trim|required|min_length[6]|max_length[45]|xss_clean|sha1'
                  )

            );