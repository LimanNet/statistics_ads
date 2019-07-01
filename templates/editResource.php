<?php include "templates/include/header.php" ?>

<div class="container">

<?php if ( isset( $_GET['error'] ) ) { ?>
        <div class="errorMessage"><?php echo $_GET['error'] ?></div>
<?php } ?>

   
<?php if ( isset( $_GET['status'] ) ) { ?>
  <div class="alert alert-success">
        <a href="?action=editResource<?php if(isset($resource->id)){echo "&amp;id=".$resource->id;} ?>" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <div class="statusMessage"><?php echo $_GET['status'] ?></div>
  </div>
<?php } ?>
    
</div>

<div class="container">

 <h1><?php echo $results['pageTitle']?></h1>

<form class="form" action="?action=editResource<?php if(isset($resource->id)){echo "&amp;id=".$resource->id;} ?>" method="post">
   <input type="hidden" name="form" value="<?php echo $results['formAction']?>"/>
   <?php if(isset($resource->id)){echo "<input type=\"hidden\" name=\"id\" value=\"".$resource->id."\"/>";} ?>
  <div class="form-group">
    <label class="sr-only" for="url">URL:</label>
    <input type="text" class="form-control" name="url" value="<?php echo htmlspecialchars( $resource->url )?>" required>
  </div>
  <div class="form-group">
    <label class="sr-only" for="themeId">Theme name:</label>
    <select name="themeId">
              <option <?php echo !$resource->themeId ? " selected" : ""?>>(none)</option>
            <?php foreach ( $theme as $val ) { ?>
              <option value="<?php echo $val->id?>"<?php echo ( $val->id == $resource->themeId ) ? " selected" : ""?>><?php echo htmlspecialchars( $val->name )?></option>
            <?php } ?>
    </select>
  </div>
  <div class="form-group">
    <label class="sr-only" for="contact">Contact:</label>
    <input type="contact" class="form-control" name="contact" value="<?php echo htmlspecialchars( $resource->contact )?>" required>
  </div>
  <div class="row">
    <div class="col-sm-6">
    <div class="btn-group">
      <input class="btn btn-success" type="submit" name="saveChanges" value="Save Changes" />
      <a class="btn btn-default" href="?action=listResources">Cancel</a>
    </div>
    </div>
    <div class="col-sm-3">
      <a class="btn btn-primary" href="http:?action=editResource">Create new</a>
    </div>
    <div class="col-sm-3">
      <input class="btn btn-danger" type="submit" name="form" value="Delete" />
    </div>
  </div>
</form>

       

        


<?php if ( $results['resource']->id ) { ?>
      <p><a href="admin.php?action=deleteArticle&amp;articleId=<?php echo $results['resource']->id ?>" onclick="return confirm('Delete This Resource?')">Delete This Resource</a></p>
<?php } ?>

</div>
<?php include "templates/include/footer.php" ?>

