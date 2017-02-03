<?php
if ( ! class_exists( 'CF7_Conversion_Tracking_Print_Tags' ) ) :
	
	/**
	* Contact Form 7 Conversion Tracking Print Tags.
	*/
	class CF7_Conversion_Tracking_Print_Tags {

		function __construct() {
			add_filter( 'wpcf7_contact_form_properties', array( $this, 'cf7_is_print_additional_settings' ), 10, 2 );
		}

		/**
		 * Add the code that will run when on_sent_ok is triggered.
		 *
		 * @return html.
		 */
		public function cf7_is_print_additional_settings( $properties, $contact_form_obj /* unused */ ){
		    $properties[ 'additional_settings' ] .= 
		        "\n"
		        . 'on_sent_ok: "console.log(Teste Conversion Tracking);"' . "\n"
		        //. 'on_sent_ok: 'jQuery(String.fromCharCode(60)+'img/'+String.fromCharCode(62)).attr('height','1').attr('width','1').css('border-style','none').attr('src','http://www.googleadservices.com/pagead/conversion/'+google_conversion_id+'/?value='+google_conversion_value+String.fromCharCode(38)+'label='+google_conversion_label+String.fromCharCode(38)+'guid=ON'+String.fromCharCode(38)+'script=0').appendTo('body');'' . "\n";
		    ;
		    return $properties;
		}
	}

	new CF7_Conversion_Tracking_Print_Tags();

endif;