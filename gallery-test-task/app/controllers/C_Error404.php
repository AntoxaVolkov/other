<?phpinclude_once(PATH_CONT.'C_Base.php');//// ����������� �������� ������.//class C_Error404 extends C_Base{	//	// �����������.	//	function __construct()	{			}		//	// ����������� ���������� �������.	//	protected function OnInput()	{		parent::OnInput();		$this->title = $this->title . ' :: 404.';	}		//	// ����������� ��������� HTML.	//		protected function OnOutput()	{		$vars = array();			$this->content = $this->View(PATH_VIEW.'v_404.php', $vars);		parent::OnOutput();	}	}