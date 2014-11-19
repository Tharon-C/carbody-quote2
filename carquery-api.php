<?php
/*
Plugin Name: Car Selector
Plugin URI: http://taglinegroup.com
Description: Based on Car Query API, user selects car year, make, model, and trim to be dirceted to a page based on criteria. 
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

//Function for grabbing body style and navigating to corect page.

     	$('#cq-show-data').click(
     	function bodyStyle(){
     			var body = $("td:contains('Body Style:')").next().text();
     			console.log(body);
     			var select = {
     				 "Pickup": 					"http://localhost/theme_dev/price-a"
     				,"SUV":						"http://localhost/theme_dev/price-c"
     				,"Sedan":					"http://localhost/theme_dev/price-b"
     				,"Coupe":					"http://localhost/theme_dev/price-a"
     				,"Compact Cars":			"http://localhost/theme_dev/price-a"
     				,"Convertible":				"http://localhost/theme_dev/price-a"			
     				,"Minivan":					"http://localhost/theme_dev/price-c"
     				,"Cargo Vans":				"http://localhost/theme_dev/price-c"
     				,"Van":						"http://localhost/theme_dev/price-d"
     				,"Crossover":				"http://localhost/theme_dev/price-c"
     				,"Hatchback":				"http://localhost/theme_dev/price-a"
     				,"Large Cars":				"http://localhost/theme_dev/price-b"
     				,"Midsize Cars":			"http://localhost/theme_dev/price-b"
     				,"Midsize Station Wagons":	"http://localhost/theme_dev/price-c"
     				,"Mini Compact Cars":		"http://localhost/theme_dev/price-a"
     				,"Panel Van":				"http://localhost/theme_dev/price-d"
     				,"Passenger Vans":			"http://localhost/theme_dev/price-d"
     				,"Roadster":				"http://localhost/theme_dev/price-a"
     				,"Small Pickup Trucks":		"http://localhost/theme_dev/price-a"
     				,"Small Station Wagons":	"http://localhost/theme_dev/price-c"
				}


     			if (body == select) {
     				window.location.href = select[body];
     			} else {
	     				$('#cq-need-more').show(500);
	     				$('#cq-body').change(function() {
	     				var body = $(this).val();
	     				console.log(body);
	     					if (body == select) {
			     				window.location.href = select[body];
			     			} else {
			     				window.location.href = "http://localhost/theme_dev/price-general";
			     			}
	     					
	     				});
     				}     				
     	});

	</script>
	    <?php
	}
}
//Initilazed the object
CarQueryAPI::init();

?>