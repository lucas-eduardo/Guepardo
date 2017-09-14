<?php

	/*
	* Realiza a manipulação de imagens
	*/
	class GU_imagem{

		// Caminho da imagem
		protected $caminho;

		// Nome imagem
		protected $imagem;

		// Imagem criada
		protected $imagemcriada;

		// Extensão da imagem
		protected $extensao;

		// Prefixo da miniatura de imagem
		protected $prefixothumb= 'thumb_';



		//---------------------------------------------------------------------------------------



		// Define o caminho da imagem
		public function montaCaminho( $caminho ){

			$this->caminho= $caminho;

			return $this;

		}



		//---------------------------------------------------------------------------------------



		/*
		* Extrai e armazena a extensao de imagens
		* invoca o metodo de criação de imagens
		*/
		public function montaImagem( $imagem, $cria=true ){

			// Nome da imagem
			$this->imagem= $imagem;

			$expimg= explode( '.', $imagem );

			// Extensão da imagem
			$this->extensao= strtolower(end( $expimg ));

			if( $cria ){

				// Cria imagem
				$this->criaImagem();

			}
			
			return $this;

		}



		//---------------------------------------------------------------------------------------



		// Define um prefixo opcional para thumbnails de imagens o padrão é 'thumb_'
		public function defineprefixoThumb( $prefixo ){

			$this->prefixothumb= $prefixo;

			return $this;

		}



		//---------------------------------------------------------------------------------------



		// Cria uma nova imagem
		protected function criaImagem( $nomedaimagem=null ){

			$nomedaimagem= ( is_null($nomedaimagem) )? $this->imagem : $nomedaimagem ;

			// De acordo com cada extensão, executa um bloco
			if ( $this->extensao == 'jpg' || $this->extensao == 'jpeg' ) {

				$this->imagemcriada= imagecreatefromjpeg( $this->caminho.$nomedaimagem  );

			} else if ( $this->extensao == 'png' ) {

				$this->imagemcriada= imagecreatefrompng( $this->caminho.$nomedaimagem  );

			// Se a versão do GD incluir suporte a gif, mostra...
			} else if ( $this->extensao == 'gif' ) {

				$this->imagemcriada= imagecreatefromgif( $this->caminho.$nomedaimagem );

			}

		}



		//---------------------------------------------------------------------------------------



		// Envia a imagem para o borwser ou arquivo
		protected function enviaImagem( $imagem, $nomedaimagem=null ){

			$nomedaimagem= ( is_null($nomedaimagem) )? $this->imagem : $nomedaimagem ;

			if ( $this->extensao == 'jpg' || $this->extensao == 'jpeg' ) {

				return ( imagejpeg($imagem, $this->caminho.$nomedaimagem, 100 ) )? true : false ;

			} else if ( $this->extensao == 'png' ) {

				imagealphablending($imagem, false);
				imagesavealpha($imagem, true);

				return ( imagepng($imagem, $this->caminho.$nomedaimagem ) )? true : false ;

			// Se a versão do GD incluir suporte a gif, mostra...
			} else if ( $this->extensao == 'gif' ) {

				return ( imagegif($imagem, $this->caminho.$nomedaimagem, 100 ) )? true : false ;

			}

		}



		//---------------------------------------------------------------------------------------



		// Define valores em proporcao para largura e altura de uma imagem
		public function proporcaoImagem( $comprimento,$altura ){

			// Comprimento original da imagem
			$largura_original= imagesx($this->imagemcriada);

			// Altura original da imagem
			$altura_original= imagesy($this->imagemcriada);

			// Escala de proporção
			$escala= min($comprimento/$largura_original, $altura/$altura_original);

			// Se a imagem é maior que o permitido, encolhe a mesma!
			$largura= ( $escala < 1 )? floor($escala * $largura_original) : $largura_original ;
			$altura= ( $escala < 1 )? floor($escala * $altura_original) : $altura_original ;

			// Retorna um array com a largura e altura
			return array( $largura,$altura );

		}



		//---------------------------------------------------------------------------------------



		// Redimensiona uma imagem para um novo tamanhos
		public function redimensionaImagem( $largura, $altura, $proporcao=null ){

			// Se a proporção estiver ativa
			if( strtolower($proporcao)=='p'  ){

				$proporcoes= $this->proporcaoImagem( $largura,$altura );

				$largura = $proporcoes[0];
				$altura = $proporcoes[1];

			}else{

				$largura = $largura;
				$altura = $altura;

			}

			// Comprimento original da imagem
			$largura_or= imagesx($this->imagemcriada);

			// Altura original da imagem
			$altura_or= imagesy($this->imagemcriada);

			// Cria imagem true color com as novas proporções
			$nova_imagem = imagecreatetruecolor( $largura, $altura );

			// Suporte a png transparente
			imagealphablending($nova_imagem, false);
			imagesavealpha($nova_imagem, true);

			// Copia a imagem para a nova imagem
			imagecopyresampled( $nova_imagem, $this->imagemcriada, 0, 0, 0, 0, $largura, $altura, $largura_or, $altura_or );

			// Destroi a imagem e libera a mémoria
			imagedestroy( $this->imagemcriada );
			
			// Envia a imagem para a pasta ou browser
			return $this->enviaImagem( $nova_imagem );
			
		}



		//---------------------------------------------------------------------------------------



		// Cria thumbnails de imagens
		public function thumbImagem( $largura, $altura, $proporcao=null ){

			// Se a proporção estiver ativa
			if( strtolower($proporcao)=='p'  ){

				$proporcoes= $this->proporcaoImagem( $largura,$altura );

				$largura = $proporcoes[0];
				$altura = $proporcoes[1];

			}else{	

				$largura = $largura;
				$altura = $altura;

			}
			
			// Comprimento original da imagem
			$largura_or= imagesx($this->imagemcriada);

			// Altura original da imagem
			$altura_or= imagesy($this->imagemcriada);

			// Cria imagem thumb
			$thumb = imagecreatetruecolor( $largura, $altura );

			// Suporte a png transparente
			imagealphablending($thumb, false);
			imagesavealpha($thumb, true);

			$nomethumb= explode('.',$this->imagem);
			$nomethumb= $this->prefixothumb.$nomethumb[0].'.'.$this->extensao;

			// Copia a imagem para a nova imagem
			imagecopyresampled( $thumb, $this->imagemcriada, 0, 0, 0, 0, $largura, $altura, $largura_or, $altura_or );

			$this->enviaImagem( $thumb, $nomethumb );

		}



		//---------------------------------------------------------------------------------------



		// Insere uma imagem no centro de outra criando uma moldura
		public function emoldurarImagem( $largura, $altura, array $corfundo= array( 255,255,255 ) ){
			
			// Comprimento original da imagem
			$largura_or= imagesx($this->imagemcriada);

			// Altura original da imagem
			$altura_or= imagesy($this->imagemcriada);

			// Cria imagem
			$imagem = imagecreatetruecolor( $largura, $altura );

			// Aloca a cor para a imagem
			$backgroundColor = imagecolorallocate( $imagem, $corfundo[0], $corfundo[1], $corfundo[2] );

			// Realiza o preenchimento da imagem
			imagefill( $imagem, 0, 0, $backgroundColor );

			// Suporte a png transparente
			imagealphablending( $imagem, false );
			imagesavealpha( $imagem, true );

			// Centraliza a imagem no fundo
			$centro_largura= round( $largura/2-$largura_or/2 );
			$centro_altura= round( $altura/2-$altura_or/2 );

			// Copia a imagem para a nova imagem
			imagecopyresampled( $imagem, $this->imagemcriada, $centro_largura , $centro_altura, 0, 0, $largura_or, $altura_or, $largura_or, $altura_or );

			$this->enviaImagem( $imagem, $this->imagem );

		}



		//---------------------------------------------------------------------------------------



		// Converte base64 para imagem
		public function b64toImage( $img ){

			// Remove strings do hash
			$img = str_replace( 'data:image/png;base64,', '', $img );

			// Remove strings do hash
			$img = str_replace( 'data:image/jpeg;base64,', '', $img );

			// Remove strings do hash
			$img = str_replace( 'data:image/jpg;base64,', '', $img );

			// Remove strings do hash
			$img = str_replace( 'data:image/gif;base64,', '', $img );

			// Substitui espaço por +
			$img = str_replace( ' ', '+', $img );

			// Decodifica a string
			$data = base64_decode( $img );

			// Cria um identificador da imagem a partir da string
			$data = imagecreatefromstring($data);

			// Invoca o metodo que envia a umagem para o arquivo
			return $this->enviaImagem( $data );

		}



		//---------------------------------------------------------------------------------------



		// Converte um arquivo de imagem para base 64
		public function imagemparab64( $imagem_nome ){

			// Nome da imagem
			$this->imagem= $imagem_nome;

			$expimg= explode( '.', $imagem_nome );

			// Extensão da imagem
			$this->extensao= strtolower(end( $expimg ));

	        $imgbinary = fread(fopen($this->caminho, "r"), filesize($this->caminho));

	        return 'data:image/' . $this->extensao . ';base64,' . base64_encode($imgbinary);
	    

		}

	}

?>