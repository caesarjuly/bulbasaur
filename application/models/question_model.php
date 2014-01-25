<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * 问题模型
 */
class Question_model extends CI_Model {
	/**
   * [__construct 构造函数]
   */
  public function __construct()
  {
  	parent::__construct();
  }
  /**
   * [获得问题]
   * @param  [limit] [每页限制]
   * @param  [offset] [偏移]
   * @return [结果集] [分页问题]
   */
  public function get_question($limit, $offset)
  {
    $this->db->order_by("create_time", "desc"); 
    $this->db->join('user', 'question.user_id = user.id');
    $this->db->limit($limit, $offset);
    $this->db->select('question.id as question_id, user.id as user_id, create_time, title, content, reply_num, username, change_time');
  	$query = $this->db->get('question');
  	return $query->result();
  }
    /**
   * [添加问题]
   * @param  [question] [问题]
   * @return [boolean] [TRUE or FALSE]
   */
  public function add_question($question)
  {
    return $this->db->insert('question', $question);
  }
   /**
   * [统计问题数]
   * @return [num] [问题数量]
   */
  public function count_question()
  {
    $query = $this->db->get('question');
    return $query->num_rows();
  }
   /**
   * [通过id获取问题]
   * @param  [id] [问题id]
   * @return [问题对象] [问题信息]
   */
  public function get_question_byId($id)
  {
    $this->db->where('id', $id);
    $query = $this->db->get('question');
    return $query->row();
  }
  /**
   * [通过用户id获取问题]
   * @param  [id] [用户id]
   * @return [结果集] [问题信息]
   */
  public function get_question_byUser($id)
  {
    $this->db->where('user_id', $id);
    $query = $this->db->get('question');
    return $query->result();
  }
  /**
   * [通过id删除问题]
   * @param  [id] [问题id]
   * @return [boolean] [TRUE OR FALSE]
   */
  public function delete_question($id)
  {
    $this->db->where('question_id', $id);
    if ($this->db->delete('reply')) {
      $this->db->where('id', $id);
      if ($this->db->delete('question')) {
        return TRUE;
      }
    }
    return FALSE;
  }
  /**
   * [编辑问题]
   * @param  [id] [问题id]
   * @param  [question] [问题]
   * @return [boolean] [TRUE OR FALSE]
   */
  public function change_question($id, $question)
  {
      $this->db->where('id', $id);
      return $this->db->update('question', $question);
  }


}

/* End of file question_model.php */
/* Location: ./application/models/question_model.php */