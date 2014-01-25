<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

	/**
	 * [添加回复]
	 * @param  [id] [问题id]
	 * @return [view] [问题页面]
	 */
	if ( ! function_exists('convert_time'))
	{
		function convert_time($time)
		{
			$second = time()-$time;
			$minute = floor($second/60);
	        $hour = floor($minute/60);
	        $day = floor($hour/24);
	        if ($second<60) {
	          echo $second.'秒前';
	        }
	        if ($minute<60 && $minute>0) {
	          echo $minute.'分钟前';
	        }
	        if ($hour<24 && $hour>0) {
	          echo $hour.'小时前';
	        }
	        if ($day>0) {
	          echo $day.'天前';
	        }
		}
	}


/* End of file MY_time_helper.php */
/* Location: ./system/helpers/MY_time_helper.php */