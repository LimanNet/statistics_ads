<?php

/**
 * Class to handle Statistics
 */

class ClickStatistics
{
  // Properties

    public $id = null;
    public $resourceId = null;
    public $adUnitId = null;
    public $dateView = null;
    public $impression = null;
    public $ipUser = null;
    public $countryUser = null;


  /**
  * Задаём свойства объекта, используя значения в предоставленном массиве
  *
  * @param assoc The property values
  */

  public function __construct( $data=array() ) {
    if ( isset( $data['id'] ) ) $this->iId = (int) $data['id'];
    if ( isset( $data['resourceId'] ) ) $this->resourceId = (int) $data['resourceId'];
    if ( isset( $data['adUnitId'] ) ) $this->adUnitId = (int) $data['adUnitId'];
    if ( isset( $data['dateView'] ) ) $this->dateView = $data['dateView'];
    if ( isset( $data['ipUser'] ) ) $this->ipUser = (int) $data['ipUser'];
    if ( isset( $data['countryUser'] ) ) $this->countryUser = $data['countryUser'];
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

  public function getList() {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT * FROM ClickStatistics";
    $st = $conn->prepare( $sql );
    $st->execute();

    $list = array();
    while ( $row = $st->fetch() ) {
      $stat = new ClickStatistics( $row );
      $list[] = $stat;
    }

    $conn = null;

    return $list;
  }

}

?>
