<?php

	/**
	* 
	*/
	class widgetsModelo extends GU_Model
	{
		
		// Método que cria o breadcrumbs
		public function brad( $pg = null )
        {

            $this->load->biblioteca( 'migalhas' );

            switch ( $pg ){

                default:

                    $this->migalhas
                    ->defineSessao( array( "Dashboard", "index", "<i class='fa fa-dashboard'></i>" ), true )
                    ->defineSessao( array( "Widgets", "", "<i class='fa fa-th'></i>" ), false );

                break;

            }


            return $this->migalhas
            ->definetipoelemento('ol')
            ->defineclasselementoatual('active')
            ->menu('breadcrumb','');

        }

	}

?>