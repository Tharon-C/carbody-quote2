<?php
/*
Plugin Name: Auto Selector
Plugin URI: http://taglinegroup.com
Description: Based on Car Query API, user selects car year, make, model, and trim to be direceted to a page based on criteria. 
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
    
    add_settings_field( 'field-one', 'Pickup', 'field_one_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-two', 'SUV', 'field_two_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-three', 'sedan', 'field_three_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-four', 'coupe', 'field_four_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-five', 'compact-cars', 'field_five_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-six', 'convertible', 'field_six_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-seven', 'minivan', 'field_seven_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-eight', 'cargo-vans', 'field_eight_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-nine', 'crossover', 'field_nine_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-ten', 'hatchback', 'field_ten_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-eleven', 'large-cars', 'field_eleven_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-twelve', 'midsize-cars', 'field_twelve_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-thirteen', 'midsize-station-wagons', 'field_thirteen_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-fourteen', 'mini-compact-cars', 'field_fourteen_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-fifteen', 'panel-van', 'field_fifteen_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-sixteen', 'passenger-vans', 'field_sixteen_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-seventeen', 'roadster', 'field_seventeen_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-eighteen', 'small-pickup-trucks', 'field_eighteen_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-nineteen', 'small-station-wagons', 'field_nineteen_callback', 'tint-quote', 'section-one' );
    add_settings_field( 'field-twenty', 'van', 'field_twenty_callback', 'tint-quote', 'section-one' );
}



// Instructions to user
function section_one_callback() {
    echo '<p>For each body style below, add the page slug you would like the user to be directed to.</p>
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

/*====================================================================
Car Querry JSON API
will populate select input options and get related bodystyle for redirect
======================================================================= */

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

	 	return '<select class="sel-1" name="cq-year" id="cq-year"></select>
	 			<select class="sel-1" name="cq-make" id="cq-make"></select>
	 			<select class="sel-1" name="cq-model" id="cq-model"></select>
	 			<select class="sel-1" name="cq-trim" id="cq-trim"></select>
	 			<input class="btn-1 button" id="cq-show-data" type="button" value="Get Quote"/>
				<div id="car-model-data"> </div>
				<div id="cq-need-more">
				<span class="title-2">Please select the option below that best describes your vehicle</span> 
				<select class="sel-1" name="cq-model" id="cq-body"></select>
				</div>
	 	';}

	


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
     
	 carquery.year_select_max=2013;
 
     //Optional: initialize search interface elements.
     //The IDs provided below are the IDs of the text and select inputs that will be used to set the search criteria.
     //All values are optional, and will be set to the default values provided below if not specified.
     
	 var searchArgs =
	 ({
         body_id:                       "cq-body"
        ,default_search_text:           "Keyword Search"
        ,doors_id:                      "cq-doors"
        ,drive_id:                      "cq-drive"
        ,engine_position_id:            "cq-engine-position"
        ,engine_type_id:                "cq-engine-type"
        ,fuel_type_id:                  "cq-fuel-type"
        ,min_cylinders_id:              "cq-min-cylinders"
        ,min_mpg_hwy_id:                "cq-min-mpg-hwy"
        ,min_power_id:                  "cq-min-power"
        ,min_top_speed_id:              "cq-min-top-speed"
        ,min_torque_id:                 "cq-min-torque"
        ,min_weight_id:                 "cq-min-weight"
        ,min_year_id:                   "cq-min-year"
        ,max_cylinders_id:              "cq-max-cylinders"
        ,max_mpg_hwy_id:                "cq-max-mpg-hwy"
        ,max_power_id:                  "cq-max-power"
        ,max_top_speed_id:              "cq-max-top-speed"
        ,max_weight_id:                 "cq-max-weight"
        ,max_year_id:                   "cq-max-year"
        ,search_controls_id:            "cq-search-controls"
        ,search_input_id:               "cq-search-input"
        ,search_results_id:             "cq-search-results"
        ,search_result_id:              "cq-search-result"
        ,seats_id:                      "cq-seats"
        ,sold_in_us_id:                 "cq-sold-in-us"
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
        console.log(body);
                           
        //Here I'm using the "in" operator to determine whether or not the key "body" exists in the object "select"
        //the equality operator "==" will only check whether or not "body" has the same elements as  "select"                    
        if (body in select) {
            setWindowLocation(select[body]);
        } else {
            $('#cq-need-more').show(500);
            
            $('#cq-body').change(function() {
                var body = $(this).val();
                console.log(body);
                
                if (body in select) {
                    setWindowLocation(select[body]);
                } else {
                    setWindowLocation("price-general");
                }

            });
        }
                                                   
    });
})(jQuery);

	</script>
	    <?php
	}
}
//Initilazed the object
CarQueryAPI::init();

?>