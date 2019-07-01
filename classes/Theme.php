<?php

/**
 * Class to handle Theme
 */

class Theme
{
  // Properties

  /**
  * @var int The Theme ID from the database
  */
  public $id = null;

  /**
  * @var string Full name of the Theme
  */
  public $name = null;


  /**
  * Задаём свойства объекта, используя значения в предоставленном массиве
  *
  * @param assoc The property values
  */

  public function __construct( $data=array() ) {
    if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
    if ( isset( $data['name'] ) ) $this->name = $data['name'];
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

  public static function getById( $themeId ){
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT * FROM theme WHERE id = :id";
    $st = $conn->prepare( $sql );
    $st->bindValue( ":id", $themeId, PDO::PARAM_INT );
    $st->execute();
    $row = $st->fetch();
    $conn = null;
    if ( $row ) return new Theme( $row );
  }

  public static function getList() {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT * FROM theme";
    $st = $conn->prepare( $sql );
    $st->execute();

    $list = array();
    while ( $row = $st->fetch() ) {
      $Theme = new Theme( $row );
      $list[] = $Theme;
    }

    $conn = null;

    return $list;
  }

  public function insert() {

    // Does the Theme object already have an ID?
    if ( !is_null( $this->id ) ) trigger_error ( "Theme::insert(): Attempt to insert an Theme object that already has its ID property set (to $this->id).", E_USER_ERROR );

    // Insert the Theme
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "INSERT INTO theme ( name ) VALUES ( :name )";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":name", $this->name, PDO::PARAM_STR );
    $st->execute();
    $this->id = $conn->lastInsertId();
    $conn = null;
  }

  public function update() {

    // Does the Theme object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Theme::update(): Attempt to update an Theme object that does not have its ID property set.", E_USER_ERROR );
   
    // Update the Theme
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "UPDATE theme SET name=:name WHERE id = :id";
    $st = $conn->prepare ( $sql );
    $st->bindValue( ":name", $this->name, PDO::PARAM_STR );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }

  public function delete() {

    // Does the Theme object have an ID?
    if ( is_null( $this->id ) ) trigger_error ( "Theme::delete(): Attempt to delete an Theme object that does not have its ID property set.", E_USER_ERROR );

    // Delete the Theme
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $st = $conn->prepare ( "DELETE FROM theme WHERE id = :id LIMIT 1" );
    $st->bindValue( ":id", $this->id, PDO::PARAM_INT );
    $st->execute();
    $conn = null;
  }

}

?>
