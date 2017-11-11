<?phpinclude_once(PATH_CONT.'Controller_Base.php');class Controller_Gallery extends Controller_Base{	function action_index(){		$this->title = "Главная страница галереи";		$tag = "";				include PATH_MODL."Model_Tags.php";				$model  = Model_Gallery::Instance();		$model_tags = Model_Tags::Instance();				$tags = $model_tags->get();				if ($this->IsGet() && isset($_GET['tag']) && !empty($_GET['tag']))		{					$tag = $this->preparation($_GET['tag'],"string");			$this->title = "Галерея - ".$tag;				if (isset($tag) && !empty($tag)) {				$items = $model->getByTag($tag);			}		}else{			$items = $model->get();		}		$data = array("items"=>$items,"tag_name"=>$tag,"tags"=>$tags);		$this->content=$this->View(PATH_VIEW.'gallery/gallery.php', $data);	}	function action_add(){				if ($this->IsPost())		{						include PATH_LIB."Images.php";			include PATH_MODL."Model_Tags.php";			$model  = Model_Gallery::Instance();			$model_tags = Model_Tags::Instance();			if(isset($_POST['task']) && $_POST['task'] == "add"){				if(isset($_POST['tags']) && !empty($_POST['tags'])){					$tags = $this->preparation($_POST['tags'],"string");								if (isset($_FILES["file"])) {						$images = Images::Instance();												if($path_full_images = $images->UploadImages($_FILES["file"]["tmp_name"],$_FILES["file"]["name"],"/images/full/",$_FILES["file"]["size"])){							if($path_mini_images = $images->ResizeImage(ABSOLUTE_PATH.$path_full_images['path'],'/images/mini/',$path_full_images['name'])){								$data = array("path" => $path_full_images['path'], "path_mini" => $path_mini_images, "filename" => $path_full_images['name'], "size"=> $_FILES["file"]["size"], "width" => $path_full_images['width'], "height" => $path_full_images['height']);							}						}else{							$this->error = "Ошибка проверьте формат картинки (jpg,png.gif) и размер не более 1мб";						}					}					if(isset($data) && is_array($data)){						if($id_gallery = $model->Add($data)){							if($model_tags->Check($tags, $id_gallery)){								header('Location: http://'.$_SERVER['HTTP_HOST']);								exit();							}						}					}									}			}			$tag = $this->preparation($_GET['tag'],"string");			$this->title = "Галерея - ".$tag;				if (isset($tag) && !empty($tag)) {				$items = $model->getByTag($tag);			}		}		$this->title = "Добавить картинку";		$this->content=$this->View(PATH_VIEW.'gallery/add.php');	}}