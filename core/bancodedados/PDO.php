<?php

class GU_PDO{

	public $linhas; // Total de linhas afetadas pela consulta

	public $tabela; // Tabela a ser utilizada

	public $consulta_status; // Status da consulta realizada

	public $conexao_status; // Status da conexao

	public $db = array();

	public $prefixo_tb; // Armazena o prefixo da tabela

	protected $select = array(); // Fator de seleção da consulta

	protected $join = array(); // Join da consulta

	protected $fetch;

	private $consultas = 0; // Quantidade de requisições ao CRUD

	private $stmt = array();

	private $bd_caractere = "utf8"; // Conjunto de caracteres do cliente



	//---------------------------------------------------------------------------------------



	// Instancia o PDO e realiza a conexao com o banco de dados
	public function conectar( $tipobanco=null, $host=null, $banco=null, $usuariobanco=null, $senhabanco=null ){

		try{

			if( !is_null($tipobanco) && !is_null($host) && !is_null($banco) && !is_null($usuariobanco) && !is_null($senhabanco) ){

				$this->db= new PDO( $tipobanco.':host='.$host.';dbname='.$banco, $usuariobanco, $senhabanco, array( PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES ".$this->bd_caractere ) );

			}else{

				$this->db= new PDO( TIPODEBANCO.':host='.HOST.';dbname='.BANCO, USUARIO, SENHA, array( PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES ".$this->bd_caractere ) );

			}

			$this->conexao_status= true;

		}catch ( PDOException $e ){

			$this->conexao_status= false;

			if( ERR_CON ){

				echo $e->getMessage ();

			}

		}

	}



	//---------------------------------------------------------------------------------------



	// Define o conjunto de caracteres do banco
	public function setbdCaractere( $bd_caractere = 'utf8' ){

		$this->bd_caractere= $bd_caractere;

		return $this;

	}



	//---------------------------------------------------------------------------------------



	// Metodo que monta o select da consulta
	public function setselect( $select=null ){

		if( !is_null( $select ) ){

			$this->select[  $this->consultas ]= trim( $select );

		}

		return $this;

	}



	//---------------------------------------------------------------------------------------



	// Define o tipo da busca do PDO como fetch ( obtem a proxima linha de um conjunto de resultados )
	public function setfetch(){

		$this->fetch= 'fetch';

		return $this;

	}



	//---------------------------------------------------------------------------------------



	// Define o tipo de busca do PDO como fetchall ( retorna um array com todas as linhas de um conjunto de resultados )
	public function setfetchAll(){

		$this->fetch= 'fetchAll';

		return $this;

	}



	//---------------------------------------------------------------------------------------



	// Monta join
	public function setjoin( $tabela, $condicao, $tipo=null ){

		
		switch( $tipo ){

			case'left':

				$join='LEFT JOIN'; // left

			break;

			case'left outer':

				$join='LEFT OUTER JOIN'; // left

			break;

			case'right outer':

				$join='RIGHT OUTER JOIN'; // right

			break;

			default:

				$join='JOIN'; // join

			break;

		}

		if( empty( $this->join[  $this->consultas ] ) ){

			$this->join[  $this->consultas ]= $join.' '.$this->prefixo_tb.$tabela.' ON '.$condicao;

		}else{

			$this->join[  $this->consultas ].= ' '.$join.' '.$this->prefixo_tb.$tabela.' ON '.$condicao;

		}

		return $this;

	}



	//---------------------------------------------------------------------------------------



	// Inicia a transação no banco de dados
	public function iniciaTransacao(){

		$this->db->beginTransaction();

	}



	//---------------------------------------------------------------------------------------



	// Envia todas as trnasações para o banco de dados
	public function enviaTransacao(){

		$this->db->commit();

	}



	//---------------------------------------------------------------------------------------



	// Desfaz todas as transações para o banco de dados
	public function desfazTransacao(){

		$this->db->rollBack();

	}



	//---------------------------------------------------------------------------------------



	// Monta os parametros do where
	private function montawhere( $where ){

		if( !is_null( $where ) && !empty ($where) ){

			$auxw=0;

			foreach($where as $w){

				if( count( $w )==4 ){

					$a_where[ $this->consultas ][] = $w[0]." ".$w[1]." :".str_replace(".", "", $w[0])."_w_".$auxw." ".$w[3];

				}else if ( count( $w==1 ) ) {

					$a_where[ $this->consultas ][] = $w[0];

				}

				$auxw++;

			}

			return "WHERE ".implode(" ",$a_where[ $this->consultas ]);

		}else{

			return" ";

		}
		
	}



	//---------------------------------------------------------------------------------------



	// Vincula os parametros do where
	private function vinculawhere( $where ){

		if( !is_null( $where ) && !empty( $where ) ){

			$auxw=0;

			foreach( $where as $w ){

				if( count( $w )==4 ){

					$this->stmt[ $this->consultas ]->bindValue(":".str_replace(".", "", $w[0])."_w_".$auxw, $w[2]);

				}

				$auxw++;

			}

		}

	}



	//---------------------------------------------------------------------------------------



	// Faz a gravação no banco de dados ( INSERT )
	public function insert( Array $dados ){

		$auxdados=0;

		foreach($dados as $indices => $conteudo){

			$campos[]= $indices;

			$valores[]= ":".$indices."_d_".$auxdados;

			$auxdados++;

		}

		$valores=  implode(",",$valores);

		$campos= implode(", ",$campos);

		// Monta consulta
		$query= " INSERT INTO `{$this->prefixo_tb}{$this->tabela}` ({$campos}) VALUES ({$valores}) ";

		// Prepara consulta
		$stmt = $this->db->prepare($query);

		// Vincula valores e aos parametros
		$auxdados=0;
		foreach($dados as $indices => $conteudo){

			$conteudo= ( $conteudo==='null' || $conteudo==='NULL' )? null : $conteudo ;//Insere null

			$stmt->bindValue(":{$indices}_d_".$auxdados, $conteudo);

			$auxdados++;

		}

		// Realiza a ação
		try{
			
			// Executa a consulta
			if( !$stmt->execute() ){

				$this->consulta_status= false;


				if( ERR_DB ){
					throw new Exception("<span style='color: #ff4d4d;'>Falha ao gravar dados.</span><br>");
				}

			}else{

				$this->consulta_status= true;

			}

		}catch (Exception $e) {

			echo $e->getMessage();

			if(ERR_DB){ print_r($stmt->errorInfo()); }

			$erros= $stmt->errorInfo();

		}

		// Incrementa a quantidade de acessos
		$this->consultas++;

	}



	//---------------------------------------------------------------------------------------



	// Faz a gravação no banco de dados em modo de grupos ( INSERT )
	public function insert_group( Array $grupos ){

		// Obter uma lista de nomes de colunas para usar na instrução SQL
    	$campos = array_keys( $grupos[0] );
    	$campos = implode(", ",$campos);

		// Roda um loop para cada grupo
		$auxdados=0;
		foreach ( $grupos as $grupo ) {

			unset( $valores );//Destroy os valores
			
			//Roda um loop para montar os dados do grupo
			foreach( $grupo as $indices => $conteudo ){

				$valores[]= ":".$indices."_d_".$auxdados;

				$auxdados++;

			}

			$valoresf[]=  "( ".implode(",",$valores)." )";

		}

		$valoresf= implode(", ",$valoresf);

		// Monta consulta
		$query= " INSERT INTO `{$this->prefixo_tb}{$this->tabela}` ({$campos}) VALUES $valoresf ";

		// Prepara consulta
		$stmt = $this->db->prepare($query);

		// Vincula valores e aos parametros
		$auxdados=0;
		if( count( $grupos ) ){

			foreach ( $grupos as $grupo ) {
				
				foreach( $grupo as $indices => $conteudo){

					$conteudo= ( $conteudo==='null' || $conteudo==='NULL' )? null : $conteudo ;//Insere null

					$stmt->bindValue( ":{$indices}_d_".$auxdados, $conteudo );

					$auxdados++;

				}

			}

		}


		// Realiza a ação
		try{
			
			// Executa ação
			if( !$stmt->execute() ){

				$this->consulta_status= false;


				if( ERR_DB ){
					throw new Exception("<span style='color: #ff4d4d;'>Falha ao gravar dados.</span><br>");
				}

			}else{

				$this->consulta_status= true;

			}

		}catch (Exception $e) {

			echo $e->getMessage();

			if(ERR_DB){ print_r($stmt->errorInfo()); }

			$erros= $stmt->errorInfo();

		}

		// Incrementa a quantidade de acessos
		$this->consultas++;

	}



	//---------------------------------------------------------------------------------------



	// Faz a leitura no banco de dados ( READ )
	public function read( $where=null, $limit=null, $offset=null, $orderby=null ){

		// Monta where
		$f_where= $this->montawhere( $where );

		$orderby= (!is_null($orderby) && !empty($orderby) ? "ORDER BY {$orderby}": "");

		$limit= (!is_null($limit) && !empty($limit) ? "LIMIT {$limit}": "");

		$offset= (!is_null($offset) && !empty($offset) ? "OFFSET {$offset}": "");

		$select= ( empty( $this->select[  $this->consultas ] ) )? "*" : $this->select[  $this->consultas ] ;

		// Monta consulta
		$query= " SELECT $select FROM `{$this->prefixo_tb}{$this->tabela}` ".$this->join[ $this->consultas ]." {$f_where} {$orderby} {$limit} {$offset} ";
		
		// Prepara consulta
		$this->stmt[ $this->consultas ] = $this->db->prepare($query);

		// Vincula valores e aos parametros
		$this->vinculawhere( $where );

		// Realiza ação
		try{

			// Executa consulta
			if( !$this->stmt[ $this->consultas ]->execute() ){

				$this->consulta_status= false;


				if( ERR_DB ){
					throw new Exception("<span style='color: #ff4d4d;'>Falha ao ler dados.</span><br>");
				}

			}else{

				$this->consulta_status= true;

			}

		}catch (Exception $e) {

			echo $e->getMessage();

			if(ERR_DB){ print_r( $this->stmt[ $this->consultas ]->errorInfo() ); }

			$erros= $this->stmt[ $this->consultas ]->errorInfo();

		}


		// Busca PDO
		switch($this->fetch){

			case 'fetch':

				$resultados= $this->stmt[ $this->consultas ]->fetch(PDO::FETCH_ASSOC);

			break;

			case 'fetchAll':

				$resultados= $this->stmt[ $this->consultas ]->fetchAll(PDO::FETCH_ASSOC);

			break;

			default:

				$resultados= $this->stmt[ $this->consultas ]->fetchAll(PDO::FETCH_ASSOC);

			break;

		}

		$this->linhas= $this->stmt[ $this->consultas ]->rowCount($resultados);

		// Incrementa a quantidade de acessos
		$this->consultas++;

		return $resultados;

	}



	//---------------------------------------------------------------------------------------



	// Realiza a consulta livre, colocando direto o SQL
	public function consult_bd( $consulta, array $parametros=null ){

		// Prepara a consulta
		$this->stmt[ $this->consultas ] = $this->db->prepare( $consulta );

		if( count($parametros) ){

			$aux= 1;
			foreach ( $parametros as $valores ) {

				$this->stmt[ $this->consultas ]->bindValue($aux, $valores);
				$aux++;
				
			}

		}
		
		// Realiza a ação
		try{

			// Executa ação
			if( !$this->stmt[ $this->consultas ]->execute() ){

				$this->consulta_status= false;


				if( ERR_DB ){
					
					throw new Exception("<span style='color: #ff4d4d;'>Falha ao ler dados.</span><br>");

				}

			}else{

				$this->consulta_status= true;

			}

		}catch (Exception $e) {

			echo $e->getMessage();

			if(ERR_DB){ print_r( $this->stmt[ $this->consultas ]->errorInfo() ); }

			$erros= $this->stmt[ $this->consultas ]->errorInfo();

		}


		// Busca PDO
		switch($this->fetch){

			case 'fetch':

				$resultados= $this->stmt[ $this->consultas ]->fetch(PDO::FETCH_ASSOC);

			break;

			case 'fetchAll':

				$resultados= $this->stmt[ $this->consultas ]->fetchAll(PDO::FETCH_ASSOC);

			break;

			default:

				$resultados= $this->stmt[ $this->consultas ]->fetchAll(PDO::FETCH_ASSOC);

			break;

		}

		$this->linhas= $this->stmt[ $this->consultas ]->rowCount($resultados);

		// Incrementa quantidade de acessos
		$this->consultas++;

		return $resultados;

	}



	//---------------------------------------------------------------------------------------



	// Realiza a atualização no banco de dados (UPDATE)
	public function update( Array $dados, $where=null ){

		// Monta where
		$f_where= $this->montawhere( $where );

		// Monta campos
		$auxc=0;
		foreach($dados as $indices => $conteudo){

			// Cria indeces de conteudo para realizar a consulta
			$a_campos[]= $indices." = :".$indices."_d_".$auxc;

			$auxc++;

		}

		$f_campos= implode(", ",$a_campos);

		// Monta consulta
		$query= " UPDATE `{$this->prefixo_tb}{$this->tabela}` SET {$f_campos} {$f_where} ";

		

		// Prepara a consulta
		$this->stmt[ $this->consultas ] = $this->db->prepare($query);

		// Vincula os valores aos parametros do where
		$this->vinculawhere( $where );

		// Vincula os valores aos parametros do campo
		$auxc=0;
		foreach($dados as $indices => $conteudo){

			$conteudo= ( $conteudo==='null' || $conteudo==='NULL' )? null : $conteudo ;

			$this->stmt[ $this->consultas ]->bindValue(":".$indices."_d_".$auxc."", $conteudo, PDO::PARAM_STR);

			$auxc++;

		}

		// Realiza ação
		try{

			// Executa ação
			if( !$this->stmt[ $this->consultas ]->execute() ){

				$this->consulta_status= false;

				if( ERR_DB ){

					throw new Exception("<span style='color: #ff4d4d;'>Falha ao atualizar dados.</span><br>");

				}

			}else{

				$this->consulta_status= true;

			}

		}catch (Exception $e) {

			echo $e->getMessage();

			if(ERR_DB){ print_r( $this->stmt[ $this->consultas ]->errorInfo() ); }

			$erros= $this->stmt[ $this->consultas ]->errorInfo();

		}

		// Incrementa a quantidade de acessos
		$this->consultas++;

	}



	//---------------------------------------------------------------------------------------



	// Realiza a atualização no banco de dados em grupo (UPDATE)
	public function update_group( array $dados, array $where ){

		// Monta os campos
		$auxc=0;
		foreach($dados as $indices => $conteudo){

			//CRIA O INDICES DE CONTEUDO PARA A CONSULTA
			$a_campos[]= $indices." = :".$indices."_d_".$auxc;

			$auxc++;

		}

		$query = "UPDATE `{$this->prefixo_tb}{$this->tabela}` SET ";

		$indice_where= array_keys( $where );

		// Roda loop para dado/coluna
		foreach ( $dados as $indice => $valor ) {

			unset( $coluna );

			 $coluna .= $indice." = CASE ".$indice_where[0];

			 	// Extrai os valores de cada linha referente a coluna
			 	$aux= 0;
			 	foreach ( $where[ $indice_where[0] ] as $chave ) {

			 		$coluna .= " WHEN ".$chave." THEN '".$a_campos[ $aux ]."' ";

			 		$aux++;

			 	}

			 $coluna.= " END";

			 $colunas[]= $coluna;
		}

		$query .= implode(', ', $colunas);

		$query .= " WHERE ".$indice_where[0]." IN ( ".implode(',', $where[ $indice_where[0] ] )." )";
		 
		echo $query; exit();

		// Prepara consulta
		$this->stmt[ $this->consultas ] = $this->db->prepare($query);

		// Vincula valores ao parametros da where
		$this->vinculawhere( $where );

		// Vincula valores ao parametros dos campos
		$auxc=0;
		foreach($dados as $indices => $conteudo){

			$conteudo= ( $conteudo==='null' || $conteudo==='NULL' )? null : $conteudo ;//Insere null

			$this->stmt[ $this->consultas ]->bindValue(":".$indices."_d_".$auxc."", $conteudo, PDO::PARAM_STR);//VINCULA VALOR

			$auxc++;

		}

		// Realiza ação
		try{

			// Executa consulta
			if( !$this->stmt[ $this->consultas ]->execute() ){

				$this->consulta_status= false;


				if( ERR_DB ){

					throw new Exception("<span style='color: #ff4d4d;'>Falha ao atualizar dados.</span><br>");

				}

			}else{

				$this->consulta_status= true;

			}

		}catch (Exception $e) {

			echo $e->getMessage();

			if(ERR_DB){ print_r( $this->stmt[ $this->consultas ]->errorInfo() ); }

			$erros= $this->stmt[ $this->consultas ]->errorInfo();

		}

		// Incrementa a quantidade de acessos
		$this->consultas++;

	}



	//---------------------------------------------------------------------------------------



	// Realiza a exclusão de dados (DELETE)
	public function delete( $where=null ){

		// Monta o where
		$f_where= $this->montawhere( $where );

		// Monta consulta
		$query= " DELETE FROM `{$this->prefixo_tb}{$this->tabela}` {$f_where} ";

		// Prepara consulta
		$this->stmt[ $this->consultas ] = $this->db->prepare($query);

		// Vincula valores aos parametros do where
		$this->vinculawhere( $where );

		// Realização acao
		try{

			// Executa consulta
			if( !$this->stmt[ $this->consultas ]->execute() ){

				$this->consulta_status= false;


				if( ERR_DB ){

					throw new Exception("<span style='color: #ff4d4d;'>Falha ao excluir dados.</span><br>");
				}

			}else{

				$this->consulta_status= true;

			}

		}catch (Exception $e) {

			echo $e->getMessage();

			if(ERR_DB){ print_r( $this->stmt[ $this->consultas ]->errorInfo() ); }

			$erros= $this->stmt[ $this->consultas ]->errorInfo();

		}

		// Incrementa a quantidade de acessos
		$this->consultas++;

	}


}



?>