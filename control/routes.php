<?php 
session_start();
require_once('../util/inc.php');
new IncSys(array('repo'),"php");
$conn = new ConMySQL(GHOST,GNAME,GPASS,GDB);
switch ($_POST['type']) {
	case 'mainview':
		$sql = "SELECT * FROM tbl_usuario_tipo_coleta WHERE codigo_usuario = '".$_POST['code']."'";
		$redirect = "main";
	break;
	case 'mycols':
		$sql = "SELECT * FROM tbl_usuario_tipo_coleta WHERE codigo_usuario = '".$_POST['code']."'";
		$redirect = "coletas";
	break;
	case 'firstaccess':
		$sql = "SELECT nome,descricao FROM tbl_categoria_coleta";
		$redirect = "main";
	break;
	case 'newcol':
		$sql = "SELECT * FROM tbl_categoria_coleta WHERE codigo = '".$_POST['code']."'";
		$redirect = "nova-coleta";
	break;
	case 'coleta_edit':
		$sql = "SELECT * FROM tbl_usuario_tipo_coleta WHERE codigo = '".str_replace("edit_","",$_POST['code'])."'";
		$redirect = "nova-coleta";
	break;
	default:
		$sql = "";
		$redirect = "";
	break;
}
$dataset = array();
if(!empty($sql)){
	$dataset[0] = 1;
	$dataset[1] = $redirect;
	$usrsession = $_SESSION['main']['user'];
	$dataset[2] = $usrsession;
	$dtini = $_SESSION['main']['dt'];
	$dataset[3] = $dtini;
	$_SESSION['main']['table'][$dtini][$usrsession] = "";
	$rs = $conn->lookup($sql);
	if(!empty($rs[0][0])){
		if($_POST['type']=='mainview' || $_POST['type']=='mycols'){
			if(isset($_SESSION['main']['empresa']) && $_SESSION['main']['empresa']==true){
				$sql = "SELECT codigo_coleta FROM tbl_usuario_tipo_coleta WHERE codigo_usuario = '".$usrsession."' AND coleta_ativa = 'S'";
				$ds = $conn->lookup($sql);
				if(!empty($ds[0][0]) && isset($ds[0][0])){
					$like = "";
					foreach($ds as $values){
						$like .= $values[0].',';	
					}
					$like = substr($like,0,-1);
					$sql = "SELECT codigo_coleta,codigo_usuario,dia_padrao,lixo_cheio,codigo FROM tbl_usuario_tipo_coleta WHERE 
					codigo_coleta IN (".$like.") AND codigo_usuario <> '".$usrsession."' AND coleta_ativa = 'S'";
					$rs = $conn->lookup($sql);
					$tbl_content = "";
					if(isset($rs[0][0]) && !empty($rs[0][0])){
						foreach($rs as $values){
							$sql = "SELECT nome FROM tbl_categoria_coleta WHERE codigo = '".$values[0]."'";
							$ts = $conn->lookup($sql);
							$nome_coleta = $ts[0][0];
							$sql = "SELECT endereco, cidade, cep FROM tbl_usuarios WHERE codigo = '".$values[1]."'";
							$ts = $conn->lookup($sql);
							$usr_end = $ts[0][0];
							$usr_rua = $ts[0][1];
							$usr_cep = $ts[0][2];
							$tbl_content .= "<tr>";
							$tbl_content .= "<td>".$nome_coleta."</td>";
							$tbl_content .= "<td>".$values[2]."</td>";
							$tbl_content .= "<td>";
							$tbl_content .= ($values[3]=='S' ? "CHEIO" : "" );
							$tbl_content .= "</td>";
							$tbl_content .= "<td>".$usr_end."</td>";
							$tbl_content .= "<td>".$usr_rua."</td>";
							$tbl_content .= "<td>".$usr_cep."</td>";
							$tbl_content .= "<td>";

							$sql = "SELECT COUNT(*),coleta_ativa,coleta_feita FROM tbl_usuario_catador_coleta WHERE codigo_catador = '".$usrsession."' AND codigo_coleta = '".$values[4]."'";
							$cs = $conn->lookup($sql);
							
							$lclass1 = "COLETAR";
							$class1 = "";
							$class2 = " disabled";
							$generalclass = "btnrequestcoleta";
							if($cs[0][0]==1){
								if($cs[0][1]=="S"){
									$lclass1 = "FINALIZAR COLETA";
									$class1 = "";
									$class2 = "";
									$generalclass = "btnfinalizacoleta";
								}else if($cs[0][1]=="P"){
									$lclass1 = "AGUARDANDO AUTORIZAÇÃO";
									$class1 = " disabled";
									$generalclass = "";
								}else{
									$lclass1 = "NEGADO";
									$class1 = " disabled";
									$generalclass = "";
								}
								if($cs[0][2] == 'S'){
									$lclass1 = "COLETA FINALIZADA";
									$class1 = " disabled";
									$generalclass = "";
									$class2 = "";
								}
							}
							
							$tbl_content .= "<button id='req_".$values[4]."' name='req_".$values[4]."' class='btn btn-warning ".$generalclass."' ".$class1.">".$lclass1."</button>";
							$tbl_content .= "<td><button id='rating_".$values[4]."' name='rating_".$values[4]."' class='btn btn-primary btnratingpj'".$class2." >AVALIAR</button></td>";
					$_SESSION['main']['table'][$dtini][$usrsession] .= "</tr>";
							$tbl_content .= "</td>";
							$tbl_content .= "</tr>";
						}
					}
				}
				
				$_SESSION['main']['table'][$dtini][$usrsession] .= "
					<thead>
					<tr>
						<th>TIPO</th>
						<th>DIA</th>
						<th>LIXEIRA</th>
						<th>ENDEREÇO</th>
						<th>CIDADE</th>
						<th>CEP</th>
						<th></th>
					</tr>
					</thead>
					<tbody>
				";
				$_SESSION['main']['table'][$dtini][$usrsession] .= $tbl_content;
			}else{
				$_SESSION['main']['table'][$dtini][$usrsession] .= "
					<thead>
					<tr>
						<th>TIPO</th>
						<th>LIXO CHEIO</th>
						<th>DIA PREFERIDO</th>
						<th></th>
						<th></th>
						<th></th>
					</tr>
					</thead>
					<tbody>
					";
				foreach($rs as $values){
					$sql = "SELECT nome FROM tbl_categoria_coleta WHERE codigo = ".$values[2];
					$ds = $conn->lookup($sql);
					$_SESSION['main']['table'][$dtini][$usrsession] .="
					<tr>
					<td>".$ds[0][0]."</td>
					<td>".($values[4]=='S' ? "SIM" : "NÃO" )."</td>
					<td>".$values[5]."</td>
					<td>".($values[3]=='S' ? "<button type='button' id='".$values[0]."' name='".$values[0]."' class='btn btn-danger btn-disable' >DESATIVAR</button>" : "<button type='button' name='".$values[0]."' id='".$values[0]."' class='btn btn-success btn-enable' >ATIVAR</button>" )."</td>
					";
					if($values[3]=='S'){
						$classdis = "";
					}else{
						$classdis = "disabled";
					}
					$_SESSION['main']['table'][$dtini][$usrsession] .= "<td><button id='edit_".$values[0]."' name='edit_".$values[0]."' type='button' class='btn btn-warning btn-edit' ".$classdis.">EDITAR</button></td>";

					$sql = "SELECT COUNT(*),coleta_ativa,coleta_feita FROM tbl_usuario_catador_coleta WHERE codigo_usuario = '".$usrsession."' AND codigo_coleta = '".$values[0]."'";

					$cs = $conn->lookup($sql);
					
					$class1 = "disabled";
					$class2 = "disabled";
					$lclass1 = "AUTORIZAR";
					$btnclass = "btnauthusergarbage";
					$lclass2 = "AVALIAR";
					$btnclass2 = "";
					if($cs[0][0]==1){
						if($cs[0][1]=="P" || $cs[0][1]=='N'){
							$class1 = "";
							$lclass1 = "AUTORIZAR";
							$btnclass = "btnauthusergarbage";

						}elseif($cs[0][1]=='S'){
							$class1 = " disabled";
							$lclass1 = "AUTORIZADO";
							$btnclass = "";
						}
						if($cs[0][2]=='S'){
							$class2 = "";
							$lclass2= "AVALIAR";
							$btnclass2 = "btnratingusergarbage";
							$lclass1 = "COLETADO";
							$btnclass = "";
							$class1 = "disabled";
						}
					}
					$_SESSION['main']['table'][$dtini][$usrsession] .= "<td><button id='auth_".$values[0]."' name='auth_".$values[0]."' class='btn btn-info ".$btnclass."' ".$class1." >".$lclass1."</button></td>";
					$_SESSION['main']['table'][$dtini][$usrsession] .= "<td><button id='rating_".$values[0]."' name='rating_".$values[0]."' class='btn btn-primary ".$btnclass2."' ".$class2." >".$lclass2."</button></td>";
					$_SESSION['main']['table'][$dtini][$usrsession] .= "</tr>";
				}
				
				$_SESSION['main']['table'][$dtini][$usrsession] .= "</tbody>";
			}
			$_SESSION['main']['table']['mycols'][$dtini][$usrsession] = $_SESSION['main']['table'][$dtini][$usrsession];
		}elseif($_POST['type']=='newcol'){
			$rs = $conn->lookup($sql);
			$_SESSION['main']['newcol'][$dtini][$usrsession] = true;
			$_SESSION['main']['newcol']['code'][$dtini][$usrsession] = $rs[0][0];
			$_SESSION['main']['newcol']['name'][$dtini][$usrsession] = $rs[0][1];
			$_SESSION['main']['newcol']['desc'][$dtini][$usrsession] = $rs[0][2];
		}else if($_POST['type'] == 'coleta_edit'){
			$ds = $conn->lookup("SELECT nome FROM tbl_categoria_coleta WHERE codigo = ". $rs[0][2]);
			$rs[0][2] = $ds[0][0];
			$_SESSION['main']['newcol'][$dtini][$usrsession] = true;
			$_SESSION['main']['newcol']['edit'][$dtini][$usrsession] = true;
			$_SESSION['main']['newcol']['code'][$dtini][$usrsession] = $rs[0][0];
			$_SESSION['main']['newcol']['cod_usu'][$dtini][$usrsession] = $rs[0][1];
			$_SESSION['main']['newcol']['cod_coleta'][$dtini][$usrsession] = $rs[0][2];
			$_SESSION['main']['newcol']['col_ativa'][$dtini][$usrsession] = $rs[0][3];
			$_SESSION['main']['newcol']['lixo'][$dtini][$usrsession] = $rs[0][4];
			$_SESSION['main']['newcol']['dia'][$dtini][$usrsession] = $rs[0][5];
		}
	}else{
		$sql = "SELECT nome,descricao,codigo FROM tbl_categoria_coleta";
		$rs = $conn->lookup($sql);
		//if($_POST['type']=='firstaccess' || $_POST['type']){
		$_SESSION['main']['table'][$dtini][$usrsession] .= "
				<thead>
				<tr>
					<th>NOME</th>
					<th>DESCRIÇÃO</th>
					<th></th>
				</tr>
				</thead>
				<tbody>
				";
		if(isset($_SESSION['main']['empresa']) && $_SESSION['main']['empresa']==true){
			foreach($rs as $values){
				$_SESSION['main']['table'][$dtini][$usrsession] .= "<tr>";
				$_SESSION['main']['table'][$dtini][$usrsession] .= "<td>".$values[0]."</td>";
				$_SESSION['main']['table'][$dtini][$usrsession] .= "<td>".$values[1]."</td>";
				$_SESSION['main']['table'][$dtini][$usrsession] .= "<td><button name='pj_".$values[2]."' id='pj_".$values[2]."' type='button' class='btn btn-success' >ATIVAR</button></td>";
				$_SESSION['main']['table'][$dtini][$usrsession] .= "</tr>";
			}
		}else{
			foreach($rs as $values){
				$_SESSION['main']['table'][$dtini][$usrsession] .= "<tr>";
				$_SESSION['main']['table'][$dtini][$usrsession] .= "<td>".$values[0]."</td>";
				$_SESSION['main']['table'][$dtini][$usrsession] .= "<td>".$values[1]."</td>";
				$_SESSION['main']['table'][$dtini][$usrsession] .= "<td><button id='".$values[2]."' type='button' class='btn btn-success tblcolbtncol' >ATIVAR</button></td>";
				$_SESSION['main']['table'][$dtini][$usrsession] .= "</tr>";
			}
		}
		$_SESSION['main']['table'][$dtini][$usrsession] .= "</tbody>";
		//}
	}
$sql = "SELECT nome,descricao,codigo FROM tbl_categoria_coleta";
$rs = $conn->lookup($sql);
$_SESSION['main']['table']['default'][$dtini][$usrsession] = "
<div class='row'>
	<div class='col-lg-12 mx-auto text-center'>
		<table class='table table-bordered'>
			<thead>
				<tr>
					<th>TIPOS DE COLETA</th>
				</tr>
			</thead>
		</table>
		<table class='table table-striped'>
			<thead>
				<tr>
				<th>NOME</th>
				<th>DESCRIÇÃO</th>
				<th></th>
				</tr>
			</thead>
		<tbody>
";
if(isset($_SESSION['main']['empresa']) && $_SESSION['main']['empresa']==true){
	foreach($rs as $values){
		$sql = "SELECT coleta_ativa FROM tbl_usuario_tipo_coleta WHERE codigo_usuario = '".$usrsession."' AND codigo_coleta = '".$values[2]."'";
	$ds = $conn->lookup($sql);	
	if(!isset($ds[0][0]) || empty($ds[0][0])){
		$coleta  = "btn-success btnpjcoleta";
		$label = "ATIVAR";
	}elseif($ds[0][0]=='S'){
		$coleta = "btn-danger disablecoletapj";
		$label = "DESATIVAR";
	}elseif($ds[0][0]=='N'){
		$coleta = "btn-success enablecoletapj";
		$label = "ATIVAR";
	}

		$_SESSION['main']['table']['default'][$dtini][$usrsession] .= "<tr>";
		$_SESSION['main']['table']['default'][$dtini][$usrsession] .= "<td>".$values[0]."</td>";
		$_SESSION['main']['table']['default'][$dtini][$usrsession] .= "<td>".$values[1]."</td>";
		$_SESSION['main']['table']['default'][$dtini][$usrsession] .= "<td><button id='pj_".$values[2]."' name='pj_".$values[2]."' type='button' class='btn  ".$coleta."' >".$label."</button></td>";
		$_SESSION['main']['table']['default'][$dtini][$usrsession] .= "</tr>";
	}
}else{
	foreach($rs as $values){
		$_SESSION['main']['table']['default'][$dtini][$usrsession] .= "<tr>";
		$_SESSION['main']['table']['default'][$dtini][$usrsession] .= "<td>".$values[0]."</td>";
		$_SESSION['main']['table']['default'][$dtini][$usrsession] .= "<td>".$values[1]."</td>";
		$_SESSION['main']['table']['default'][$dtini][$usrsession] .= "<td><button id='".$values[2]."' type='button' class='btn btn-success tblcolbtncol' >ATIVAR</button></td>";
		$_SESSION['main']['table']['default'][$dtini][$usrsession] .= "</tr>";
	}	
}

$_SESSION['main']['table']['default'][$dtini][$usrsession] .= "</tbody></table></div></div>";

}else{
	$dataset[0] = " Internal error";
}


$conn->close($conn->getDBH());
echo json_encode($dataset,JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES );
?>
