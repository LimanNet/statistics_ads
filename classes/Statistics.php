<?php

/**
 * Class to handle Statistics
 */

class Statistics
{
  // Properties

    private $id = null;
    private $resourceId = null;
    private $adUnitId = null;
    private $dateView = null;
    private $impression = null;
    private $ipUser = null;
    private $countryUser = null;
    private $counterClick = null;

  public function __construct( $data=array() ) {

  }

  public function getList() {
    $conn = new PDO( DB_DSN, DB_USERNAME, DB_PASSWORD );
    $sql = "SELECT impressionstatistics.dateView, impressionstatistics.adUnitId, impressionstatistics.resourceId, impressionstatistics.id, impressionstatistics.countryUser, impressionstatistics.countView, COUNT(clickstatistics.id) AS counterClick FROM impressionstatistics
LEFT JOIN clickstatistics ON impressionstatistics.resourceId = clickstatistics.resourceId AND impressionstatistics.adUnitId=clickstatistics.adUnitId AND  DAY(impressionstatistics.dateView) = DAY(clickstatistics.timeClick)
GROUP BY id;";
    $st = $conn->prepare( $sql );
    $st->execute();

    $row = $st->fetchAll();

    $conn = null;

    return $row;
  }

}

?>
