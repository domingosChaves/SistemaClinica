<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Cadastro de Paciente</title>
	<link rel="stylesheet" type="text/css" href="bin/fonts/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="bin/fonts/bootstrap/css/bootstrap-reboot.min.css">
	<link rel="stylesheet" type="text/css" href="bin/fonts/fontawesome/css/all.min.css">
	<style type="text/css">
	body{
		padding: 2%;
	};

</style>
</head>
<body>
<form method="post" action="/bin/class/Paciente/Paciente.php" id="formCadPaciente">
	<fieldset style="padding: 2%;"><h4>Dados Pessoais:</h4>
		<div class="row" style="margin: 1% 0%;">
			<div class="col-3 form-floating">
				<input type="text" class="form-control" id="inputNome" placeholder="Seu nome" name="nome">
				<label style="margin-left: 2%;" for="inputNome">Nome</label>
			</div>
			<div class="col-7 form-floating">
				<input type="text" class="form-control" id="inputSobrenome" placeholder="Seu sobrenome" name="sobrenome">
				<label style="margin-left: 2%;" for="inputSobrome">Sobrenome</label>
			</div>
			<div class="col-2 form-floating">
				<input type="date" class="form-control" id="inputNascimento" placeholder="Data de Nascimento" name="nascimento">
				<label style="margin-left: 2%;" for="inputNascimento">Data de Nascimento</label>
			</div>
		</div>

		<div class="row" style="margin: 1% 0%;">
			<div class="col form-floating">
				<input type="text" class="form-control" id="inputRes1" placeholder="Responsável 01" name="res1">
				<label style="margin-left: 2%;" for="inputRes1">Responsável 01</label>
			</div>
			<div class="col form-floating">
				<input type="text" class="form-control" id="inputRes2" placeholder="Responsável 02" name="res2">
				<label style="margin-left: 2%;" for="inputRes2">Responsável 02</label>
			</div>
		</div>

		<div class="row" style="margin: 1% 0%;">
			<div class="col-4 form-floating">
				<input type="text" class="form-control" id="inputRg" placeholder="RG" name="rg">
				<label style="margin-left: 2%;" for="inputRg">RG</label>
			</div>
			<div class="col-4 form-floating">
				<input type="text" class="form-control" id="inputCpf" placeholder="CPF" name="cpf" data-mask="###.###.###-##" data-mask-reverse="true" data-mask-maxlength="14" >
				<label style="margin-left: 2%;" for="inputCpf">CPF</label>
			</div>

			<div class="col-4 form-floating">
				<select class="form-select" id="selectSexo" aria-label="sexo" name="sexo">
					<option selected value="M">Masculino</option>
					<option  value="F">Feminino</option>
				</select>
				<label style="margin-left: 2%;" for="selectSexo">Sexo</label>
			</div>
		</div>

		<div class="row" style="margin: 1% 0%;">
			<div class="col-2 form-floating">
				<input type="text" class="form-control" id="inputTel01" placeholder="Contato 01" name="tel1" data-mask="(00)00000-0000" data-mask-maxlength="14">
				<label style="margin-left: 2%;" for="inputTel01">Contato 01</label>
			</div> 
			<div class="col-2 form-floating">
				<input type="text" class="form-control" id="inputTel02" placeholder="Contato 02" name="tel2" data-mask="(00)00000-0000" data-mask-maxlength="14">
				<label style="margin-left: 2%;" for="inputTel02">Contato 02</label>
			</div>
			<div class="col-4 form-floating">
				<input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email">
				<label style="margin-left: 2%;" for="inputEmail">Email</label>
			</div>	
			<div class="col-2 form-floating">
				<input type="text" class="form-control" id="inputPeso" placeholder="Peso" name="peso" data-mask="000.000" data-mask-reverse="true">
				<label style="margin-left: 2%;" for="inputPeso">Peso (Kg)</label>
			</div>
			<div class="col-2 form-floating">
				<input type="text" class="form-control" id="inputAlt" placeholder="Altura" name="altura" data-mask="000">
				<label style="margin-left: 2%;" for="inputAlt">Altura (Cm)</label>
			</div>
			<div class="col-8"></div>
		</div>
	</fieldset>

	<fieldset style="padding: 2%;"><h4>Endereço:</h4>
		<div class="row" style="margin: 1% 0%;">
			<div class="col-5 form-floating">
				<input type="text" class="form-control" id="inputRua" placeholder="Rua" name="endereco">
				<label style="margin-left: 2%;" for="inputRua">Rua</label>
			</div>
			<div class="col-2 form-floating">
				<input type="text" class="form-control" id="inputNum" placeholder="Numero" name="numero">
				<label style="margin-left: 2%;" for="inputNum">Numero</label>
			</div>
			<div class="col-5 form-floating">
				<input type="text" class="form-control" id="inputCom" placeholder="Complemento" name="complemento">
				<label style="margin-left: 2%;" for="inputCom">Complemento</label>
			</div>
		</div>
		<div class="row" style="margin: 1% 0%;">	
			<div class="col-4 form-floating">
				<input type="text" class="form-control" id="inputBai" placeholder="Bairro" name="bairro">
				<label style="margin-left: 2%;" for="inputBai">Bairro</label>
			</div>
			<div class="col-2 form-floating">
				<input type="text" class="form-control" id="inputCep" placeholder="CEP" name="cep" data-mask="00000-000">
				<label style="margin-left: 2%;" for="inputCep">CEP</label>
			</div>
			<div class="col-3 form-floating">
				<select class="form-select" id="selectCidade" aria-label="Cidade" name="cidade">
				</select>
				<label style="margin-left: 2%;" for="selectCidade">Cidade</label>
			</div>
			<div class="col-3 form-floating">
				<select class="form-select" id="selectUf" aria-label="Estado" name="uf" onchange="CP.cidade(this.value)">
					<option selected value="">Selecione o estado</option>
				</select>
				<label style="margin-left: 2%;" for="selectUf">Estado</label>
			</div>
		</div>
	</fieldset>
	<div class="row" style="text-align: center; padding: 2%;">
		<div class="col-8"></div>
		<div class="col-2"><button class="btn btn-danger" type="button">Cancelar</button></div>
		<div class="col-2"><button class="btn btn-success" type="submit" value="cadastro">Salvar Paciente</button></div>
	</div>
</form>
<script type="text/javascript" src="bin/fonts/jquery/jquery.min.js"></script>
<script type="text/javascript" src="bin/fonts/bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="bin/fonts/mask/jquery.mask.js"></script>
<script type="text/javascript">
var CP = {
	cidade: function (id) {

			$.ajax({
				type:"post",
				url:"bin/class/Routes/Routes.php",
				data: [{name:"cidade", value:id}],
				dataType: "json",
				success: function(json) {
					$("#selectCidade").html('');
					for (var i = 0; i < json.length; i++) {
						var id = json[i]['id'];
						var nome = json[i]['nome'];
						$("#selectCidade").append('<option value="'+id+'">'+nome+'</option>');
					}
					
				}
			})
		},
	estado: function () {
			$.ajax({
				type:"post",
				url:"bin/class/Routes/Routes.php",
				data: [{name:"estado", value:""}],
				dataType: "json",
				success: function(json) {
					for (var i = 0; i < json.length; i++) {
						var id = json[i]['id'];
						var nome = json[i]['nome'];
						$("#selectUf").append('<option value="'+id+'">'+nome+'</option>');
					}
					
				}
			});
	},
	cadastro: function(dados){
		$.ajax({
				type:"post",
				url:"bin/class/Routes/Routes.php",
				data: dados,
				dataType: "json",
				success: function(json) {
					// for (var i = 0; i < json.length; i++) {
					// 	var id = json[i]['id'];
					// 	var nome = json[i]['nome'];
					// 	$("#selectUf").append('<option value="'+id+'">'+nome+'</option>');
					// }
					
				}
			});
	}
}

$(document).ready(function(){
	CP.estado();
	$("#formCadPaciente").submit(function(e){
		e.preventDefault();
		var form = $(this).serializeArray();
		form.push({'name':'cadastro','value':'paciente'})
		console.log(form);
		CP.cadastro(form);
		return false;
	})
})
</script>
</body>
</html>