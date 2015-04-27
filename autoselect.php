<?php
/*
Plugin Name: Car Body Quote
Plugin URI: http://taglinegroup.com
Description: Add short code [tq-quote] to the page you want the app to appear. Create different pricing pages with short code [tq-result] at the top and add the slug to a corresponding bodystyle in the plugin admin page (Settings/ Tint Quote). User selects car year, make, model, and trim to be direceted to a page based on criteria, Built on Car Query API. 
Author: Tharon Carlson
*/
add_action('wp_enqueue_scripts', 'as_styles'); // Add Theme Stylesheet
add_action('wp_enqueue_scripts', 'as_scripts'); // Add Theme Stylesheet

function as_styles() {
    wp_register_style('autoselect-css', plugins_url('/css/autoselect.css', __FILE__ ), array(), '1.0', 'all');
    wp_enqueue_style('autoselect-css'); // Enqueue it!
    wp_register_style('bootstrap-css', 'http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css', array(), '1.0', 'all');
    wp_enqueue_style('bootstrap-css'); // Enqueue it!
}

function as_scripts() {
    wp_enqueue_script('bootstrap-js', 'http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js', array(), '1.0', true); // Enqueue it!
    wp_enqueue_script('cookie-js', plugins_url('/js/lib/jquery.cookie.js', __FILE__ ), array('jquery'), '1.0', true); // Enqueue it!
    wp_enqueue_script('angular-js', plugins_url('/bower_components/angular/angular.min.js', __FILE__ ), array('jquery' , 'bootstrap-js'), '1.0', true); // Enqueue it!
    wp_enqueue_script('ui-angular-js', plugins_url('/bower_components/angular-ui-utils/ui-utils.min.js', __FILE__ ), array('angular-js'), '1.0', true); // Enqueue it!
    wp_enqueue_script('sanitize-angular-js', 'http://cdnjs.cloudflare.com/ajax/libs/angular.js/1.3.14/angular-sanitize.js', array('angular-js'), '1.0', true); // Enqueue it!
    wp_enqueue_script('edmunds-api-js', plugins_url('/js/main.js', __FILE__ ), array('angular-js','ui-angular-js', 'sanitize-angular-js'), '1.0', true); // Enqueue it!
}

add_action( 'admin_menu', 'my_admin_menu' );
function my_admin_menu() {
    add_options_page( 'Car Tint Quote', 'Tint Quote', 'manage_options', 'tint-quote', 'my_options_page' );
}

add_action( 'admin_init', 'tq_admin_init' );
function tq_admin_init() {
    add_settings_section( 'section-one', 'Body Styles', 'section_one_callback', 'tint-quote' );
    register_setting( 'my-settings-group', 'suv' );
    register_setting( 'my-settings-group', 'coupe' );
    register_setting( 'my-settings-group', 'sedan' );
    register_setting( 'my-settings-group', 'hatchback' );
    register_setting( 'my-settings-group', 'convertible' );
    register_setting( 'my-settings-group', 'wagon' );
    register_setting( 'my-settings-group', 'sport-wagon' );
    register_setting( 'my-settings-group', 'pickup' );
    register_setting( 'my-settings-group', 'crew-cab' );
    register_setting( 'my-settings-group', 'extended-cab' );
    register_setting( 'my-settings-group', 'regular-cab' );
    register_setting( 'my-settings-group', 'supercab' );
    register_setting( 'my-settings-group', 'double-cab' );
    register_setting( 'my-settings-group', 'van' );
    register_setting( 'my-settings-group', 'minivan' );
    register_setting( 'my-settings-group', 'tq-default' );
    add_settings_field( 'field-suv', 'SUV', 'field_suv_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-coupe', 'Coupe', 'field_coupe_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-sedan', 'Sedan', 'field_sedan_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-hatchback', 'Hatchback', 'field_hatchback_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-convertible', 'Convertible', 'field_convertible_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-tsx-sport-wagon', 'Sport Wagon', 'field_sport_wagon_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-wagon', 'Wagon', 'field_wagon_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-pickup', 'Pickup', 'field_pickup_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-crew-cab', 'Crew Cab', 'field_crew_cab_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-extended-cab', 'Extended Cab', 'field_extended_cab_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-regular-cab', 'Regular Cab', 'field_regular_cab_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-supercab', 'SuperCab', 'field_supercab_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-double-cab', 'Double Cab', 'field_double_cab_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-van', 'Van', 'field_van_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-minivan', 'Minivan', 'field_minivan_callback', 'tint-quote', 'section-one' );  
    add_settings_field( 'field-tq-default', 'Default', 'field_tq_default_callback', 'tint-quote', 'section-one' );
}

// Instructions to user
function section_one_callback() {
    echo '<p>Create a page you would like your car selection form on and add the short code [cq-quote]. <br>Then create a result page that fits your pricing for each body style and add the code [cq-result]. <br>For each body style below, add the page slug you would like the user to be directed to.</p>
          <b>Example: your-page-slug</b>';
}

// Fields For Admin Page
function field_suv_callback() {
    $setting = esc_attr( get_option( 'suv' ) );
    echo "<input type='text' name='suv' value='$setting' />";
}
function field_coupe_callback() {
    $setting = esc_attr( get_option( 'coupe' ) );
    echo "<input type='text' name='coupe' value='$setting' />";
}
function field_sedan_callback() {
    $setting = esc_attr( get_option( 'sedan' ) );
    echo "<input type='text' name='sedan' value='$setting' />";
}
function field_hatchback_callback() {
    $setting = esc_attr( get_option( 'hatchback' ) );
    echo "<input type='text' name='hatchback' value='$setting' />";
}
function field_convertible_callback() {
    $setting = esc_attr( get_option( 'convertible' ) );
    echo "<input type='text' name='convertible' value='$setting' />";
}
function field_sport_wagon_callback() {
    $setting = esc_attr( get_option( 'sport-wagon' ) );
    echo "<input type='text' name='sport-wagon' value='$setting' />";
}

function field_wagon_callback() {
    $setting = esc_attr( get_option( 'wagon' ) );
    echo "<input type='text' name='wagon' value='$setting' />";
}

function field_pickup_callback() {
    $setting = esc_attr( get_option( 'pickup' ) );
    echo "<input type='text' name='pickup' value='$setting' />";
}

function field_crew_cab_callback() {
    $setting = esc_attr( get_option( 'crew-cab' ) );
    echo "<input type='text' name='crew-cab' value='$setting' />";
}

function field_extended_cab_callback() {
    $setting = esc_attr( get_option( 'extended-cab' ) );
    echo "<input type='text' name='extended-cab' value='$setting' />";
}

function field_regular_cab_callback() {
    $setting = esc_attr( get_option( 'regular-cab' ) );
    echo "<input type='text' name='regular-cab' value='$setting' />";
}

function field_supercab_callback() {
    $setting = esc_attr( get_option( 'supercab' ) );
    echo "<input type='text' name='supercab' value='$setting' />";
}

function field_double_cab_callback() {
    $setting = esc_attr( get_option( 'double-cab' ) );
    echo "<input type='text' name='double-cab' value='$setting' />";
}

function field_crewmax_cab_callback() {
    $setting = esc_attr( get_option( 'crewmax-cab' ) );
    echo "<input type='text' name='crewmax-cab' value='$setting' />";
}

function field_van_callback() {
    $setting = esc_attr( get_option( 'van' ) );
    echo "<input type='text' name='van' value='$setting' />";
}


function field_minivan_callback() {
    $setting = esc_attr( get_option( 'minivan' ) );
    echo "<input type='text' name='minivan' value='$setting' />";
}
function field_tq_default_callback() {
    $setting = esc_attr( get_option( 'tq-default' ) );
    echo "<input type='text' name='tq-default' value='$setting' />";
}


//Admin Page Layout
function my_options_page() {
    ?>
    <div class="wrap">
        <h2>Car Tint Quote</h2>
        <form action="options.php" method="POST">
            <?php settings_fields( 'my-settings-group' ); ?>
            <?php do_settings_sections( 'tint-quote' ); ?>
            <?php submit_button(); ?>
        </form>
    </div>
    <?php
}


// Setting variables for application 
function suv() {
  $select = get_option( 'suv' );
  return $select;
}
function coupe() {
  $select = get_option( 'coupe' );
  return $select;
}
function sedan() {
  $select = get_option( 'sedan' );
  return $select;
}
function hatchback() {
  $select = get_option( 'hatchback' );
  return $select;
}
function convertible() {
  $select = get_option( 'convertible' );
  return $select;
}
function beetle_convertible() {
  $select = get_option( 'beetle-convertible' );
  return $select;
}
function sport_wagon() {
  $select = get_option( 'sport-wagon' );
  return $select;
}
function wagon() {
  $select = get_option( 'wagon' );
  return $select;
}
function crew_cab() {
  $select = get_option( 'crew-cab' );
  return $select;
}
function extended_cab() {
  $select = get_option( 'extended-cab' );
  return $select;
}
function regular_cab() {
  $select = get_option( 'regular-cab' );
  return $select;
}
function supercab() {
  $select = get_option( 'supercab' );
  return $select;
}
function double_cab() {
  $select = get_option( 'double-cab' );
  return $select;
}
function van() {
  $select = get_option( 'van' );
  return $select;
}
function minivan() {
  $select = get_option( 'minivan' );
  return $select;
}
function tq_default() {
  $select = get_option( 'tq-default' );
  return $select;
}

/*=======================================================================================
Edmunds JSON APIwill populate select input options 
and return list of specification for the car selected
========================================================================================== */

Class edmundsAPI{

	static $add_script;

	static function init() {

		//Register ShortCode
		add_shortcode("tq-quote", 	array(__CLASS__, 'tq_quote' )); 
		 
		//Load javascript in wp_footer
		
		add_action('init', 		array(__CLASS__, 'register_script' ));
		
		add_action('wp_footer', array(__CLASS__, 'print_script' ));
	}
	
static function tq_quote() {
		//Trigger javascript scripts to load
		self::$add_script = true;
    include( plugin_dir_path( __FILE__ ) . 'dropdowns.php');
   ;}

	//Include necessary javascript files
	static function register_script() {
    
	}

	//check if the short codes were used, print js if required
	static function print_script() {

		//Only load javascript if the short code events were triggered
		if ( ! self::$add_script )
			return;

		wp_print_scripts('edmunds-api-js');

		//initialize the edmunds objects
		self::edmunds_init();
	}

	//Output required edmunds javascript to footer.
	static function edmunds_init()
	{
		?>

	<script type='text/javascript'>
/*==============================================================================
Logic for Redirecting User
Redirects user to related page based on the body style of the car they select
================================================================================= */

//I'm wrapping the code in a function closure to keep it out of the global namespace. That way its variables can't interfere or be interfered with by other js scripts.
(function($) {
    //instead of repeating the href over and over again in the "select" object, we pull it dynamically from the global javascript object ("window")
    var root = "<?php echo home_url(); ?>/";
    var select = {
        "SUV": "<?php echo suv(); ?>",
        "Coupe": "<?php echo coupe(); ?>",
        "Sedan" :  "<?php echo sedan(); ?>",
        "Hatchback" :  "<?php echo hatchback(); ?>",
        "Convertible": "<?php echo convertible(); ?>",
        "Continental GT Speed Convertible": "<?php echo convertible(); ?>",
        "Beetle Convertible": "<?php echo convertible(); ?>",
        "TSX Sport Wagon": "<?php echo sport_wagon(); ?>",
        "CTS-V Coupe": "<?php echo coupe(); ?>",
        "CTS Coupe": "<?php echo coupe(); ?>",
        "CTS-V Wagon": "<?php echo wagon(); ?>",
        "CTS Wagon": "<?php echo wagon(); ?>",
        "Wagon": "<?php echo wagon(); ?>",
        "Crew Cab": "<?php echo crew_cab(); ?>",
        "Extended Cab": "<?php echo extended_cab(); ?>",
        "Regular Cab": "<?php echo regular_cab(); ?>",
        "SuperCab": "<?php echo supercab(); ?>",
        "Double Cab": "<?php echo double_cab(); ?>",
        "CrewMax Cab": "<?php echo extended_cab(); ?>",
        "Quad Cab": "<?php echo supercab(); ?>",
        "Club Cab": "p<?php echo extended_cab(); ?>",
        "Van": "<?php echo van(); ?>",
        "Ram Van": "<?php echo van(); ?>",
        "Minivan": "<?php echo minivan(); ?>"
    };

    //Make a helper function to set the href to avoid repeat code
    function setWindowLocation(path) {
        window.location.href = root + path;
    }
    console.log('body');
    $('#get-quote').click(function (){
        //use of the selector here is going to be very slow. Need a way to call just the body style into a div with id.
        var body = $('#iq-body').val();
         var doors = $("td:contains('Doors:')").next().text();
        var make = $('#iq-make').val();
        var model = $('#iq-model').val();
        
        console.log(make);
        console.log(model);
         $.removeCookie('style', { path: '/' });  
         $.removeCookie('make', { path: '/' }); 
         $.removeCookie('model', { path: '/' });          
        //Here I'm using the "in" operator to determine whether or not the key "body" exists in the object "select"
        //the equality operator "==" will only check whether or not "body" has the same elements as  "select"                    
        if (body in select && body) {
          $.cookie('make', make, { expires: 7, path: '/' });
          $.cookie('model', model, { expires: 7, path: '/' });
            setWindowLocation(select[body]);
            console.log(body);
        } else {
            setWindowLocation("<?php echo tq_default(); ?>");
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

//Register ShortCode [tq-result]
add_shortcode('tq-result', 'tq_result' ); 
     
function tq_result($atts) {
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
edmundsAPI::init();

?>
