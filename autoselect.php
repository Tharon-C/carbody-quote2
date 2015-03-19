<?php
/*
Plugin Name: Auto Selector
Plugin URI: http://taglinegroup.com
Description: Add short code [cq-quote] to the page you want the app to appear. Create different pricing pages and add the slug to a corresponding bodystyle in the plugin admin page (Settings/ Tint Quote). User selects car year, make, model, and trim to be direceted to a page based on criteria, Built on Car Query API. 
Author: Tharon Carrlson

Car Query API Doc
Author URI: http://www.carqueryapi.com
License: GPL2

Plugin Name: Official CarQuery API Wordpress Plugin
Plugin URI: http://www.carqueryapi.com/demo/wordpress-plugin/
Description: The CarQuery API plugin easily creates dependent vehicle year, make, model, and trim dropdowns.
Version: 1.1
Author: CarQueryAPI
Author URI: http://www.carqueryapi.com
License: GPL2
Copyright 2012 CarQueryAPI  (email : dan@carqueryapi.com)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
add_action('wp_enqueue_scripts', 'as_styles'); // Add Theme Stylesheet
add_action('wp_enqueue_scripts', 'as_scripts'); // Add Theme Stylesheet

function as_styles() {
    wp_register_style('autoselect-css', plugins_url('/css/autoselect.css', __FILE__ ), array(), '1.0', 'all');
    wp_enqueue_style('autoselect-css'); // Enqueue it!
}

function as_scripts() {
    wp_enqueue_script('cookie-js', plugins_url('/js/lib/jquery.cookie.js', __FILE__ ), array('jquery'), '1.0', true); // Enqueue it!
}

add_action( 'admin_menu', 'my_admin_menu' );
function my_admin_menu() {
    add_options_page( 'Car Tint Quote', 'Tint Quote', 'manage_options', 'tint-quote', 'my_options_page' );
}

add_action( 'admin_init', 'my_admin_init' );
function my_admin_init() {
    add_settings_section( 'section-one', 'Body Styles', 'section_one_callback', 'tint-quote' );
    register_setting( 'my-settings-group', 'pickup' );
    register_setting( 'my-settings-group', 'suv' );
    register_setting( 'my-settings-group', 'sedan' );
    register_setting( 'my-settings-group', 'coupe' );
    register_setting( 'my-settings-group', 'compact-cars' );
    register_setting( 'my-settings-group', 'convertible' );
    register_setting( 'my-settings-group', 'minivan' );
    register_setting( 'my-settings-group', 'cargo-vans' );
    register_setting( 'my-settings-group', 'van' );
    register_setting( 'my-settings-group', 'crossover' );
    register_setting( 'my-settings-group', 'hatchback' );
    register_setting( 'my-settings-group', 'large-cars' );
    register_setting( 'my-settings-group', 'midsize-cars' );
    register_setting( 'my-settings-group', 'midsize-station-wagons' );
    register_setting( 'my-settings-group', 'mini-compact-cars' );
    register_setting( 'my-settings-group', 'panel-van' );
    register_setting( 'my-settings-group', 'passenger-vans' );
    register_setting( 'my-settings-group', 'roadster' );
    register_setting( 'my-settings-group', 'small-pickup-trucks' );
    register_setting( 'my-settings-group', 'small-station-wagons' );
    register_setting( 'my-settings-group', 'cq-default' );
    
    add_settings_field( 'field-one', 'Pickup', 'field_one_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-two', 'SUV', 'field_two_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-three', 'Sedan', 'field_three_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-four', 'Coupe', 'field_four_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-five', 'Compact Cars', 'field_five_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-six', 'Convertible', 'field_six_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-seven', 'Minivan', 'field_seven_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-eight', 'Cargo Vans', 'field_eight_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-nine', 'Crossover', 'field_nine_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-ten', 'Hatchback', 'field_ten_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-eleven', 'Large Cars', 'field_eleven_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-twelve', 'Midsize Cars', 'field_twelve_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-thirteen', 'Midsize Station Wagons', 'field_thirteen_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-fourteen', 'Mini Compact Cars', 'field_fourteen_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-fifteen', 'panel Van', 'field_fifteen_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-sixteen', 'Passenger Vans', 'field_sixteen_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-seventeen', 'Roadster', 'field_seventeen_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-eighteen', 'Small Pickup Trucks', 'field_eighteen_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-nineteen', 'Small Station Wagons', 'field_nineteen_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-twenty', 'Van', 'field_twenty_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-twentyone', 'Default', 'field_twentyone_callback', 'tint-quote', 'section-one' );
}



// Instructions to user
function section_one_callback() {
    echo '<p>Create a page you would like your car selection form on and add the short code [cq-quote]. <br>Then create a result page that fits your pricing for each body style and add the code [cq-result]. <br>For each body style below, add the page slug you would like the user to be directed to.</p>
          <b>Example: your-page-slug</b>';
}

// Fields For Admin Page
function field_one_callback() {
    $setting = esc_attr( get_option( 'pickup' ) );
    echo "<input type='text' name='pickup' value='$setting' />";
}
function field_two_callback() {
    $setting = esc_attr( get_option( 'suv' ) );
    echo "<input type='text' name='suv' value='$setting' />";
}
function field_three_callback() {
    $setting = esc_attr( get_option( 'sedan' ) );
    echo "<input type='text' name='sedan' value='$setting' />";
}
function field_four_callback() {
    $setting = esc_attr( get_option( 'coupe' ) );
    echo "<input type='text' name='coupe' value='$setting' />";
}
function field_five_callback() {
    $setting = esc_attr( get_option( 'compact-cars' ) );
    echo "<input type='text' name='compact-cars' value='$setting' />";
}
function field_six_callback() {
    $setting = esc_attr( get_option( 'convertible' ) );
    echo "<input type='text' name='convertible' value='$setting' />";
}
function field_seven_callback() {
    $setting = esc_attr( get_option( 'minivan' ) );
    echo "<input type='text' name='minivan' value='$setting' />";
}
function field_eight_callback() {
    $setting = esc_attr( get_option( 'cargo-vans' ) );
    echo "<input type='text' name='cargo-vans' value='$setting' />";
}
function field_nine_callback() {
    $setting = esc_attr( get_option( 'crossover' ) );
    echo "<input type='text' name='crossover' value='$setting' />";
}
function field_ten_callback() {
    $setting = esc_attr( get_option( 'hatchback' ) );
    echo "<input type='text' name='hatchback' value='$setting' />";
}
function field_eleven_callback() {
    $setting = esc_attr( get_option( 'large-cars' ) );
    echo "<input type='text' name='large-cars' value='$setting' />";
}
function field_twelve_callback() {
    $setting = esc_attr( get_option( 'midsize-cars' ) );
    echo "<input type='text' name='midsize-cars' value='$setting' />";
}
function field_thirteen_callback() {
    $setting = esc_attr( get_option( 'midsize-station-wagons' ) );
    echo "<input type='text' name='midsize-station-wagons' value='$setting' />";
}
function field_fourteen_callback() {
    $setting = esc_attr( get_option( 'mini-compact-cars' ) );
    echo "<input type='text' name='mini-compact-cars' value='$setting' />";
}
function field_fifteen_callback() {
    $setting = esc_attr( get_option( 'panel-van' ) );
    echo "<input type='text' name='panel-van' value='$setting' />";
}
function field_sixteen_callback() {
    $setting = esc_attr( get_option( 'passenger-vans' ) );
    echo "<input type='text' name='passenger-vans' value='$setting' />";
}
function field_seventeen_callback() {
    $setting = esc_attr( get_option( 'roadster' ) );
    echo "<input type='text' name='roadster' value='$setting' />";
}
function field_eighteen_callback() {
    $setting = esc_attr( get_option( 'small-pickup-trucks' ) );
    echo "<input type='text' name='small-pickup-trucks' value='$setting' />";
}
function field_nineteen_callback() {
    $setting = esc_attr( get_option( 'small-station-wagons' ) );
    echo "<input type='text' name='small-station-wagons' value='$setting' />";
}
function field_twenty_callback() {
    $setting = esc_attr( get_option( 'van' ) );
    echo "<input type='text' name='van' value='$setting' />";
}
function field_twentyone_callback() {
    $setting = esc_attr( get_option( 'cq-default' ) );
    echo "<input type='text' name='cq-default' value='$setting' />";
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
function pickup() {
  $select = get_option( 'pickup' );
  return $select;
}
function suv() {
  $select = get_option( 'suv' );
  return $select;
}
function sedan() {
  $select = get_option( 'sedan' );
  return $select;
}
function coupe() {
  $select = get_option( 'coupe' );
  return $select;
}
function compact_cars() {
  $select = get_option( 'compact-cars' );
  return $select;
}
function convertible() {
  $select = get_option( 'convertible' );
  return $select;
}
function minivan() {
  $select = get_option( 'minivan' );
  return $select;
}
function cargo_vans() {
  $select = get_option( 'cargo-vans' );
  return $select;
}
function crossover() {
  $select = get_option( 'crossover' );
  return $select;
}
function hatchback() {
  $select = get_option( 'hatchback' );
  return $select;
}
function large_cars() {
  $select = get_option( 'large-cars' );
  return $select;
}
function midsize_cars() {
  $select = get_option( 'midsize-cars' );
  return $select;
}
function midsize_station_wagons() {
  $select = get_option( 'midsize-station-wagons' );
  return $select;
}
function mini_compact_cars() {
  $select = get_option( 'mini-compact-cars' );
  return $select;
}
function panel_van() {
  $select = get_option( 'panel-van' );
  return $select;
}
function passenger_vans() {
  $select = get_option( 'passenger-vans' );
  return $select;
}
function roadster() {
  $select = get_option( 'roadster' );
  return $select;
}
function small_pickup_trucks() {
  $select = get_option( 'small-pickup-trucks' );
  return $select;
}
function small_station_wagons() {
  $select = get_option( 'small-station-wagons' );
  return $select;
}
function van() {
  $select = get_option( 'van' );
  return $select;
}
function cq_default() {
  $select = get_option( 'cq-default' );
  return $select;
}

/*=======================================================================================
Car Querry JSON APIwill populate select input options 
and return list of specification for the car selected
========================================================================================== */

Class CarQueryAPI{

	static $add_script;

	static function init() {

		//Register ShortCode
		add_shortcode("cq-quote", 	array(__CLASS__, 'cq_quote' )); 
		 
		//Load javascript in wp_footer
		
		add_action('init', 		array(__CLASS__, 'register_script' ));
		
		add_action('wp_footer', array(__CLASS__, 'print_script' ));
	}
	
static function cq_quote() {

		//Trigger javascript scripts to load
		self::$add_script = true;
    $_SESSION['year'] = '1977';
	 	return  '
	<label>Year</label>
        <select class="sel-1" name="cq-year" id="cq-year"></select>
        <label>Make</label>
 	<select class="sel-1" name="cq-make" id="cq-make"></select>
 	<label>Model</label>
 	<select class="sel-1" name="cq-model" id="cq-model"></select>
 	<label>trim</label>
 	<select class="sel-1" name="cq-trim" id="cq-trim"></select>
 	<input class="btn-1 button" id="cq-show-data" type="button" value="Get Quote"/>
	<div id="car-model-data"> </div>
	<div id="cq-need-more">
	<span class="title-3">Please select the option below that best describes your vehicle</span> 
	<select class="sel-1" name="cq-model" id="cq-body"></select>
	</div>
	 	'
   ;}




	//Include necessary javascript files
	static function register_script() {
		wp_register_script('carquery-api-js', 'http://www.carqueryapi.com/js/carquery.0.3.4.js', array('jquery'), '0.3.4', true);
	}


	//check if the short codes were used, print js if required
	static function print_script() {

		//Only load javascript if the short code events were triggered
		if ( ! self::$add_script )
			return;

		wp_print_scripts('carquery-api-js');

		//initialize the carquery objects
		self::carquery_init();
	}


	//Output required carquery javascript to footer.
	static function carquery_init()
	{
		?>

	<script type='text/javascript'>
	
	$(document).ready(
	
	function()
	{
		$('#cq-need-more').hide();
     //Create a variable for the CarQuery object.  You can call it whatever you like.
     var carquery = new CarQuery();

     //Run the carquery init function to get things started:
     
	 carquery.init();
     
     //Optionally, you can pre-select a vehicle by passing year / make / model / trim to the init function:
     //carquery.init('2000', 'dodge', 'Viper', 11636);

     //Optional: Pass sold_in_us:true to the setFilters method to show only US models. 
     
	 carquery.setFilters( {sold_in_us:true} );
	
     //Optional: initialize the year, make, model, and trim drop downs by providing their element IDs
    
	carquery.initYearMakeModelTrim('cq-year', 'cq-make', 'cq-model', 'cq-trim');

     //Optional: set the onclick event for a button to show car data.
     
	 $('#cq-trim').click(  function(){ carquery.populateCarData('car-model-data'); } );

     //Optional: initialize the make, model, trim lists by providing their element IDs.
     
	 carquery.initMakeModelTrimList('make-list', 'model-list', 'trim-list', 'trim-data-list', 'body-list');
	 
     //Optional: set minimum and/or maximum year options.
     
	 carquery.year_select_min=1947;
     
	 carquery.year_select_max=2015;
 
     //Optional: initialize search interface elements.
     //The IDs provided below are the IDs of the text and select inputs that will be used to set the search criteria.
     //All values are optional, and will be set to the default values provided below if not specified.
     
	 var searchArgs =
	 ({
         body_id:                       "cq-body"
      
     }); 
	 
     carquery.initSearchInterface(searchArgs);

     
//If creating a search interface, set onclick event for the search button.  Make sure the ID used matches your search button ID.
	 $('#cq-search-btn').click( function(){ carquery.search(); } );
	});


/*==============================================================================
Logic for Redirecting User
Redirects user to related page based on the body style of the car they select
================================================================================= */

//I'm wrapping the code in a function closure to keep it out of the global namespace. That way its variables can't interfere or be interfered with by other js scripts.
(function($) {
    //instead of repeating the href over and over again in the "select" object, we pull it dynamically from the global javascript object ("window")
    var root = "<?php echo home_url(); ?>/";
    var select = {
        "Pickup": "<?php echo pickup(); ?>",
        "SUV": "<?php echo suv(); ?>",
        "Sedan": "<?php echo sedan(); ?>",
        "Coupe": "<?php echo coupe(); ?>",
        "Compact Cars": "<?php echo compact_cars(); ?>",
        "Convertible": "<?php echo convertible(); ?>",
        "Minivan": "<?php echo minivan(); ?>",
        "Cargo Vans": "<?php echo cargo_vans(); ?>",
        "Van": "<?php echo van(); ?>",
        "Crossover": "<?php echo crossover(); ?>",
        "Hatchback": "<?php echo hatchback(); ?>",
        "Large Cars": "<?php echo large_cars(); ?>",
        "Midsize Cars": "<?php echo midsize_cars(); ?>",
        "Midsize Station Wagons": "<?php echo midsize_station_wagons(); ?>",
        "Panel Van": "<?php echo panel_van(); ?>",
        "Passenger Vans": "<?php echo passenger_vans(); ?>",
        "Roadster": "<?php echo roadster(); ?>",
        "Small Pickup Trucks": "p<?php echo small_pickup_trucks(); ?>",
        "Small Station Wagons": "<?php echo small_station_wagons(); ?>",
        "Mini Compact Cars": "<?php echo mini_compact_cars(); ?>"
    };

    //Make a helper function to set the href to avoid repeat code
    function setWindowLocation(path) {
        window.location.href = root + path;
    }

    $('#cq-show-data').click(function (){
        //use of the selector here is going to be very slow. Need a way to call just the body style into a div with id.
        var body = $("td:contains('Body Style:')").next().text();
         var doors = $("td:contains('Doors:')").next().text();
        var make = $('#cq-make').val();
        var model = $('#cq-model').val();
        console.log(body);
        console.log(doors);
        console.log(make);
         $.removeCookie('style', { path: '/' });  
         $.removeCookie('make', { path: '/' }); 
         $.removeCookie('model', { path: '/' });          
        //Here I'm using the "in" operator to determine whether or not the key "body" exists in the object "select"
        //the equality operator "==" will only check whether or not "body" has the same elements as  "select"                    
        if (body in select && body !== 'Pickup') {
          $.cookie('make', make, { expires: 7, path: '/' });
          $.cookie('model', model, { expires: 7, path: '/' });
            setWindowLocation(select[body]);
            console.log(body);
        } 
        else {
            if (doors > 2) {
              console.log(doors);
            } else {
            $('#cq-need-more').show(500);
          
            $('#cq-body').change(function() {
                var body = $(this).val();
                console.log(make);
                 
                if (body in select) {
                  $.cookie('make', make, { expires: 7, path: '/' });
                  $.cookie('model', model, { expires: 7, path: '/' });

                  setWindowLocation(select[body]);

                } else {
                    setWindowLocation("<?php echo cq_default(); ?>");
                }

            });
          } 
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

//Register ShortCode [cq-result]
add_shortcode('cq-result', 'cq_result' ); 
     
function cq_result($atts) {
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
CarQueryAPI::init();

?>
