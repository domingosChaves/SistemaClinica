<?php 
require '../database/ConnDataBase.php';
/**
 * 
 */
class Paciente extends ConnDataBase
{
	
	// function __construct()
	// {
	// 	$this->id_paciente = "";
	// 	$this->nome_paciente = "";
	// 	$this->sobrenome_paciente = "";
	// 	$this->nascimento_paciente = "";
	// 	$this->responsavel1_paciente = "";
	// 	$this->responsavel2_paciente = "";
	// 	$this->rg_paciente = "";
	// 	$this->cpf_paciente = "";
	// 	$this->sexo_paciente = "";
	// 	$this->tel1_paciente = "";
	// 	$this->tel2_paciente = "";
	// 	$this->email_paciente = "";
	// 	$this->peso_paciente = "";
	// 	$this->altura_paciente = "";
	// 	$this->endereco_paciente = "";
	// 	$this->numero_paciente = "";
	// 	$this->complemento_paciente = "";
	// 	$this->bairro_paciente = "";
	// 	$this->cep_paciente = "";
	// 	$this->cidade_paciente = "";
	// 	$this->estado_paciente = "";
	// 	$this->cadastro_paciente = "";
	// 	$this->atualizacao_paciente = "";
	// 	$this->sts_paciente = "";
	// 	$this->db = new ConnDataBase();
	// 	$this->conn = $this->db->conn;
	// 	$this->dados[] = array();
	// }

	public function listar($post){
		try {	
			$conn = $this->conn;
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			if($post){
				$sql = "SELECT * FROM paciente WHERE ".$post['query']." = ".$post['data'];
			}else{
				$sql = "SELECT * FROM paciente" ;		    	
			}

			$stmt = $conn->prepare($sql);
			$stmt->execute();

			while ($row = $stmt->fetch()) {

				$dados = 	array(	"lista_pasciente" =>
					array(	"id_paciente" => $row['id_paciente'],
						"nome_paciente" => $row['nome_paciente'],
						"sobrenome_paciente" => $row['sobrenome_paciente'],
						"nascimento_paciente" => $row['nascimento_paciente'],
						"responsavel1_paciente" => $row['responsavel1_paciente'],
						"responsavel2_paciente" => $row['responsavel2_paciente'],
						"rg_paciente" => $row['rg_paciente'],
						"cpf_paciente" => $row['cpf_paciente'],
						"sexo_paciente" => $row['sexo_paciente'],
						"tel1_paciente" => $row['tel1_paciente'],
						"tel2_paciente" => $row['tel2_paciente'],
						"email_paciente" => $row['email_paciente'],
						"peso_paciente" => $row['peso_paciente'],
						"altura_paciente" => $row['altura_paciente'],
						"endereco_paciente" => $row['endereco_paciente'],
						"numero_paciente" => $row['numero_paciente'],
						"complemento_paciente" => $row['complemento_paciente'],
						"bairro_paciente" => $row['bairro_paciente'],
						"cep_paciente" => $row['cep_paciente'],
						"cidade_paciente" => $row['cidade_paciente'],
						"estado_paciente" => $row['estado_paciente'],
						"cadastro_paciente" => $row['cadastro_paciente'],
						"atualizacao_paciente" => $row['atualizacao_paciente'],
						"sts_paciente" => $row['sts_paciente']
					)
				);

			};
			$stmt = null;
			return $dados;
		} catch(PDOException $e) {
			echo 'ERROR ADD: ' . $e->getMessage();
		}
	}
	public function cadastrar($post){
		try {
			if (!empty($post)) {
				$sql = 'INSERT INTO paciente (
				"nome_paciente",
				"sobrenome_paciente",
				"nascimento_paciente",
				"responsavel1_paciente",
				"responsavel2_paciente",
				"rg_paciente",
				"cpf_paciente",
				"sexo_paciente",
				"tel1_paciente",
				"tel2_paciente",
				"email_paciente",
				"peso_paciente",
				"altura_paciente",
				"endereco_paciente",
				"numero_paciente",
				"complemento_paciente",
				"bairro_paciente",
				"cep_paciente",
				"cidade_paciente",
				"estado_paciente",
				"cadastro_paciente")
				VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)';
				$execute = array(
					"nome_paciente" => $post['nome'],
					"sobrenome_paciente" => $post['sobrenome'],
					"nascimento_paciente" => $post['nascimento'],
					"responsavel1_paciente" => $post['res1'],
					"responsavel2_paciente" => $post['res2'],
					"rg_paciente" => $post['rg'],
					"cpf_paciente" => $post['cpf'],
					"sexo_paciente" => $post['sexo'],
					"tel1_paciente" => $post['tel1'],
					"tel2_paciente" => $post['tel2'],
					"email_paciente" => $post['email'],
					"peso_paciente" => $post['peso'],
					"altura_paciente" => $post['altura'],
					"endereco_paciente" => $post['endereco'],
					"numero_paciente" => $post['numero'],
					"complemento_paciente" => $post['complemento'],
					"bairro_paciente" => $post['bairro'],
					"cep_paciente" => $post['cep'],
					"cidade_paciente" => $post['cidade'],
					"estado_paciente" => $post['estado'],
					"cadastro_paciente" => "now()"
				);

				$conn = $this->conn;
				$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$stmt = $conn->prepare($sql);
				$stmt->execute($execute);

				if($stmt->fetch()){
					return array("cadastro"=> 1);
				}else{
					return array("cadastro"=> 0);
				}
				
			}
		} catch (PDOException $e) {

			return array("cadastro"=> 0);
		}

	}
}

 ?>