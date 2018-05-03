<?php

	/**
	* 
	*/
	class indexModelo extends GU_Model
	{
		
		// Método que cria o breadcrumbs
		public function brad( $pg = null )
        {

            $this->load->biblioteca( 'migalhas' );

            switch ( $pg ){

                default:

                    $this->migalhas
                    ->defineSessao( array( "Dashboard", "", "<i class='fa fa-dashboard'></i>" ), true );

                break;

            }


            return $this->migalhas
            ->definetipoelemento('ol')
            ->defineclasselementoatual('active')
            ->menu('breadcrumb','');

        }

	}

?>