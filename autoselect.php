<?php
/*
Plugin Name: Car Body Quote 2
Plugin URI: http://taglinegroup.com
Description: Add short code [tq-quote] to the page you want the app to appear. Create different pricing pages with short code [tq-result] at the top and add the slug to a corresponding bodystyle in the plugin admin page (Settings/ Tint Quote). User selects car year, make, model, and trim to be direceted to a page based on criteria, Built on Car Query API. 
Author: Tharon Carlson
*/
add_action('wp_enqueue_scripts', 'pp_styles'); // Add Theme Stylesheet
add_action('wp_enqueue_scripts', 'pp_scripts'); // Add Theme Stylesheet

function pp_styles() {
    wp_register_style('autoselect-css', plugins_url('/css/autoselect.css', __FILE__ ), array(), '1.0', 'all');
    wp_enqueue_style('autoselect-css'); // Enqueue it!
    wp_register_style('angular-busy-css', plugins_url('/bower_components/angular-busy/dist/angular-busy.min.css', __FILE__ ), array(), '1.0', 'all');
    wp_enqueue_style('angular-busy-css'); // Enqueue it!
    wp_register_style('bootstrap-css', 'http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css', array(), '1.0', 'all');
    wp_enqueue_style('bootstrap-css'); // Enqueue it!
}

function pp_scripts() {
  wp_enqueue_script('bootstrap-js', 'http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js', array(), '1.0', true); // Enqueue it!
  wp_enqueue_script('cookie-js', plugins_url('/js/lib/jquery.cookie.js', __FILE__ ), array('jquery'), '1.0', true); // Enqueue it!
  wp_enqueue_script('angular-animate', plugins_url('/bower_components/angular-animate/angular-animate.min.js', __FILE__ ), array('angular-js'), '1.0', true); // Enqueue it!
  wp_enqueue_script('angular-busy', plugins_url('/bower_components/angular-busy/dist/angular-busy.min.js', __FILE__ ), array('angular-js', 'angular-animate'), '1.0', true); // Enqueue it!
  wp_enqueue_script('angular-js', plugins_url('/bower_components/angular/angular.min.js', __FILE__ ), array('jquery' , 'bootstrap-js'), '1.0', true);
  wp_enqueue_script('ui-angular-js', plugins_url('/bower_components/angular-ui-utils/ui-utils.min.js', __FILE__ ), array('angular-js'), '1.0', true); // Enqueue it!
  wp_enqueue_script('sanitize-angular-js', 'http://cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.14/angular-sanitize.js', array('angular-js'), '1.0', true); // Enqueue it!
  wp_enqueue_script('edmunds-api-js', plugins_url('/js/main.js', __FILE__ ), array('angular-js','ui-angular-js', 'sanitize-angular-js', 'angular-animate', 'angular-busy'), '1.0', true); // Enqueue it!
}

add_action( 'admin_menu', 'pp_admin_menu' );
function pp_admin_menu() {
  add_options_page( 'Paint Protection Quote', 'Paint Protection Quote', 'manage_options', 'paint-quote', 'pp_options_page' );
}

add_action( 'admin_init', 'pp_admin_init' );
function pp_admin_init() {
  add_settings_section( 'pp-section-one', 'Body Styles', 'pp_section_one_callback', 'paint-quote' );
  register_setting( 'pp-settings-group', 'pp-suv' );
  register_setting( 'pp-settings-group', 'pp-coupe' );
  register_setting( 'pp-settings-group', 'pp-sedan' );
  register_setting( 'pp-settings-group', 'pp-hatchback' );
  register_setting( 'pp-settings-group', 'pp-convertible' );
  register_setting( 'pp-settings-group', 'pp-wagon' );
  register_setting( 'pp-settings-group', 'pp-sport-wagon' );
  register_setting( 'pp-settings-group', 'pp-pickup' );
  register_setting( 'pp-settings-group', 'pp-crew-cab' );
  register_setting( 'pp-settings-group', 'pp-extended-cab' );
  register_setting( 'pp-settings-group', 'pp-regular-cab' );
  register_setting( 'pp-settings-group', 'pp-supercab' );
  register_setting( 'pp-settings-group', 'pp-double-cab' );
  register_setting( 'pp-settings-group', 'pp-van' );
  register_setting( 'pp-settings-group', 'pp-minivan' );
  register_setting( 'pp-settings-group', 'pp-default' );
  add_settings_field( 'field-pp-suv', 'SUV', 'pp_field_suv_callback', 'paint-quote', 'pp-section-one' );
  add_settings_field( 'field-pp-coupe', 'Coupe', 'pp_field_coupe_callback', 'paint-quote', 'pp-section-one' );
  add_settings_field( 'field-pp-sedan', 'Sedan', 'pp_field_sedan_callback', 'paint-quote', 'pp-section-one' );
  add_settings_field( 'field-pp-hatchback', 'Hatchback', 'pp_field_hatchback_callback', 'paint-quote', 'pp-section-one' );
  add_settings_field( 'field-pp-convertible', 'Convertible', 'pp_field_convertible_callback', 'paint-quote', 'pp-section-one' );
  add_settings_field( 'field-pp-tsx-sport-wagon', 'Sport Wagon', 'pp_field_sport_wagon_callback', 'paint-quote', 'pp-section-one' );
  add_settings_field( 'field-pp-wagon', 'Wagon', 'pp_field_wagon_callback', 'paint-quote', 'pp-section-one' );
  add_settings_field( 'field-pp-pickup', 'Pickup', 'pp_field_pickup_callback', 'paint-quote', 'pp-section-one' );
  add_settings_field( 'field-pp-crew-cab', 'Crew Cab', 'pp_field_crew_cab_callback', 'paint-quote', 'pp-section-one' );
  add_settings_field( 'field-pp-extended-cab', 'Extended Cab', 'pp_field_extended_cab_callback', 'paint-quote', 'pp-section-one' );
  add_settings_field( 'field-pp-regular-cab', 'Regular Cab', 'pp_field_regular_cab_callback', 'paint-quote', 'pp-section-one' );
  add_settings_field( 'field-pp-supercab', 'SuperCab', 'pp_field_supercab_callback', 'paint-quote', 'pp-section-one' );
  add_settings_field( 'field-pp-double-cab', 'Double Cab', 'pp_field_double_cab_callback', 'paint-quote', 'pp-section-one' );
  add_settings_field( 'field-pp-van', 'Van', 'pp_field_van_callback', 'paint-quote', 'pp-section-one' );
  add_settings_field( 'field-pp-minivan', 'Minivan', 'pp_field_minivan_callback', 'paint-quote', 'pp-section-one' );  
  add_settings_field( 'field-pp-default', 'Default', 'pp_field_tq_default_callback', 'paint-quote', 'pp-section-one' );
}

// Instructions to user
function pp_section_one_callback() {
    echo '<p>Create a page you would like your car selection form on and add the short code [pp-quote]. <br>Then create a result page that fits your pricing for each body style and add the code [pp-result]. <br>For each body style below, add the page slug you would like the user to be directed to.</p>
          <b>Example: your-page-slug</b>';
}

// Fields For Admin Page
function pp_field_suv_callback() {
  $setting = esc_attr( get_option( 'pp-suv' ) );
  echo "<input type='text' name='pp-suv' value='$setting' />";
}
function pp_field_coupe_callback() {
    $setting = esc_attr( get_option( 'pp-coupe' ) );
    echo "<input type='text' name='pp-coupe' value='$setting' />";
}
function pp_field_sedan_callback() {
    $setting = esc_attr( get_option( 'pp-sedan' ) );
    echo "<input type='text' name='pp-sedan' value='$setting' />";
}
function pp_field_hatchback_callback() {
    $setting = esc_attr( get_option( 'pp-hatchback' ) );
    echo "<input type='text' name='pp-hatchback' value='$setting' />";
}
function pp_field_convertible_callback() {
    $setting = esc_attr( get_option( 'pp-convertible' ) );
    echo "<input type='text' name='pp-convertible' value='$setting' />";
}
function pp_field_sport_wagon_callback() {
    $setting = esc_attr( get_option( 'pp-sport-wagon' ) );
    echo "<input type='text' name='pp-sport-wagon' value='$setting' />";
}
function pp_field_wagon_callback() {
    $setting = esc_attr( get_option( 'pp-wagon' ) );
    echo "<input type='text' name='pp-wagon' value='$setting' />";
}
function pp_field_pickup_callback() {
    $setting = esc_attr( get_option( 'pp-pickup' ) );
    echo "<input type='text' name='pp-pickup' value='$setting' />";
}

function pp_field_crew_cab_callback() {
    $setting = esc_attr( get_option( 'pp-crew-cab' ) );
    echo "<input type='text' name='pp-crew-cab' value='$setting' />";
}
function pp_field_extended_cab_callback() {
    $setting = esc_attr( get_option( 'pp-extended-cab' ) );
    echo "<input type='text' name='pp-extended-cab' value='$setting' />";
}
function pp_field_regular_cab_callback() {
    $setting = esc_attr( get_option( 'pp-regular-cab' ) );
    echo "<input type='text' name='pp-regular-cab' value='$setting' />";
}
function pp_field_supercab_callback() {
    $setting = esc_attr( get_option( 'pp-supercab' ) );
    echo "<input type='text' name='pp-supercab' value='$setting' />";
}
function pp_field_double_cab_callback() {
    $setting = esc_attr( get_option( 'pp-double-cab' ) );
    echo "<input type='text' name='pp-double-cab' value='$setting' />";
}
function pp_field_crewmax_cab_callback() {
    $setting = esc_attr( get_option( 'pp-crewmax-cab' ) );
    echo "<input type='text' name='pp-crewmax-cab' value='$setting' />";
}
function pp_field_van_callback() {
    $setting = esc_attr( get_option( 'pp-van' ) );
    echo "<input type='text' name='pp-van' value='$setting' />";
}
function pp_field_minivan_callback() {
    $setting = esc_attr( get_option( 'pp-minivan' ) );
    echo "<input type='text' name='pp-minivan' value='$setting' />";
}
function pp_field_tq_default_callback() {
    $setting = esc_attr( get_option( 'pp-default' ) );
    echo "<input type='text' name='pp-default' value='$setting' />";
}


//Admin Page Layout
function pp_options_page() {
    ?>
    <div class="wrap">
        <h2>Car Tint Quote</h2>
        <form action="options.php" method="POST">
            <?php settings_fields( 'pp-settings-group' ); ?>
            <?php do_settings_sections( 'paint-quote' ); ?>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}


// Setting variables for application 
function pp_suv() {
  $select = get_option( 'pp-suv' );
  return $select;
}
function pp_coupe() {
  $select = get_option( 'pp-coupe' );
  return $select;
}
function pp_sedan() {
  $select = get_option( 'pp-sedan' );
  return $select;
}
function pp_hatchback() {
  $select = get_option( 'pp-hatchback' );
  return $select;
}
function pp_convertible() {
  $select = get_option( 'pp-convertible' );
  return $select;
}
function pp_beetle_convertible() {
  $select = get_option( 'pp-beetle-convertible' );
  return $select;
}
function pp_sport_wagon() {
  $select = get_option( 'pp-sport-wagon' );
  return $select;
}
function pp_wagon() {
  $select = get_option( 'pp-wagon' );
  return $select;
}
function pp_crew_cab() {
  $select = get_option( 'pp-crew-cab' );
  return $select;
}
function pp_extended_cab() {
  $select = get_option( 'pp-extended-cab' );
  return $select;
}
function pp_regular_cab() {
  $select = get_option( 'pp-regular-cab' );
  return $select;
}
function pp_supercab() {
  $select = get_option( 'pp-supercab' );
  return $select;
}
function pp_double_cab() {
  $select = get_option( 'pp-double-cab' );
  return $select;
}
function pp_van() {
  $select = get_option( 'pp-van' );
  return $select;
}
function pp_minivan() {
  $select = get_option( 'pp-minivan' );
  return $select;
}
function pp_default() {
  $select = get_option( 'pp-default' );
  return $select;
}

/*=======================================================================================
Edmunds JSON API will populate select input options 
and return list of specification for the car selected
========================================================================================== */

Class pp_edmundsAPI{

	static $add_script;

	static function pp_init() {

		//Register ShortCode
		add_shortcode("pp-quote", 	array(__CLASS__, 'pp_quote' )); 
		 
		//Load javascript in wp_footer
		
		add_action('pp_init', 		array(__CLASS__, 'pp_register_script' ));
		
		add_action('wp_footer', array(__CLASS__, 'pp_print_script' ));
	}
	
static function pp_quote() {
		//Trigger javascript scripts to load
		self::$add_script = true;
    include( plugin_dir_path( __FILE__ ) . 'dropdowns.php');
   ;}

	//Include necessary javascript files
	static function pp_register_script() {
    
	}

	//check if the short codes were used, print js if required
	static function pp_print_script() {

		//Only load javascript if the short code events were triggered
		if ( ! self::$add_script )
			return;

		wp_print_scripts('edmunds-api-js');

		//initialize the edmunds objects
		self::pp_edmunds_init();
	}

	//Output required edmunds javascript to footer.
	static function pp_edmunds_init()
	{
		?>

	<script type='text/javascript'>
/*==============================================================================
Logic for Redirecting User
Redirects user to related page based on the body style of the car they select
================================================================================= */

//I'm wrapping the code in a function closure to keep it out of the global namespace. That way its variables can't interfere or be interfered with by other js scripts.
(function($) {
    var root = "<?php echo home_url(); ?>/";
    var select = {
    "SUV": "<?php echo pp_suv(); ?>",
    "Coupe": "<?php echo pp_coupe(); ?>",
    "Sedan": "<?php echo pp_sedan(); ?>",
    "Hatchback": "<?php echo pp_hatchback(); ?>",
    "TSX Sport Wagon": "<?php echo pp_sport_wagon(); ?>",
    "Convertible": "<?php echo pp_convertible(); ?>",
    "Wagon": "<?php echo pp_wagon(); ?>",
    "Continental GT Speed Convertible": "<?php echo pp_convertible(); ?>",
    "Continental Supersports Convertible": "<?php echo pp_convertible(); ?>",
    "Supersports Convertible ISR": "<?php echo pp_convertible(); ?>",
    "Estate Wagon": "<?php echo pp_wagon(); ?>",
    "Minivan": "<?php echo pp_minivan(); ?>",
    "ATS Coupe": "<?php echo pp_coupe(); ?>",
    "CTS Coupe": "<?php echo pp_coupe(); ?>",
    "CTS Wagon": "<?php echo pp_wagon(); ?>",
    "CTS-V Coupe": "<?php echo pp_coupe(); ?>",
    "CTS-V Wagon": "<?php echo pp_wagon(); ?>",
    "Crew Cab": "<?php echo pp_crew_cab(); ?>",
    "Regular Cab": "<?php echo pp_regular_cab(); ?>",
    "Extended Cab": "<?php echo pp_extended_cab(); ?>",
    "Chevy Van": "<?php echo pp_van(); ?>",
    "Chevy Van Classic": "<?php echo pp_van(); ?>",
    "Van": "<?php echo van(); ?>",
    "Lumina Minivan": "<?php echo pp_minivan(); ?>",
    "Double Cab": "<?php echo pp_double_cab(); ?>",
    "Club Cab": "<?php echo pp_extended_cab(); ?>",
    "Quad Cab": "<?php echo pp_supercab(); ?>",
    "Mega Cab": "<?php echo pp_supercab(); ?>",
    "Ram Van": "<?php echo pp_van(); ?>",
    "E-Series Van": "<?php echo pp_van(); ?>",
    "SuperCab": "<?php echo pp_supercab(); ?>",
    "SuperCrew": "<?php echo pp_extended_cab(); ?>",
    "Transit Van": "<?php echo pp_van(); ?>",
    "Elantra Coupe": "<?php echo pp_coupe(); ?>",
    "Genesis Coupe": "<?php echo pp_coupe(); ?>",
    "G Convertible": "<?php echo pp_convertible(); ?>",
    "G Coupe": "<?php echo pp_coupe(); ?>",
    "G Sedan": "<?php echo pp_sedan(); ?>",
    "G37 Convertible": "<?php echo pp_convertible(); ?>",
    "G37 Coupe": "<?php echo pp_coupe(); ?>",
    "G37 Sedan": "<?php echo pp_sedan(); ?>",
    "Q60 Convertible": "<?php echo pp_convertible(); ?>",
    "Q60 Coupe": "<?php echo pp_coupe(); ?>",
    "Koup": "<?php echo pp_coupe(); ?>",
    "GranTurismo Convertible": "<?php echo pp_convertible(); ?>",
    "Cab Plus": "<?php echo pp_extended_cab(); ?>",
    "Cab Plus 4": "<?php echo pp_extended_cab(); ?>",
    "650S Coupe": "<?php echo pp_coupe(); ?>",
    "King Cab":  "<?php echo pp_supercab(); ?>", // ****** Add
    "Promaster Cargo Van": "<?php echo pp_van(); ?>", // ****** Add
    "Promaster Window Van": "<?php echo pp_van(); ?>", // ****** Add
    "Phantom Coupe": "<?php echo pp_coupe(); ?>",
    "Xtracab": "<?php echo pp_double_cab(); ?>",
    "Access Cab": "<?php echo pp_double_cab(); ?>",  // ****** Add
    "CrewMax Cab": "<?php echo pp_extended_cab(); ?>",
    "Beetle Convertible": "<?php echo pp_convertible(); ?>",
    };

    //Make a helper function to set the href to avoid repeat code
    function setWindowLocation(path) {
        window.location.href = root + path;
    }
    
    $('#get-quote').click(function (){
        var body = $('#iq-body').val();
        var make = $('#iq-make').val();
        var model = $('#iq-model').val();
         $.removeCookie('style', { path: '/' });  
         $.removeCookie('make', { path: '/' }); 
         $.removeCookie('model', { path: '/' });          
        //determine whether or not the key "body" exists in the object "select"                  
        if (body in select && body) {
          $.cookie('make', make, { expires: 7, path: '/' });
          $.cookie('model', model, { expires: 7, path: '/' });
            setWindowLocation(select[body]);
            console.log(body);
        } else {
            setWindowLocation("<?php echo tq_default(); ?>");
          }                                      
    });  
    $('#iq-body-select').hide();
    $('#iq-body-select').removeClass('hide');
    $('#iq-not-found').click(function (){
      $('#iq-body-select').slideDown(200);  
    });
    $('#iq-body-alt').change(function(){
        var self = $(this);
        var body = self.val();
        console.log(body);
        $.removeCookie('style', { path: '/' });  
         $.removeCookie('make', { path: '/' }); 
         $.removeCookie('model', { path: '/' });          
        if (body in select && body) {
          $.cookie('make', body, { expires: 7, path: '/' });
           $.cookie('model', 'Instant Quote', { expires: 7, path: '/' });
   
            setWindowLocation(select[body]);
            console.log(body);
        } else {
            setWindowLocation("<?php echo pp_default(); ?>");
          }         
      }); 
})(jQuery);

	</script>
	    <?php
	}
}

/*===============================================================
Shortcode for result pages, 
=================================================================*/

//Register ShortCode [pp-result]
add_shortcode('pp-result', 'pp_result' ); 
     
function pp_result($atts) {
return "<h1 class='selected-name title-1 p-l pad-10px'></h1>
<script>
    jQuery(document).ready(function($) {
          var make = $.cookie('make');
          var model = $.cookie('model');
          console.log('style'); 
          if (make !== 'undefined' && make !== '' && make !== 'null' ) {
            $('.selected-name').append(make + ', ' + model); 
          } else { $('.selected-name').append('Your Selection'); }
    });
</script>";
}


//Initilazed the object
pp_edmundsAPI::pp_init();

?>
