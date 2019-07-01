<?php

require( "config.php" );
$action = isset( $_GET['action'] ) ? $_GET['action'] : "";

switch ( $action ) {
  case 'theme':
    theme();
    break;
  case 'editResource':
    editResource();
    break;
  case 'listResources':
    listResources();
    break;
  case 'editResource':
    editResource();
    break;
  case 'viewResource':
    viewResource();
    break;
  case 'listAdUnit':
    listAdUnit();
    break;
  case 'editAdUnit':
    editAdUnit();
    break;
  default:
    homepage();
}

function theme(){

  // Обработка изменений

  if( isset($_POST['form']) ){
    // Создание новой темы
    if( $_POST['form'] == "newTheme") {

      $theme = new Theme();
        $theme->storeFormValues( $_POST );
        $theme->insert();
        header( "Location: ?action=theme&status=changesSaved" );
    // Изменение темы
    } elseif( $_POST['form'] == "updateTheme"){
       
        if ( !$theme = Theme::getById( (int)$_POST['id'] ) ) {
          header( "Location:index.php?error=themeNotFound" );
          return;
        }

        $theme = new Theme();
        $theme->storeFormValues( $_POST );
        $theme->update();
        header( "Location: ?action=theme&status=changesSaved" );

    }

    $_POST = null;

  }

  $results = array();
  $data = Theme::getList();
  $results['results'] = $data;
  $results['pageTitle'] = "Темы рекламных блоков | Test work";

  require( TEMPLATE_PATH . "/theme.php" );
}

function listResources() {
  $results = array();

  // Pagination
  $currentPage = 1;
  $startRow = 0;
  $totalResource = Resource::totalRows();
  $lastpage = ceil($totalResource/WIEV_NUM);
  
  if( $_GET['page'] && 0<$_GET['page'] && $_GET['page']<=$lastpage) {
    $currentPage = (int)$_GET['page'];
    $startRow = ($currentPage - 1) * WIEV_NUM;
  }

  // Query DB
  $data = Resource::getList( WIEV_NUM, $startRow );
  
  $results['resources'] = $data['results'];
  $results['totalRows'] = $totalResource;
  $results['pageTitle'] = "Интернет-ресурсы | Test work";
  require( TEMPLATE_PATH . "/listResources.php" );
}

function editResource() {
  
  $results = array();
  $results['pageTitle'] = "Edit Resource";
  $results['formAction'] = "newResource";
  $theme = Theme::getList();

  if ( $_POST['form'] == "newResource" ) {
    $resource = new Resource();
      $resource->storeFormValues( $_POST );
      $resource->insert();
    header( "Location:?action=listResources&status=New resource created." );
  }

  if( isset( $_GET['id'] ) ) {

    if ( !$resource = Resource::getById( (int)$_GET['id'] ) ) {
        header( "Location:index.php?error=Resource Not Found!" );
        return;
    }
    $resource->storeFormValues( $_POST );
    $results['formAction'] = "updateResource";
    $themeName = Theme::getById( $resource->themeId );
    
    if ( $_POST['form'] == "Delete" ) {
        $resource->delete();
        header( "Location:?action=listResources&status=Resource deleted." );
    }
    if ( $_POST['form'] == "updateResource" ) {
        $resource->storeFormValues( $_POST );
        $resource->update();
        header( "Location: ?action=editResource&id=".$resource->id."&status=Changes Saved" );
    }

  }

    $_POST = null;
    require( TEMPLATE_PATH . "/editResource.php" );

}

function viewResource(){
  $results = array();
  $results['pageTitle'] = "View Resource";

  if ( !$resource = Resource::getById( (int)$_GET['id'] ) ) {
          header( "Location:index.php?error=Resource Not Found" );
          return;
  }
  $results['listAdUnits'] = AdUnit::getList( WIEV_NUM, 0, $resource->id );

  require( TEMPLATE_PATH . "/viewResource.php" );
}

function listAdUnit() {
  $results = array();
  $results['pageTitle'] = "Рекламные блоки | Test work";

  // Pagination
  $currentPage = 1;
  $startRow = 0;
  $totalAdUnit = AdUnit::totalRows();
  $lastpage = ceil($totalAdUnit/WIEV_NUM);
  
  if( $_GET['page'] && 0<$_GET['page'] && $_GET['page']<=$lastpage) {
    $currentPage = (int)$_GET['page'];
    $startRow = ($currentPage - 1) * WIEV_NUM;
  }

  // Query DB
  $data = AdUnit::getList( WIEV_NUM, $startRow );
  
  $results['data'] = $data;
  $results['totalRows'] = $totalAdUnit;

  require( TEMPLATE_PATH . "/listAdUnit.php" );
}

function editAdUnit() {
  
  $results = array();
  $results['pageTitle'] = "Edit Ad Unit";
  $results['formAction'] = "editAdUnit";
  $results['action'] = "newAdUnit";
  $theme = Theme::getList();

  if ( $_POST['form'] == "newAdUnit" ) {
    $adunit = new AdUnit();
      $adunit->storeFormValues( $_POST );
      $adunit->insert();
    header( "Location:?action=listAdUnit&status=New resource created." );
  }
  
  if( isset( $_GET['id'] ) ) {

    if ( !$adunit = AdUnit::getById( (int)$_GET['id'] ) ) {
        header( "Location:index.php?error=Resource Not Found!" );
        return;
    }

    $adunit->storeFormValues( $_POST );
    $results['action'] = "updateAdUnit";
    //$resourceName = Resource::getById( $adunit->resourceId );
    
    if ( $_POST['form'] == "Delete" ) {
        $adunit->delete();
        header( "Location:?action=listAdUnit&status=Ad unit deleted." );
    }
    if ( $_POST['form'] == "updateAdUnit" ) {
        $adunit->storeFormValues( $_POST );
        $adunit->update();
        header( "Location: ?action=".$results['formAction']."&id=".$adunit->id."&status=Changes Saved" );
    }

  }

    $results['data'] = $adunit;
    $_POST = null;
    require( TEMPLATE_PATH . "/editAdUnit.php" );

}

function viewAdUnit(){
  $results = array();
  $results['pageTitle'] = "View Ad Unit";

  if ( !$resource = Resource::getById( (int)$_GET['id'] ) ) {
          header( "Location:index.php?error=Ad Unit Not Found" );
          return;
  }
  require( TEMPLATE_PATH . "/viewAdUnit.php" );
}

function homepage() {
  $results = array();
  $results['pageTitle'] = "Test work | Home page";

  if ( isset( $_GET['error'] ) ) {
    if ( $_GET['error'] == "resourceNotFound" ) $results['errorMessage'] = "Error: resource not found.";
  }

  $Stat =  new Statistics();
  $stat = $Stat->getList();


  require( TEMPLATE_PATH . "/homepage.php" );
}

?>
