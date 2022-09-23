<?php 
/**
 * 
 */
class Routes
{
	function __construct()
	{
		$this->route($_POST);
	}
	private function route($post){
		if(isset($post['estado'])){
			echo $this->classe("estado","");
		}
		if(isset($post['cidade'])){
			echo $this->classe("cidade",$post['cidade']);
		}
		if(isset($post['cadastro'])){
			echo $this->classe("cadastro",$post);
		}
	}
	private function classe($classe,$value){
		switch($classe){
			case "estado": 
			require_once '../database/DB_Sisclinica.php';
			$db = new DB_Sisclinica();
			return json_encode($db->estado());
			break;
			case "cidade": 
			require_once '../database/DB_Sisclinica.php';
			$db = new DB_Sisclinica();
			return json_encode($db->cidade($value));
			break;
			case "cadastro": 
			require_once '../Paciente/Paciente.php';
			$db = new Paciente();
			return json_encode($db->cadastrar($value));
			break;
		}
	}
}
new Routes();
?>