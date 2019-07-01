<?php

/**
 * Class to handle online-resources
 */

class Resource
{
  // Properties

  /**
  * @var int The resource ID from the database
  */
  public $id = null;

  /**
  * @var string Full URL of the resource
  */
  public $url = null;

  /**
  * @var int The resource themes ID
  */
  public $themeId = null;

  /**
  * @var string Имена Тем хранятся в другой таблице
  */
  public $themeName = null;

  /**
  * @var string
  */
  public $contact = null;


  /**
  * Задаём свойства объекта, используя значения в предоставленном массиве
  *
  * @param assoc The property values
  */

  public function __construct( $data=array() ) {
    if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
    if ( isset( $data['themeId'] ) ) {
      $this->themeId = (int) $data['themeId'];
      $this->themeName = $this->getTemeName($this->themeId);
    }
    if ( isset( $data['url'] ) ) $this->url = $data['url'];
    if ( isset( $data['contact'] ) ) $this->contact = $data['contact'];
  }

  /**
  * Задает свойства объекта, используя значения post формы редактирования в предоставленном массиве
  *
  * @param assoc The form post values
  */

  public function storeFormValues ( $params ) {
    // Store all the parameters
    $this->__construct( $params );
  }


  private function getTemeName( $themeId ){
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT name FROM theme WHERE id = :id";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":id", $themeId, PDO::PARAM_INT );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    return $row['name'];
  }


  /**
  * Возвращает объект ресурса, соответствующий заданному ID ресурса
  *
  * @param int The resource ID
  * @return Resource / false Объект resource или false, если запись не найдена или возникла проблема
  */

  public static function getById( $id ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT * FROM resource WHERE id = :id";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":id", $id, PDO::PARAM_INT );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ( $row ) return new Resource( $row );
  }


  /**
  * Returns all total Resource objects in the DB
  *
  * @return int общее количество ресурсов
  */
  public function totalRows () {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT count(*) FROM resource"; 
    $st = $conn->prepare( $sql );
    $st->execute();
    $total_rows = $st->fetchColumn();
    $conn = null;

    return $total_rows;
  }

  /**
  * Returns all (or a range of) Resource objects in the DB
  *
  * @param int Optional The number of rows to return (default=1000)
  * @param int Optional The number of rows to start limit (default=0)
  * @param int Optional Return just resource in the theme with this ID
  * @return Array / false Массив: results => array, список объектов статьи; total Rows => общее количество статей
  */

  public static function getList( $numRows=1000, $start=0, $themeId=null ) {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $themeClause = $themeId ? "WHERE themeId = :themeId" : "";
    $sql = "SELECT * FROM resource $themeClause ORDER BY id DESC LIMIT $start, :numRows";
    
    $st = $conn->prepare( $sql );
    $st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
    if ( $themeId ) $st->bindValue( ":themeId", $themeId, PDO::PARAM_INT );
    $st->execute();
    $list = array();

    while ( $row = $st->fetch() ) {
      $resource = new Resource( $row );
      $list[] = $resource;
    }

    $conn = null;
    return array ( "results" => $list );
  }


  /**
  * Inserts the current Resource object into the database, and sets its ID property.
  */

  public function insert() {

    // Does the Resource object already have an ID?
    if ( !is_null( $this->id ) ) trigger_error ( "Resource::insert(): Attempt to insert an Resource object that already has its ID property set (to $this->id).", E_USER_ERROR );

    // Insert the Resource
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "INSERT INTO resource ( url, themeId, contact ) VALUES ( :url, :themeId, :contact )";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":url", $this->url, PDO::PARAM_STR );
    $st->bindValue( ":themeId", $this->themeId, PDO::PARAM_INT );
    $st->bindValue( ":contact", $this->contact, PDO::PARAM_STR );
    $st->execute();
    $this->id = $conn->lastInsertId();
    $conn = null;
  }


  /**
  * Updates the current Resource object in the database.
  */

  public function update() {

    // Does the Resource object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Resource::update(): Attempt to update an Resource object that does not have its ID property set.", E_USER_ERROR );
   
    // Update the Resource
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "UPDATE resource SET url=:url, themeId=:themeId, contact=:contact WHERE id = :id";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":url", $this->url, PDO::PARAM_STR );
    $st->bindValue( ":themeId", $this->themeId, PDO::PARAM_INT );
    $st->bindValue( ":contact", $this->contact, PDO::PARAM_STR );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }


  /**
  * Deletes the current Resource object from the database.
  */

  public function delete() {

    // Does the Resource object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Resource::delete(): Attempt to delete an Resource object that does not have its ID property set.", E_USER_ERROR );

    // Delete the Resource
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $st = $conn->prepare ( "DELETE FROM resource WHERE id = :id LIMIT 1" );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }

}

?>
