<?php
include_once(PATH_MYSQL);
class Model_Tags{

	private static $instance; 	// ссылка на экземпляр класса
	private $msql; 				// драйвер БД

	public static function Instance()
	{
		if (self::$instance == null)
			self::$instance = new Model_Tags();
		
		return self::$instance;
	}

	public function __construct()
	{
		$this->msql = MSQL::Instance();
	}
	
	public function Get($id = NULL)
	{
		if($id == NULL) $t = "SELECT * FROM tags";
		else $t = sprintf("SELECT * FROM tags WHERE id='%d'", $id);
		$result = $this->msql->Select($t);
		return $result;
	}
	
	public function Check($tags, $id_gallery)
	{
		$tags = explode(",", $tags); 
		
		foreach($tags as $tag){
			$tag = mb_strtolower($tag,'UTF-8');
			$t = sprintf("SELECT * FROM tags WHERE tag_name='%s'", $tag);
			$res = $this->msql->Select($t);
			if(count($res)>0){
				$new_count = $res[0]['count']+1;
				$c = $this->msql->Update('tags', array('count'=>$new_count), sprintf("id = %d", $res[0]["id"]));
				if($c) $this->msql->Insert('tags_gallery', array('id_tags'=>$res[0]['id'],'id_gallery'=>$id_gallery));
			}else{
				$id_tag = $this->msql->Insert('tags', array('tag_name'=>$tag,'count'=>1));
				$this->msql->Insert('tags_gallery', array('id_tags'=>$id_tag,'id_gallery'=>$id_gallery));
			}
			
		}
		
		return true;
	}
}