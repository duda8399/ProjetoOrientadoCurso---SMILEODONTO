<?php
	require_once("../../SMILEODONTO_PRIVATE/conexao.php");

		if(isset($_GET['sair'])){
			
			if($_GET['sair'] == 1){
				session_start();
				unset($_SESSION['adm']);
			    unset($_SESSION['funcionarioAdm']);
			    unset($_SESSION['usuarioAdm']);
			  	unset($_SESSION['senhaAdm']);
			    header('location:login.php');

			}else if($_GET['sair'] == 2){
				session_start();
			  	unset($_SESSION['dentista']);
			    unset($_SESSION['funcionarioD']);
			    unset($_SESSION['usuarioD']);
			  	unset($_SESSION['senhaD']);
			  	unset($_SESSION['paciente']);
			    header('location:login.php');

			}else if($_GET['sair'] == 3){
				session_start();
				unset($_SESSION['secretaria']);
			    unset($_SESSION['funcionarioS']);
			    unset($_SESSION['usuarioS']);
			  	unset($_SESSION['senhaS']);
			  	unset($_SESSION['pacienteS']);
			    header('location:login.php');
			}
		}

		$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

		if ($acao == 'listar') {

			$recuperar         = "SELECT *FROM cargo WHERE idCargo != 2 AND idCargo != 3 AND idCargo != 5 AND idCargo != 7 AND idCargo != 8";
			$recuperar_login   = mysqli_query($conecta,$recuperar);

			if(!$recuperar_login) {
			    header("Location: login.php?msg=5");
			}

		}else if ($acao == 'conferir') {

			if(!empty($_POST["usuario"])) {

		        $usuario   	   = $_POST["usuario"];
		        $senha     	   = $_POST["senha"];
		        $acesso        = $_POST["acesso"];

		        $conferir         = "SELECT distinct f.idFuncionario, c.idCargo, f.funUsuario, f.funSenha FROM funcionario f, cargo c WHERE f.funUsuario = '$usuario' AND f.funSenha = '$senha' AND c.idCargo = f.idCargo AND f.idCargo = '$acesso' ";
				$conferir_login   = mysqli_query($conecta,$conferir);
				$row_login = mysqli_fetch_assoc($conferir_login);

				if (!empty($row_login)) {

					if ($row_login['idCargo'] == '1') {
						session_start();

						$_SESSION['usuarioAdm']      = $row_login['funUsuario'];
						$_SESSION['senhaAdm']        = $row_login['funSenha'];
						$_SESSION['adm']             = $row_login['idCargo'];
						$_SESSION['funcionarioAdm']  = $row_login['idFuncionario'];
						header("Location: indexAdm.php");

					}else if ($row_login['idCargo'] == '4') {
						session_start();

						$_SESSION['usuarioD']      = $row_login['funUsuario'];
						$_SESSION['senhaD']        = $row_login['funSenha'];
						$_SESSION['dentista']      = $row_login['idCargo'];
						$_SESSION['funcionarioD']  = $row_login['idFuncionario'];
						header("Location: indexDentista.php");

					}else if ($row_login['idCargo'] == '6') {
						session_start();

						$_SESSION['usuarioS']      = $row_login['funUsuario'];
						$_SESSION['senhaS']        = $row_login['funSenha'];
						$_SESSION['secretaria']    = $row_login['idCargo'];
						$_SESSION['funcionarioS']  = $row_login['idFuncionario'];
						header("Location: indexSecret.php");
					}

				}else{
					header("Location: login.php?msg=3");
				}

		    }else{
		    	header("Location: login.php?msg=3");
		    }

		}

?>