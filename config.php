<?php
ini_set( "display_errors", true );
date_default_timezone_set( "Europe/Moscow" );  // http://www.php.net/manual/en/timezones.php
define( "DB_DSN", "mysql:host=localhost;dbname=statistics_ads" );
define( "DB_USERNAME", "name" );
define( "DB_PASSWORD", "password" );
define( "CLASS_PATH", "classes" );
define( "TEMPLATE_PATH", "templates" );
define( "WIEV_NUM", 15 );
require( CLASS_PATH . "/Theme.php" );
require( CLASS_PATH . "/Resource.php" );
require( CLASS_PATH . "/AdUnit.php" );
//require( CLASS_PATH . "/ImpressionStatistics.php" );
//require( CLASS_PATH . "/ClickStatistics.php" );
require( CLASS_PATH . "/Statistics.php" );
function handleException( $exception ) {
  echo "Sorry, a problem occurred. Please try later.";
  error_log( $exception->getMessage() );
}
ini_set('display_errors','Off');
set_exception_handler( 'handleException' );
?>
