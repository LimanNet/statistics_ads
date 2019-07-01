<?php include "templates/include/header.php" ?>

<div class="container">

<?php if ( isset( $_GET['error'] ) ) { ?>
        <div class="errorMessage"><?php echo $_GET['error'] ?></div>
<?php } ?>

   
<?php if ( isset( $_GET['status'] ) ) { ?>
  <div class="alert alert-success">
        <a href="?action=<?php echo $results['formAction'] ?><?php if(isset($results['data']->id)){echo "&amp;id=".$results['data']->id;} ?>" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <div class="statusMessage"><?php echo $_GET['status'] ?></div>
  </div>
<?php } ?>
    
</div>

<div class="container">

 <h1><?php echo $results['pageTitle']?></h1>

<form class="form" action="?action=<?php echo $results['formAction'] ?><?php if(isset($results['data']->id)){echo "&amp;id=".$results['data']->id;} ?>" method="post">
   <input type="hidden" name="form" value="<?php echo $results['action']?>"/>
   <?php if(isset($results['data']->id)){echo "<input type=\"hidden\" name=\"id\" value=\"".$results['data']->id."\"/>";} ?>
  <div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" name="title" value="<?php echo $results['data']->title ?>" required>
  </div>
  <div class="form-group">
    <label for="resourceId">Resourse:</label>
    <input type="number" class="form-control" name="resourceId" value="<?php echo $results['data']->resourceId ?>" required>
  </div>
  <div class="form-group">
    <label for="description">Description:</label>
    <input type="description" class="form-control" name="description" value="<?php echo $results['data']->description ?>" required>
  </div>
  <div class="row">
    <div class="col-sm-6">
    <div class="btn-group">
      <input class="btn btn-success" type="submit" name="saveChanges" value="Save Changes" />
      <a class="btn btn-default" href="?action=listAdUnit">Cancel</a>
    </div>
    </div>
    <div class="col-sm-3">
      <a class="btn btn-primary" href="http:?action=<?php echo $results['formAction'] ?>">Create new</a>
    </div>
    <div class="col-sm-3">
      <input class="btn btn-danger" type="submit" name="form" value="Delete" />
    </div>
  </div>
</form>

</div>
<?php include "templates/include/footer.php" ?>

