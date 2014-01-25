<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 回复模型
 */
class Reply_model extends CI_Model {
	/**
   * [__construct 构造函数]
   */
  public function __construct()
  {
  	parent::__construct();
  }
  /**
   * [添加回复]
   * @param  [reply] [回复信息]
   * @return [boolean] [TRUE OR FALSE]
   */
  public function add_reply($reply)
  {
    if ($this->db->insert('reply', $reply)) {
      $this->db->set('reply_num', 'reply_num+1', FALSE);
      $this->db->where('id', $reply['question_id']);
      if ($this->db->update('question')) {
        return TRUE;
      }
    }
    else
    {
      return FALSE;
    }
  }
  /**
   * [通过id获取回复]
   * @param  [id] [回复id]
   * @return [回复对象] [回复信息]
   */
  public function get_reply_byId($id)
  {
    $this->db->where('id', $id);
    $query = $this->db->get('reply');
    return $query->row();
  }
   /**
   * [通过问题id获取回复]
   * @param  [id] [问题id]
   * @return [结果集] [回复]
   */
  public function get_reply_byQuestion($id)
  {
    $this->db->where('question_id', $id);
    $query = $this->db->get('reply');
    return $query->result();
  }
  /**
   * [通过用户id获取回复]
   * @param  [id] [用户id]
   * @return [结果集] [回复信息]
   */
  public function get_reply_byUser($id)
  {
    $this->db->where('user_id', $id);
    $query = $this->db->get('reply');
    return $query->result();
  }
  /**
   * [通过id删除回复]
   * @param  [id] [回复id]
   * @return [boolean] [TRUE OR FALSE]
   */
  public function delete_reply($reply_id, $question_id)
  {
    $this->db->where('id', $reply_id);
    if ($this->db->delete('reply')) {
      $this->db->set('reply_num', 'reply_num-1', FALSE);
      $this->db->where('id', $question_id);
      if ($this->db->update('question')) {
        return TRUE;
      }
    }
    else
    {
      return FALSE;
    }
  }
  /**
   * [编辑回复]
   * @param  [id] [回复id]
   * @param  [reply] [回复信息]
   * @return [boolean] [TRUE OR FALSE]
   */
  public function change_reply($id, $reply)
  {
      $this->db->where('id', $id);
      return $this->db->update('reply', $reply);
  }

}

/* End of file reply_model.php */
/* Location: ./application/models/reply_model.php */