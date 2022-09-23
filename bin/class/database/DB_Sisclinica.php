<?php 

include_once "ConnDataBase.php";

class DB_Sisclinica extends ConnDataBase{

	public function estado(){
		try {
			 	$dados = array();
			 	$conn = $this->conn;
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
			      
			    $stmt = $conn->prepare("SELECT id,nome FROM estado ORDER BY nome ASC");
			    $stmt->execute();
	    
				while ($row = $stmt->fetch()) { $dados[] = array('id'=> $row['id'],'nome'=> $row['nome']);};
				$stmt = null;
				
				return $dados;


		} catch(PDOException $e) {
		    return 'ERROR ADD: ' . $e->getMessage();
		}
	}

	public function cidade($id){
		try {
				$dados = array();
			 	$conn = $this->conn;
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
			      
			    $stmt = $conn->prepare("SELECT id,nome FROM cidade WHERE uf = ? ORDER BY nome ASC");
			    $stmt->execute(array($id));
	    
				while ($row = $stmt->fetch()) { $dados[] = array('id'=> $row['id'],'nome'=> $row['nome']);};
				$stmt = null;
				
				return $dados;

		} catch(PDOException $e) {
		    echo 'ERROR ADD: ' . $e->getMessage();
		}
	}

	public function cadastro($dados){
		try {

			$dados = array();

			 	$conn = $this->conn;
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
			    $stmt = $conn->prepare(
			    	"INSERT INTO paciente 
			    	(
				    	nome_paciente, 
				    	sobrenome_paciente, 
				    	nascimento_paciente, 
				    	responsavel1_paciente, 
				    	responsavel2_paciente, 
				    	rg_paciente, 
				    	cpf_paciente, 
				    	sexo_paciente, 
				    	tel1_paciente, 
				    	tel2_paciente, 
				    	email_paciente, 
				    	peso_paciente, 
				    	altura_paciente,
				    	endereco_paciente, 
				    	numero_paciente, 
				    	complemento_paciente, 
				    	bairro_paciente, 
				    	cep_paciente, 
				    	cidade_paciente, 
				    	estado_paciente, 
				    	cadastro_paciente, 
				    	atualizacao_paciente, 
				    	sts_paciente
			    	) 
			    	VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);"
			    );

			    $stmt->execute();
	    		$dados = $stmt->fetch();
	    		if ($dados) {
	    			return 1;
	    		}else{
	    			return 0;
	    		}
				$stmt = null;

		} catch(PDOException $e) {
		    echo 'ERROR ADD: ' . $e->getMessage();
		}
	}


	public function cadastroPrefeitura(array $prefeitura){
		try {
	 	$conn = $this->conn;
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    



	    if (empty($prefeitura['login_hb']) && empty($prefeitura['recadastramento_rb'])) {

			$opt = 'DISABLED';
	    }else{
	    	if (!empty($prefeitura['login_hb']) && empty($prefeitura['recadastramento_rb'])) {
				$opt = 'LOG';
	    }elseif (empty($prefeitura['login_hb']) && !empty($prefeitura['recadastramento_rb'])) {
				$opt = 'REC';
	    	}elseif (!empty($prefeitura['login_hb']) && !empty($prefeitura['recadastramento_rb'])) {
				$opt = 'DUOS';
	    	}
	    }

	   

	    if (empty($prefeitura['id'])) {
	    	if (empty($prefeitura['logo'])) {
	    		$stmt = $conn->prepare("INSERT INTO prefeitura (tipo, prefeitura, estado, cnpj, opt, hash) VALUES (?, ?, ?, ?, ?, ?)");
			    $res = $stmt->execute(array($prefeitura['poderpublico'], $prefeitura['cidade'], $prefeitura['estado'], $prefeitura['cnpj'], $opt, md5($prefeitura['cnpj'])));

			if ($res) {
		    	return true;
		    }else{
		    	return false;
		    }

	    	} else {
	    		$stmt = $conn->prepare("INSERT INTO prefeitura (logo, tipo, prefeitura, estado, cnpj, opt, hash) VALUES (?, ?, ?, ?, ?, ?, ?)");
			    $res = $stmt->execute(array($prefeitura['logo'], $prefeitura['poderpublico'], $prefeitura['cidade'], $prefeitura['estado'], $prefeitura['cnpj'], $opt, md5($prefeitura['cnpj'])));
			if ($res) {
		    	return true;
		    }else{
		    	return false;
		    }

	    	}
	    	
	    
	    }else{
		
		$id = $prefeitura['id'];

		if (empty($prefeitura['logo'])) {
			$stmt = $conn->prepare("UPDATE prefeitura SET tipo = ?, prefeitura = ?, estado = ?, cnpj = ?, opt = ?, hash = ? WHERE (id = $id)");
		    $res =	$stmt->execute(array($prefeitura['poderpublico'], $prefeitura['cidade'], $prefeitura['estado'], $prefeitura['cnpj'], $opt, md5($prefeitura['cnpj'])));
		    if ($res) {
		    	return true;
		    }else{
		    	return false;
		    }
		
		} else {
			$stmt = $conn->prepare("UPDATE prefeitura SET logo = ?, tipo = ?, prefeitura = ?, estado = ?, cnpj = ?, opt = ?, hash = ? WHERE (id = $id)");
		    $res =	$stmt->execute(array($prefeitura['logo'],$prefeitura['poderpublico'], $prefeitura['cidade'], $prefeitura['estado'], $prefeitura['cnpj'], $opt, md5($prefeitura['cnpj'])));
		    if ($res) {
		    	return true;
		    }else{
		    	return false;
		    }
		}
		
		
	    }	   

	} catch(PDOException $e) {
	    // echo 'ERROR ADD: ' . $e->getMessage();
	    return false;
	}
	}
	public function DeletePrefeitura($id)
	{
		try {
		$conn = $this->conn;
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
	      
	    $stmt = $conn->prepare("DELETE FROM prefeitura WHERE id = ?");
	    $stmt->execute(array($id));
	    
	    $stmt = null;
	    return true;

		} catch(PDOException $e) {
		    echo 'ERROR ADD: ' . $e->getMessage();
		}
	}
}//Fim da Classe Prefeituras

class Login extends ConnDataBase{

	public function cpf(array $input){
			try {
		 	
		 	$conn = $this->conn;
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
		      
		    $stmt = $conn->prepare('SELECT * FROM servidor WHERE cpf = :InputCpf AND prefeitura IN(SELECT cnpj FROM prefeitura WHERE id = :Inputpref)');

		    
		    $stmt->execute(array('InputCpf'=>preg_replace('/[^0-9]/', '', $input['InputCpf']),'Inputpref'=>$input['Inputpref']));
		    $dados = $stmt->fetch();
				if ($dados) {

					$this->cpf_valid($dados);
				}else{
					return false;
					}

			} catch(PDOException $e) {
			    echo 'ERROR CPF: ' . $e->getMessage();
			}
	}//Fim da função cpf

	
	public function cpf_e(array $input){
			try {
		 	
		 	$cpf= preg_replace("/[^0-9]/","",$input["InputCpf"]);

		 	$conn = $this->conn;
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
		      
		   	$stmt = $conn->prepare("SELECT * FROM servidor WHERE cpf = :cpf ORDER BY id ASC ");

		   	$stmt->execute(array('cpf'=>$cpf));

				while($dados = $stmt->fetch()){
					$arr[] = $dados['prefeitura'];
				};

				return $arr;
				
			} catch(PDOException $e) {
			    echo 'ERROR CPF: ' . $e->getMessage();
			}
	}//Fim da função cpf

	public function cpf_rec(array $input){
			try {
		 	
		 	$conn = $this->conn;
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
		      
		    $stmt = $conn->prepare('UPDATE servidor SET status = "PENDENTE" WHERE cpf = :cpf AND prefeitura IN(SELECT cnpj FROM prefeitura WHERE id = :Inputpref)' );
		    $stmt->execute(array('cpf'=>$setpass['InputCpf_rec'],'Inputpref'=>$setpass['Inputpref']));

		    $dados = $stmt->fetch();
				if ($dados) {

					echo "P";
					// return true;
				}else{
					return false;
					}

			} catch(PDOException $e) {
			    echo 'ERROR CPF: ' . $e->getMessage();
			}
	}//Fim da função cpf_rec

	public function get_contact_user(array $input){
			try {
		 	
		 	$conn = $this->conn;
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
		      
		    $stmt = $conn->prepare('SELECT * FROM servidor WHERE id = :id');

		    $stmt->execute($input);
		    $dados = $stmt->fetch();

				if ($dados) {

			$base = array();
			$base['id'] = $dados['id'];
			$base['nome'] = $dados['nome'];
			$base['prefeitura'] = $dados['prefeitura'];
			$base['cpf'] = $dados['cpf'];
		    $base['tc'] = $dados['t_c'];
		    $base['ec'] = $dados['e_c'];
		    $base['status'] = $dados['status'];
		   	$base['senha'] = $dados['senha'];


					// substr_replace($mail, '*****', 1, strpos($mail, '@') - 2)

					if ($dados['tel']) {
						$base['tel'] = $dados['tel'];
					} else {
						$base['tel'] = 'Null';
					}
					if ($dados['email']) {

						$base['email'] = $dados['email'];

					} else {

						$base['email'] = 'Null';
					}
				
					return $base;

				}else{
					return false;
					}

			} catch(PDOException $e) {
			    echo 'ERROR USER: ' . $e->getMessage();
			}
	}//Fim da função get_contact_rec

	public function get_contact_rec(array $input){
			try {
		 	
		 	$conn = $this->conn;
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
		      
		    $stmt = $conn->prepare('SELECT * FROM servidor WHERE cpf = :InputCpf AND prefeitura IN(SELECT cnpj FROM prefeitura WHERE id = :Inputpref)');

		    $stmt->execute($input);
		    $dados = $stmt->fetch();

				if ($dados) {

			$base = array();
		    $base['status'] = $dados['status'];		
					// substr_replace($mail, '*****', 1, strpos($mail, '@') - 2)

					if ($dados['tel'] && $dados['t_c'] === 'true') {
						$base['tel'] = substr_replace($dados['tel'], ' **** - ',2, 5);
					} else {
						$base['tel'] = 'Null';
					}
					if ($dados['email'] && $dados['e_c']  === 'true') {
						$mail = $dados['email'];
						$base['email'] = substr_replace($mail, '****', 2, strpos($mail, '@') - 2);
					} else {
						$base['email'] = 'Null';
					}
				
					return $base;

				}else{
					return false;
					}

			} catch(PDOException $e) {
			    echo 'ERROR CPF: ' . $e->getMessage();
			}
	}//Fim da função get_contact_rec

	public function get_contact_res(array $input){
			try {
		 	
		 	$conn = $this->conn;
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
		      
		    $stmt = $conn->prepare('SELECT * FROM servidor WHERE cpf = :InputCpf AND prefeitura IN(SELECT cnpj FROM prefeitura WHERE id = :Inputpref)');

		    $stmt->execute(array('InputCpf'=>$input['cpf'],'Inputpref'=>$input['Inputpref']));
		    $dados = $stmt->fetch();

				if ($dados) {
				$pp = array();
				$pp['ip'] = $input['ip'];
				$pp['cpf'] = $dados['cpf'];

			if ($input['token_envio'] == 'tel') {
					$pp['tipo'] = 'tel';
					$pp['dados'] = $dados['tel'];

					return $pp;

				}elseif ($input['token_envio'] == 'email') {
					$pp['tipo'] = 'email';
					$pp['dados'] = $dados['email'];

					return $pp;

				}	

				}else{
					return false;
					}

			} catch(PDOException $e) {
			    echo 'ERROR CPF: ' . $e->getMessage();
			}
	}//Fim da função get_contact_res

	public function cpf_valid(array $input){
		try {
		 	
		// var_dump($input);

		if ($input['status'] == 'CADASTRADO') {
		 print_r('C');

		 // return true;

		}else{
		 print_r('P');

		 // return false; 
		}

			} catch(PDOException $e) {
			    echo 'ERROR VALID CPF: ' . $e->getMessage();
			}
	}//Fim da função cpf_valid

	public function verificacaoUsuario(array $input){
		// var_dump($input);
			try {
		 	
		 	// $conn = $this->conn;
		  //   $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
		      
		  //   $stmt = $conn->prepare('SELECT senha FROM servidor WHERE senha = :InputPass_first');
		  //   $stmt->execute(array('InputPass_first'=>$input['InputPass_first']));
				// if ($stmt->fetch()) {
					return true;

				// $stmt_v = $conn->prepare('SELECT senha FROM servidor WHERE cpf = :cpf AND senha = :InputPass_first');
		  //   		$stmt_v->execute(array('cpf'=> $input['cpf'], 'InputPass_first'=>$input['InputPass_first']));

		  //   			if ($stmt_v->fetch()) {
		    				// return true;
		    			// }else{
		    			// 	return false;
		    			// }


				// }else{
				// 	return true;
				// }

		} catch(PDOException $e) {
		    echo 'ERROR VERIFICADOR USUARIO: ' . $e->getMessage();
		}
	}//Fim da função verificacaoUsuario

	public function verifyContact(array $input){

		$res = array();

		try {
			 	
			$conn = $this->conn;
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    

				if (!isset($input['tel'])) {$res['tel'] = null;	}
				else{ 					
					if(is_null($input['tel']) || $input['tel'] !== ''){



						$tel = $conn->prepare('SELECT tel FROM servidor WHERE tel = ?');
						$tel->execute(array($input['tel']));


						if ($tel->fetch()) {

										// echo "Numero na base, espere um pouco... \n";

							$tel_use = $conn->prepare('SELECT tel FROM servidor WHERE tel = ? AND cpf =?');
							$tel_use->execute(array($input['tel'], $input['cpf']));

							if ($tel_use->fetch()) {
							    			// echo "voce esta usando esse contato em outra conta \n";
								$res['tel'] = true;
							}else{
							    			// echo "outra pessoa ultiliza esse contato \n ";
								$res['tel'] = false;

							}

						}else{
										// echo "pode cadastrar o telefone \n";
							$res['tel'] = true;
						}

					}
				}
			
				if (!isset($input['email'])) {
					$res['email'] = null;
				}else{
					if(is_null($input['email']) || $input['email'] !== ''){

						$dominio=explode('@',$input['email']);
						if(!checkdnsrr($dominio[1],'MX')){

							$res['email'] = null;
							$res['email_error'] = true;

						}else{

							$email = $conn->prepare('SELECT email FROM servidor WHERE email = ?');
							$email->execute(array($input['email']));
							if ($email->fetch()) {

								// echo "Email na base, espere um pouco... \n";

								$email_use = $conn->prepare('SELECT email FROM servidor WHERE email = ? AND cpf =?');
								$email_use->execute(array($input['email'], $input['cpf']));

								if ($email_use->fetch()) {
					    			// echo "voce esta usando esse contato de email em outra conta \n ";
									$res['email'] = true;
								}else{
					    			// echo "outra pessoa ultiliza esse email de contato \n";
									$res['email'] = false;
								}

							}else{
								// echo "pode cadastrar o email \n";
								$res['email'] = true;
							}
						}

					}

				}

				if (isset($input['codigo'])) {
					
						    $codigo = $conn->prepare('SELECT token_Contact FROM validcontact WHERE token_Contact = ?');
					    	$codigo->execute(array($input['codigo']));
							if ($codigo->fetch()) {

								// echo "Codigo na base, espere um pouco... \n";

								$cod_use = $conn->prepare('UPDATE validcontact SET status_Contact = 1 WHERE key_Contact = :id AND token_Contact = :token_Contact ;');
					    		$cod_up = $cod_use->execute(array('token_Contact'=>$input['codigo'],'id'=>$input['id']));

					    		if ($cod_up) {
					    			// echo "codigo validado com sucesso \n";
					    			session_start();
							    	$_SESSION['t_c'] = 'true';

					    			$res['codigo'] = true;
					    		}else{
					    			// echo "erro na validação do codigo \n";
					    			$res['codigo'] = false;
					    		}
					    		
							}else{
								// echo "Codigo não encontrado na base \n";
								$res['codigo'] = false;
							}


				}
				if (isset($input['senha'])) {

					if ($this->verificacaoUsuario(array('cpf'=>$input['cpf'],'InputPass_first'=>$input['senha']))) {

					// echo "Senha liberada pode cadastrar \n";	
					$res['senha'] = true;
					}else{

					// echo "Senha não está liberada para cadastro \n";	
					$res['senha'] = true;
					}
					

				}

				return $res;

			} catch(PDOException $e) {
			    echo 'ERROR VERIFICADOR TELEFONE: ' .$e->getMessage();
			}
	}//Fim da função verifyContact

	public function setPass(array $setpass){
		$json['post'] = $setpass;
		try {
		 	
			if(isset($setpass['tel'])){

				$setpass['tel'] = preg_replace('/[^0-9]/', '', $setpass['tel']);

				switch ($setpass['tel']) {
					case null:
						$tc = 'false';
						$json['tc_json'] = null;
						break;
					case '':
						$tc = 'false';
						$json['tc_json'] = 'vazio';
						break;
					default:
						$tc = 'true';
						$json['tc_json'] = true;
						break;
				};

				}else{
					$tc = 'false';
					$json['tc_json'] = false;
				}

			if(isset($setpass['email'])){

				switch ($setpass['email']) {
					case null:
						$ec = 'false';
						$json['ec_json'] = null;
						break;
					case '':
						$ec = 'false';
						$json['ec_json'] = 'vazio';
						break;
					default:
						$ec = 'true';
						$json['ec_json'] = true;
						break;
				};

				}else{
					$ec = 'false';
					$json['ec_json'] = false;
				};

		 	$conn = $this->conn;

		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  

		    $stmt = $conn->prepare('
							    	UPDATE 
							    		servidor 
							    	SET 
								    	senha = :InputPass_first, 
								    	status = "CADASTRADO", 
								    	tel= :tel, 
								    	t_c = :tc, 
								    	email= :email, 
								    	e_c = :ec 
							    	WHERE 
							    		cpf = :cpf 
							    	AND 
							    		prefeitura 
							    	IN(
							    		SELECT 
							    			cnpj 
							    		FROM 
							    			prefeitura 
							    		WHERE 
							    			id = :Inputpref)' 	
							    	);

			$json['new'] = array(
		    		'InputPass_first'=>$setpass['InputPass_first'],
		    		'tel'=>$setpass['tel'], 
		    		'tc'=> $tc, 
		    		'email'=>$setpass['email'],
		    		'ec' => $ec,
		    		'cpf'=>$setpass['cpf'],
		    		'Inputpref'=>$setpass['Inputpref']
		    	);				    

		    $update = $stmt->execute(
		    	array(
		    		'InputPass_first'=>$setpass['InputPass_first'],
		    		'tel'=>$setpass['tel'], 
		    		'tc'=> $tc, 
		    		'email'=>$setpass['email'],
		    		'ec' => $ec,
		    		'cpf'=>$setpass['cpf'],
		    		'Inputpref'=>$setpass['Inputpref']
		    	)
		    );

		    if ($update) {
		    	return true;
		    }else{
		    	return false;
		    }
		    
		    // return $json;

			} catch(PDOException $e) {
			    echo 'ERROR CADASTRO LOG: ' . $e->getMessage();
			}
	}//Fim da função setPass

	public function setUpPass(array $setpass){

		try {
		 	
		 	$conn = $this->conn;
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
		    $stmt = $conn->prepare('UPDATE servidor SET senha = :InputPass_first WHERE cpf = :cpf AND prefeitura IN(SELECT cnpj FROM prefeitura WHERE id = :Inputpref)' );
		    $update = $stmt->execute(array('InputPass_first'=>$setpass['InputPass_first'],'cpf'=>$setpass['cpf'],'Inputpref'=>$setpass['Inputpref']));

		    if ($update) {
		    	return true;
		    }else{
		    	return false;
		    }

			} catch(PDOException $e) {
			    echo 'ERROR UPDATE LOG: ' . $e->getMessage();
			}
	}//Fim da função setUpPass

	public function setUpUser(array $upuser){

		try {
		 	
		 	$conn = $this->conn;
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		    $stmt = $conn->prepare('UPDATE servidor SET senha = null ,status = "PENDENTE", tel= 0, t_c = "false",email= null,e_c = "false" WHERE id = :id ');
		    $update = $stmt->execute(array('id'=>$upuser['id']));

		    if ($update) {
		    	return true;
		    }else{
		    	return false;
		    }

			} catch(PDOException $e) {
			    echo 'ERROR UPDATE LOG: ' . $e->getMessage();
			}
	}//Fim da função setUpUser
	
	public function login_(array $input){
			try {
		 	
		 	$conn = $this->conn;
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
		      
		    $user=$conn->prepare("SELECT * FROM servidor WHERE cpf = :Inputcpf AND senha = :InputPass AND prefeitura IN(SELECT cnpj FROM prefeitura WHERE id = :Inputpref);");
		    $user->execute(array('Inputcpf'=>$input['Inputcpf'],'InputPass'=>$input['InputPass'], 'Inputpref'=>$input['Inputpref']));

		    $acesso = $user->fetch();

		    
		    if($acesso){
		    	session_start();
		    	// session_name(md5($acesso['cpf'].date('d/m/y h:m:s')));
		    						$_SESSION["id"] = $acesso['id'];
									$_SESSION["cpf"] = $acesso['cpf'];
									$_SESSION["nome"] = $acesso['nome'];
									$_SESSION["servidor"] = $acesso['user'];
									$_SESSION["prefeitura"]= $acesso['prefeitura'];
									$_SESSION['t_c'] = $acesso['t_c'];
									$_SESSION['e_c'] = $acesso['e_c'];
									$_SESSION["tipo"] = 'servidor';
									if ($acesso['t_c'] === 'false' || $acesso['e_c'] === 'false') {
									$_SESSION['aviso'] = 0;
									}else{
									$_SESSION['aviso'] = 1;	
									}

									echo "ACCEPT";
		    }else{
		    	echo "DENIED";
		    }


			} catch(PDOException $e) {
			    echo 'ERROR LOGIN: ' . $e->getMessage();
			}
	}//Fim da função login_

	public function Info(array $input){
			try {

		    // var_dump($input);
		 	$conn = $this->conn;
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
		      
			$servidor = $conn->prepare('SELECT nome,cpf FROM servidor WHERE cpf = :InputCpf AND prefeitura IN(SELECT cnpj FROM prefeitura WHERE id = :Inputpref)');

		    $prefeitura = $conn->prepare('SELECT prefeitura,estado,tipo FROM prefeitura WHERE id = :Inputpref');


		    $servidor->execute(array('InputCpf'=>preg_replace('/[^0-9]/', '', $input['InputCpf']),'Inputpref'=>$input['Inputpref']));

		    $prefeitura->execute(array('Inputpref'=>$input['Inputpref']));

		   	$dados_servidor = $servidor->fetch();
		   	$dados_prefeitura = $prefeitura->fetch();

		   	// var_dump($dados_servidor,$dados_prefeitura);

		   	$dados = array();

		   	$dados['servidor'] = $dados_servidor;
		   	$dados['prefeitura'] = $dados_prefeitura;

		   	return $dados;

			} catch(PDOException $e) {
			    echo 'ERROR LOGIN: ' . $e->getMessage();
			}
	}//Fim da função Info

	public function alterPhone(array $input){
			try {
		 	
		 	$conn = $this->conn;
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

			$tel_v = $conn->prepare('SELECT tel FROM servidor WHERE id = :id ;');

		    $tel_ = $tel_v->execute(array('id'=>$input['id']));
			
			$dados_TEL = $tel_v->fetch();
			
			 $tel = $conn->prepare('UPDATE servidor SET tel= :tel, t_c = :tc WHERE id = :id ;');

		    $tel_update = $tel->execute(array('tel'=>$input['tel'],'tc'=>'false','id'=>$input['id']));

		    if ($tel_update) {
		    	return true;
		    }else{
		    	return false;
		    }	

			
		   

			} catch(PDOException $e) {
			    echo 'ERROR UPATE TELEFONHE LOG: ' . $e->getMessage();
			}
	}//Fim da função alterPhone

	public function alterEmail(array $input){ 
		try {
		 	
		 	$conn = $this->conn;
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

		    $email = $conn->prepare('UPDATE servidor SET email= :email, e_c = :ec WHERE id = :id ;');

		    $email_update = $email->execute(array('email'=>$input['email'],'ec'=>'false','id'=>$input['id']));


		    if ($email_update) {
		    	return true;
		    }else{
		    	return false;
		    }

			} catch(PDOException $e) {
			    echo 'ERROR UPATE EMAIL LOG: ' . $e->getMessage();
			}
	}//Fim da função alterEmail

	public function alterPassword(array $input){
			try {
		 	
		 	$conn = $this->conn;
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

		    $senha = $conn->prepare('UPDATE servidor SET senha = :senha WHERE id = :id ;');

		    $senha_update = $senha->execute(array('senha'=>$input['senha'],'id'=>$input['id']));


		    if ($senha_update) {
		    	return true;
		    }else{
		    	return true;
		    }

			} catch(PDOException $e) {
			    echo 'ERROR UPATE senha LOG: ' . $e->getMessage();
			}
	}//Fim da função alterPassword

	public function alterCodigoTel(array $input){
			try {
		 	
		 	$conn = $this->conn;
		    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 

		    $codigo = $conn->prepare('UPDATE servidor SET t_c = "true" WHERE id = :id');

		    $codigo_up = $codigo->execute(array('id'=>$input['id']));


		    if ($codigo_up) {
		    	return true;
		    	// echo "string 1";
		    }else{
		    	return false;
		    	// echo "string 0";
		    }

			} catch(PDOException $e) {
			    echo 'ERROR UPATE senha LOG: ' . $e->getMessage();
			}
	}//Fim da função alterCodigoTel

	public function validContact(array $input){
		try {
		 	

		date_default_timezone_set('America/Belem');

		$id = $input['id'];
		$cpf = $input['cpf'];
		$campo = $input['campo'];
		$dados = $input['dados'];
		$data = date('d/m/y h:m:s');


		if ($campo === 't_c') {
			$valid['token_Contact'] = strtoupper(substr(md5(date("YmdHis").$cpf), 1, 6));
		}else{
			$valid['token_Contact'] = md5($id.$cpf.$campo.$dados.$data);
		}

		
		$valid['key_Contact'] = $id;
		$valid['type_Contact'] = $campo;
		$valid['data'] = $data;

			
						$conn = $this->conn;
					    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
					    $stmt = $conn->prepare('INSERT INTO validcontact (
							    	token_Contact,
							    	key_Contact,
							    	type_Contact,
							    	data
							    	) 
					    	VALUES (
							    	:token,
									:key,
									:type,
									:data);');

					    
					    if ($stmt->execute(array('token'=> $valid['token_Contact'],'key'=>$valid['key_Contact'],'type'=>$valid['type_Contact'],'data'=>$valid['data']))) {

					    	$return = array(true,$valid['token_Contact'],$dados);

					    }else{
					    	$return = array(true);
					    }

					    return $return;

		} catch(PDOException $e) {
		    echo 'ERROR ADD: ' . $e->getMessage();
		}
	}//Fim da função validContact

	public function valiteGet(array $get){
		try {
		 	
			$conn = $this->conn;
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$valid_get = $conn->prepare('SELECT * FROM validcontact WHERE token_Contact = :h');

			$valid_get->execute($get);
			$select_valid = $valid_get->fetch();

				if ($select_valid) {

					$cod_use = $conn->prepare('UPDATE validcontact SET status_Contact = 1 WHERE token_Contact = :h;');
					$cod_up = $cod_use->execute($get);

					    if ($cod_up) {
					    			
							$contato= $conn->prepare('UPDATE servidor SET e_c = "true" WHERE id = ?;');

				    		$contato_up = $contato->execute(array($select_valid['key_Contact']));

							    if ($contato_up) {
							    	session_start();
							    	$_SESSION['e_c'] = 'true';
							    	return true;
							    }else{
							    	return false;
							    }
							}
					  	
					  	else{	return false;	}

				    }else{ 	return false;   }

			} catch(PDOException $e) {echo 'ERROR UPATE EMAIL LOG: ' . $e->getMessage();}
	}//Fim da função valiteGet
}//Fim da Classe Login



class Lista extends ConnDataBase
{

	public function ListaServidor($servidor){

		$Pesquisar = new Pesquisar();

		$list = array();
		$nome = "";
		$cpf = "";

		$datas = "";
		$matricula = "";
		$competencia = "";
		$pagina = $servidor['pagina'];
		$itens_por_pagina = 50;

		try {
	 	$conn = $this->conn;
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    
	      
	    $usuario = $conn->prepare("SELECT nome,cpf FROM usuarios_servidor WHERE id = :id");
	    $usuario->execute(array('id'=> $servidor['id']));
	
	    // print_r($usuario->fetch());

		while ($user = $usuario->fetch()) {		$nome = $user['nome'];		$cpf = $user['cpf'];    };
    
	    $usuario = null;
		

		if (empty($servidor['data']) or $servidor['data'] == "") {}else{
		}
		if (empty($servidor['matricula']) or $servidor['matricula'] == "0") {}else{
			$matricula = "AND matricula = '".$servidor['matricula']."'";
		}

		if (empty($servidor['competencia']) or $servidor['competencia'] == "0") {}else{
			$competencia = "AND competencia = '".$servidor['competencia']."'";
		}


		if (empty($servidor['data'])) {
			$contracheque = $conn->prepare("SELECT id,data,matricula,competencia FROM dados_contracheque WHERE cpf = ? AND poderpublico = ?".$matricula.$competencia." LIMIT $pagina, $itens_por_pagina");

		}else{
			$contracheque = $conn->prepare("SELECT id,data,matricula,competencia FROM dados_contracheque WHERE data like '%".$servidor["data"]."%' AND cpf = ? AND poderpublico = ?".$matricula.$competencia." LIMIT $pagina, $itens_por_pagina");
		}
			$contracheque->execute(array($cpf,$servidor['pp']));	 

			$num_t = $contracheque->rowCount();
			$num_paginas = ceil($num_t/$itens_por_pagina);
		// print_r($contracheque->fetch());

		while ($contra = $contracheque->fetch()){ $list[] = array('id'=>$contra['id'],'data'=>date('d/m/Y', strtotime($contra['data'])),'matricula'=>$contra['matricula'],
			'competencia'=>$contra['competencia'],'nome'=>$nome,'cpf'=>$cpf,'poderpublico'=>$servidor['pp']) ; };
		$contracheque = null;		

		// print_r($list);


		$pag = array('itens'=>$itens_por_pagina,'pagina'=>$pagina,'num_pag'=>$num_paginas);

		// print_r($pag);

		$this->ListaViewServidor($list,$pag);

			} catch(PDOException $e) {
			    echo 'ERROR ADD: ' . $e->getMessage();
			}
	}

	public function ListaAdministrador(array $dados){

		
	    $list = array();
	    $pag = array();

	    $data = "";
	    $competencia = "";
	    $poderpublico = "";
	    $nome = "";
	    $adm ="";

		try {
			$conn = $this->conn;
	    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    

			$num_total = $conn->prepare("SELECT COUNT(*) FROM arquivo");
			$num_total->execute();

			$num_t = $num_total->fetch();
			$itens_por_pagina = 100;
			$pagina = $dados['pagina'];
			$num_paginas = ceil($num_t[0]/$itens_por_pagina);


			// if(empty($dados['data'])){}else{				$data = $dados['data'];			}
			// if(empty($dados['competencia'])){}else{			$competencia = "AND dados_contracheque.competencia = '".$dados['competencia']."'";}
			// if(empty($dados['poderpublico'])){}else{		$poderpublico = "AND dados_contracheque.poderpublico = '".$dados['poderpublico']."'";}
			// if(empty($dados['servidor'])){}else{			$nome = $dados['servidor'];}
			// if(empty($dados['administradores'])){}else{		$adm = "AND dados_contracheque.adm_post = '".$dados['administradores']."'";}

			$contracheque = $conn->prepare("SELECT 
			arquivo.id,
			arquivo.prefeitura,
			arquivo.competencia,
			arquivo.cpf,
			arquivo.matricula,
			arquivo.arquivo,
			arquivo.data,
			arquivo.emissor,
			arquivo.status,
			arquivo.view,
			servidor.nome,
			servidor.cpf,
			servidor.prefeitura
			FROM  
			forthin_forth.arquivo 
			INNER JOIN 
			(forthin_forth.servidor)
			ON  
			arquivo.cpf = servidor.cpf AND arquivo.prefeitura = servidor.prefeitura ORDER BY id DESC LIMIT ".$pagina.", ".$itens_por_pagina);
			$contracheque->execute();
			
			while ($res = $contracheque->fetch()) {
						$list[] = array('id'=> $res['id'],
										'prefeitura'=> $res['prefeitura'],
										'competencia'=>$res['competencia'],
										'cpf'=> $res['cpf'],
										'matricula'=> $res['matricula'],
										'arquivo'=> $res['arquivo'],
										'data'=> $res['data'],
										'emissor'=> $res['emissor'],
										'status'=> $res['status'],
										'view'=> $res['view'],
										'nome'=> $res['nome']); 
				
		};
			

			$contracheque = null;

				// var_dump($list);

				$pag = array('itens'=>$itens_por_pagina,'pagina'=>$pagina,'num_pag'=>$num_paginas,'total_rows'=>$num_t[0]);

				$this->ListaView($list,$pag);

			} catch(PDOException $e) {			    echo 'ERROR ADD: ' . $e->getMessage();			}
	}


	public function formatCnpjCpf($value){
	  $cnpj_cpf = preg_replace("/\D/", '', $value);
	  
	  if (strlen($cnpj_cpf) === 11) {
	    return preg_replace("/(\d{3})(\d{3})(\d{3})(\d{2})/", "\$1.\$2.\$3-\$4", $cnpj_cpf);
	  } 
	  
	  return preg_replace("/(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})/", "\$1.\$2.\$3/\$4-\$5", $cnpj_cpf);
	}
    
    public function mask($val, $mask){
             $maskared = '';
            $k = 0;
            for($i = 0; $i<=strlen($mask)-1; $i++){ if($mask[$i] == '#') { if(isset($val[$k])) 
                $maskared .= $val[$k++];
                     }
            else {
                if(isset($mask[$i]))
                     $maskared .= $mask[$i];
            }
         }    
         return $maskared;
    }

	public function ListaView(array $listas,array $pag)	{

		// print_r($listas);

		// var_dump($Listas);
		$ultima_pagina = 0;
		echo '<form method="POST" action="#" id="list_contracheques">';
		echo '<table class="table" cellspacing="0" cellpadding="0" style="width: 100%">
		     <thead>

		        <tr>
		            <th style="text-align:center;font-size: 14px"><i class="fas fa-calendar-day"></i> Data</th>
		            <th style="text-align:center;font-size: 14px"><i class="fas fa-calendar-alt"></i> Competência</th>
		            <th style="text-align:center;font-size: 14px"><i class="fas fa-id-card"></i> Documento</th>
		            <th style="text-align:center;font-size: 14px"><i class="fas fa-user"></i> Nome do Sevidor</th>
		            <th style="text-align:center;font-size: 14px"><i class="fas fa-user-edit"></i> Matrícula</th>
		            <th style="text-align:center;font-size: 14px"><i class="fas fa-bolt"></i> Ações</th>
		        </tr>
		</thead>
		<tbody id="timeline" style="position: relative; top: 65px;">';

			foreach ($listas as $contra) {

				echo "  <tr id='rows'>
						<td style='text-align:center;font-size: 12px' width='10%' >".$contra['data']."</td>
						<td style='text-align:center;font-size: 12px' width='10%'>".$this->mask($contra['competencia'],'##/####')."</td>
						<td style='text-align:center;font-size: 12px' width='10%'>". $this->formatCnpjCpf($contra['cpf'])."</td>
						<td style='text-align:left;font-size: 12px' width='50%'>".$contra['nome']."</td>
						<td style='text-align:center;font-size: 12px' width='10%'>".$contra['matricula']."</td>
						<td style='text-align:center;font-size: 14px' width='10%'>
							<a href='../../model/Contracheque/Contracheque.php/?!=".$contra['id']."' target='_blank' class='icon'><i class='fas fa-eye'></i></a>
							<a href='JavaScript:Contracheque.Excluir(".$contra['id'].")' style='color: #dc3545'><i class='fas fa-trash-alt'></i></a>
							<input type='checkbox' name='excluir[]' value='".$contra['id']."'  checked='true' style='display:none'>
						</td>
						</tr>";
						}


		echo '</tbody>		</table>';
		echo "</form>";

		echo '
		<nav style="position: fixed; bottom: 2vh; left:45vw" id="nav_pagina">
		  <ul class="pagination">
		    <li class="page-item">
		      <a class="page-link" href="#"><i class="fas fa-backward"></i></a>
		    </li> 
		    <li>
		    	<a class="page-link" href="#"><i class="fas fa-search"></i></a>
		    </li>
		    <li class="page-item">
		      <a class="page-link" href="#"><i class="fas fa-forward"></i></a>
		    </li>
		  </ul>
		</nav>
		';
	}

	public function ListaViewServidor(array $listas,array $pag){

		// print_r($listas);

		// var_dump($Listas);
		$ultima_pagina = 0;

		echo '<table class="table" cellspacing="0" cellpadding="0" style="width: 100%">
		     <thead>

		        <tr>
		            <th style="text-align: center;"><i class="fas fa-calendar-day"></i> Data</th>
		            <th style="text-align: center;"><i class="fas fa-calendar-alt"></i> Competência</th>
		            <th style=""><i class="fas fa-id-card"></i> Documento</th>
		            <th style=""><i class="fas fa-user"></i> Nome do Sevidor</th>
		            <th style="text-align: center;"><i class="fas fa-user-edit"></i> Matrícula</th>
		            <th style="text-align: center;"><i class="fas fa-bolt"></i> Ações</th>
		        </tr>
		</thead>
		<tbody id="timeline" style="position: relative; top: 65px;">';

			foreach ($listas as $contra) {

				echo "  <tr>
						<td align='center'>".$contra['data']."</td>
						<td align='center'>".$contra['competencia']."</td>
						<td align=''>". $this->formatCnpjCpf($contra['cpf'])."</td>
						<td align='' width='30%'>".$contra['nome']."</td>
						<td align='center' width='10%'>".$contra['matricula']."</td>
						<td  align='center' width='20%'>
							<a href='../../model/Contracheque/Contracheque.php/?!=".$contra['id']."' target='_blank' class='icon'><i class='fas fa-eye'></i></a>						</td>
						</tr>";
						}


		echo '</tbody>
		</table>';

		echo '
		<nav style="position: fixed; bottom: 65px;" id="nav_pagina">
		  <ul class="pagination">
		    <li class="page-item">
		      <a class="page-link" href="JavaScript:Contracheque.Pagina(0)"><i class="fas fa-backward"></i></a>
		    </li>';

		for ($i=0;$i<$pag['num_pag'];$i++) { 
			$estilo = "";
			$style = "";
			if($pag['pagina'] == $pag['itens']*$i){
			$estilo = "active";
			$style = ' style="background:#272930"';
		}
			echo '<li class="page-item '.$estilo.'"><a class="page-link" '.$style.' href="JavaScript:Contracheque.Pagina('.($pag['itens']*$i).')">'.($i+1).'</a></li>';

			$ultima_pagina = $pag['itens']*$i;
		}    
		echo '  
		    <li class="page-item">
		      <a class="page-link" href="#"><i class="fas fa-forward"></i></a>
		    </li>
		  </ul>
		</nav>
		';

		}
	}

?>
