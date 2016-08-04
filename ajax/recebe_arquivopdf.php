<?php
session_start();
$diretorio = '../restrito2/temp/'; //diretorio dos arquivos enviados

//montando o caminho para onde o arquivo enviado vai ser copiado
$nome_imagem    = $_FILES['arquivo']['name'];
$ext = strtolower(strrchr($nome_imagem,"."));
$nome_atual = md5(uniqid(time())).$ext; 
$caminho_arquivo = $diretorio .basename($nome_atual);
$_SESSION['doc']=$nome_atual;

//a funcao php move_uploaded_file copia os arquivos enviados para o caminho que você desejar 
if (move_uploaded_file($_FILES['arquivo']['tmp_name'], $caminho_arquivo)) { 
  echo "sucesso";//este 'sucesso' é o valor que vai estar no parametro resposta no código js
} else {
	echo "erro";//em caso de erro na copia do arquivo reposta vai ter o valor 'erro'
}
?>
