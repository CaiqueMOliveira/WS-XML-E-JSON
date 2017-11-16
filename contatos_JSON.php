<?php
$nome="";
$telefone="";
$celular="";
$email="";
$obs="";
$botao="Inserir";

//programação para inserir no xml
if (isset($_GET["btnsalvar"]))
{  
	//variaveis que vieram via 
	//GET no botao Salvar
	$nome=$_GET["txtnome"];
	$telefone=$_GET["txttelefone"];
	$celular=$_GET["txtcelular"];
	$email=$_GET["txtemail"];
	$obs=$_GET["txtobs"];
    
    // NOME DO ARQUIVO SERA CRIADO
    $nomeArquivo = "dados.json";
    
    // CRIA OU ABRE O ARQUIVO CASO JA EXISTA 
    $arquivo = fopen($nomeArquivo, "w");
    
    // CRIANDO UM array DE DADOS QUE SERA ARMAZENADO NO ARQUIVO JSON
    $arrayDados = array(
    
        "nome"=>$nome,
        "telefone"=>$telefone,
        "celular"=>$celular,
        "email"=>$email,
        "obs"=>$obs   
    );
    
    // PARA VISUALIZAR O CONTUDO DE UM OBJET,  UTILIZE O print_r OU var_dump (var_dump EXIBI MAIS DETALHES)
    // print_r($arrayDados);
    // var_dump($arrayDados);
    
    // GRAVANDO OS DADOS DO ARRAY EM FORMATO JSON NO ARQUIVO
    fwrite($arquivo, json_encode($arrayDados));
    
    //FECHANDO O ARQUIVO
    fclose($arquivo);
}	

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>

<div id="principal">
	
    
     <div id="conteudo">
    	<div id="cadastro">
        	
            <form name="frmcontatos" method="get" action="contatos_JSON.php">
            
                <table id="tblcadastro">
                  <tr>
                    <td colspan="2">Gerando JSON</td>
                  </tr>
                  <tr>
                    <td>Nome:</td>
                    <td><input class="caixa" name="txtnome" type="text"   value="<?php echo($nome) ?>" required /></td>
                  </tr>
                  <tr>
                    <td>Telefone:</td>
                    <td><input class="caixa" name="txttelefone" type="text"  value="<?php echo($telefone) ?>" /></td>
                  </tr>
                  <tr>
                    <td>Celular:</td>
                    <td><input class="caixa" name="txtcelular" type="text" value="<?php echo($celular) ?>" /></td>
                  </tr>
                  <tr>
                    <td>Email:</td>
                    <td><input class="caixa" name="txtemail" type="text" value="<?php echo($email) ?>" required /></td>
                  </tr>
                  <tr>
                    <td>Obs:</td>
                    <td><textarea name="txtobs" cols="20" rows="5"><?php echo($obs) ?></textarea></td>
                  </tr>
                  <tr>
                    <td><input name="btnsalvar" type="submit" value="<?php echo($botao) ?>" /></td>
                    <td><input name="btnlimpar" type="reset" value="Limpar" /></td>
                  </tr>
                </table>
            
            </form>

        </div>
        <div id="consulta">
        	<table id="tblconsulta">
              <tr>
                <td colspan="5">Consulta XML</td>
              </tr>
              <tr>
                <td>Nome</td>
                <td>Telefone</td>
                <td>Celular</td>
                <td>Email</td>
				<td>Obs</td>
               
              </tr>
			  <?php 
    
                /*
                CAMINHO DO ARQUIVO .json QUE SERA FEITO A LEITURA
                OBS.: E OBRIGATORIO O CAMINHO DA URL DO SITE ATE O ARQUIVO
                */
				$url="http://localhost/inf3m/turmaA/xml/dados.json";
                
                /*
                0 ou false - retorno caso falhe
                null - inicia a leitura dos dados a partir de um dado especifico  
                null - retornar o tamanho do arquivo
                */                               
                // RECUPERA OS DADOS DO ARQUIVO JSON PARA LEITURA
                $arquivoJSON = file_get_contents($url,0,null,null);
	            
                // CONVERTE OS DADOS EM FORMATO JSON PARA UM ARRAY
                $dadosArray = json_decode($arquivoJSON);
                               
                $qtdeItens = count($dadosArray);
                
                for($i = 0; $i < $qtdeItens; $i++){
                    
              ?>
				  <tr>
					<td><?php echo($dadosArray->nome) ?></td>
					<td><?php echo($dadosArray->telefone) ?></td>
					<td><?php echo($dadosArray->celular) ?></td>
					<td><?php echo($dadosArray->email) ?></td>
					<td><?php echo($dadosArray->obs) ?></td>
					
				  </tr>
            <?php 
                }
			?>
            </table>

        </div>
           
    </div>
    

    
</div>

</body>
</html>



