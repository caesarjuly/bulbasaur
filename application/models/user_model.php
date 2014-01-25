<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 用户模型
 */
class User_model extends CI_Model {
	/**
   * [__construct 构造函数]
   */
  public function __construct()
  {
  	parent::__construct();
  }
  /**
   * [获得用户]
   * @param  [limit] [每页限制]
   * @param  [offset] [偏移]
   * @return [结果集] [分页用户]
   */
  public function get_user($limit, $offset)
  {
    $this->db->limit($limit, $offset);
  	$query = $this->db->get('user');
  	return $query->result();
  }
  /**
   * [根据ID获得用户]
   * @param  [id] [用户id]
   * @return [用户对象] [用户信息]
   */
  public function get_user_byId($id)
  {
    $this->db->where('id', $id);
    $query = $this->db->get('user');
    return $query->row();
  }

  /**
   * [验证用户登录]
   * @param  [user] [用户登录信息]
   * @return [boolean] [TRUE OR FALSE]
   */
  public function checkin($user)
  {
    $this->db->where($user);
    $user_result = $this->db->get('user');

    if ($user_result->result()) {
      $user_info = $user_result->row();
      $login_info = array(
                    'id' => $user_info->id, 
                    'username' => $user_info->username,
                    'name' => $user_info->name,
                    'major' => $user_info->major,
                    'class' => $user_info->class,
                    'is_logged' => TRUE
                    );
      if ($user_info->is_admin == 1) {
        $login_info['is_admin'] = TRUE;
      }
      
      $this->session->set_userdata( $login_info );
      return TRUE;
    }
    else{
      return FALSE;
    }
  }
  /**
   * [添加单个用户]
   * @param  [user] [用户信息]
   * @return [boolean] [TRUE OR FALSE]
   */
  public function add_user($user)
  {
    return $this->db->insert('user', $user);
  
  }
  /**
   * [统计用户数]
   * @return [num] [用户数量]
   */
  public function count_user()
  {
    $query = $this->db->get('user');
    return $query->num_rows();
  }
  /**
   * [删除用户]
   * @param  [id] [用户id]
   * @return [boolean] [TRUE OR FALSE]
   */
  public function delete_user($id)
  {
    $this->db->where('user_id', $id);
    if ($this->db->delete('reply')) {
      $this->db->where('user_id', $id);
      if ($this->db->delete('question')) {
        $this->db->where('id', $id);
        if ($this->db->delete('user')) {
          return TURE;
        }
      }
    }
    return FALSE;
  }
  /**
   * [修改用户]
   * @param  [id] [用户id]
   * @param  [user] [用户信息]
   * @return [boolean] [TRUE OR FALSE]
   */
  public function change_user($id, $user)
  {
    $this->db->where('id', $id);
    $query = $this->db->update('user', $user);
    return $query;
  }
    /**
   * [修改管理员]
   * @param  [id] [管理员id]
   * @param  [admin] [管理员信息]
   * @return [boolean] [TRUE OR FALSE]
   */
  public function change_admin($id, $admin)
  {
    $this->db->where('id', $id);
    $query = $this->db->update('user', $admin);
    return $query;
  }


}

/* End of file user_model.php */
/* Location: ./application/models/user_model.php */