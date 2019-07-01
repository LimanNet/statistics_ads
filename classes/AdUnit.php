<?php

/**
 * Class to handle ad unit adUnit
 */

class AdUnit
{
  // Properties

  /**
  * @var int The AdUnit ID from the database
  */
  public $id = null;

  /**
  * @var string Title of the AdUnit
  */
  public $title = null;

   /**
  * @var int The AdUnit resource ID
  */
  public $resourceId = null;

  /**
  * @var string A short description of the AdUnit
  */
  public $description = null;


  /**
  * Sets the object's properties using the values in the supplied array
  *
  * @param assoc The property values
  */

  public function __construct( $data=array() ) {
    if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
    if ( isset( $data['title'] ) ) $this->title = $data['title'];
    if ( isset( $data['resourceId'] ) ) $this->resourceId = (int) $data['resourceId'];
    if ( isset( $data['description'] ) ) $this->description = $data['description'];
  }


  /**
  * Sets the object's properties using the edit form post values in the supplied array
  *
  * @param assoc The form post values
  */

  public function storeFormValues ( $params ) {

    // Store all the parameters
    $this->__construct( $params );
  }


  /**
  * Returns a AdUnit object matching the given AdUnit ID
  *
  * @param int The AdUnit ID
  * @return AdUnit|false The AdUnit object, or false if the record was not found or there was a problem
  */

  public static function getById( $id ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT * FROM adUnit WHERE id = :id";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":id", $id, PDO::PARAM_INT );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ( $row ) return new AdUnit( $row );
  }

  /**
  * Returns all total Resource objects in the DB
  *
  * @return int общее количество рекламных блоков
  */
  public function totalRows () {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT count(*) FROM adUnit"; 
    $st = $conn->prepare( $sql );
    $st->execute();
    $total_rows = $st->fetchColumn();
    $conn = null;

    return $total_rows;
  }


  /**
  * Returns all (or a range of) AdUnit objects in the DB
  *
  * @param int Optional The number of rows to return (default=1000)
  * @param int Optional The number of rows to start limit for pagination (default=0)
  * @param int Optional Return just resource in the theme with this ID
  * @return Array / false Массив: results => array, список объектов статьи; total Rows => общее количество статей
  */

  public static function getList( $numRows=1000, $start=0, $resourceId=null ) {
    $list = array();

    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $adunitClause = $resourceId ? "WHERE resourceId = :resourceId" : "";
    $sql = "SELECT * FROM adUnit $adunitClause ORDER BY id DESC LIMIT $start, :numRows";
    
    $st = $conn->prepare( $sql );
    $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
    if ( $resourceId ) $st->bindValue( ":resourceId", $resourceId, PDO::PARAM_INT );
    $st->execute();

    while ( $row = $st->fetch() ) {
      $resource = new AdUnit( $row );
      $list[] = $resource;
    }
    
    $conn = null;
    return $list;
  }
  

  /**
  * Inserts the current AdUnit object into the database, and sets its ID property.
  */

  public function insert() {

    // Does the AdUnit object already have an ID?
    if ( !is_null( $this->id ) ) trigger_error ( "AdUnit::insert(): Attempt to insert a AdUnit object that already has its ID property set (to $this->id).", E_USER_ERROR );

    // Insert the AdUnit
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "INSERT INTO adUnit ( title, resourceId, description ) VALUES ( :title, :resourceId, :description )";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":title", $this->title, PDO::PARAM_STR );
    $st->bindValue( ":resourceId", $this->resourceId, PDO::PARAM_INT );
    $st->bindValue( ":description", $this->description, PDO::PARAM_STR );
    $st->execute();
    $this->id = $conn->lastInsertId();
    $conn = null;
  }


  /**
  * Updates the current AdUnit object in the database.
  */

  public function update() {

    // Does the AdUnit object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "AdUnit::update(): Attempt to update a AdUnit object that does not have its ID property set.", E_USER_ERROR );
   
    // Update the AdUnit
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "UPDATE adUnit SET title=:title, resourceId=:resourceId, description=:description WHERE id = :id";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":title", $this->title, PDO::PARAM_STR );
    $st->bindValue( ":resourceId", $this->resourceId, PDO::PARAM_INT );
    $st->bindValue( ":description", $this->description, PDO::PARAM_STR );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }


  /**
  * Deletes the current AdUnit object from the database.
  */

  public function delete() {

    // Does the AdUnit object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "AdUnit::delete(): Attempt to delete a AdUnit object that does not have its ID property set.", E_USER_ERROR );

    // Delete the AdUnit
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $st = $conn->prepare ( "DELETE FROM adUnit WHERE id = :id LIMIT 1" );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }

}

?>
