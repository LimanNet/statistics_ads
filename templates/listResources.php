<?php include "templates/include/header.php" ?>

<div class="container">

<?php if ( isset( $_GET['error'] ) ) { ?>
        <div class="errorMessage"><?php echo $_GET['error'] ?></div>
<?php } ?>

   
<?php if ( isset( $_GET['status'] ) ) { ?>
  <div class="alert alert-success">
        <a href="?action=listResources" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <div class="statusMessage"><?php echo $_GET['status'] ?></div>
  </div>
<?php } ?>
    
</div>

<div class="conteiner">
  <div class="row">
    <div class="col-sm-5"></div>
    <div class="col-sm-2">
      <a class="btn btn-default" href="?action=editResource">Create new resource</a>
    </div>
    <div class="col-sm-5"></div>
  </div>
</div>

<div class="container">
  <div class="table-responsive">          
  <table class="table table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>URL</th>
        <th>Theme</th>
        <th>Contact</th>
        <th>Tools</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ( $results['resources'] as $resource ) { ?>
      <tr>
        <td><?php echo $resource->id; ?></td>
        <td><?php echo $resource->url; ?></td>
        <td><?php echo $resource->themeName; ?></td>
        <td><?php echo $resource->contact; ?></td>
        <td>
          <div class="btn-group btn-group-sm">
          <a class="btn btn-primary" href="?action=viewResource&amp;id=<?php echo $resource->id; ?>">View</a> 
          <a class="btn btn-primary" href="?action=editResource&amp;id=<?php echo $resource->id; ?>">Edit</a>
          </div>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
  </div>
</div>

<div class="container">
<p><?php echo $results['totalRows']?> resource<?php echo ( $results['totalRows'] != 1 ) ? 's' : '' ?> in total.</p>
</div>

<div class="container">
  <ul class="pagination">
    <?php $page=1; while($page <= $lastpage) { ?>
      <li <?php if( $page == $currentPage ) echo "class=\"active\"" ; ?>><a href="?action=listResources&amp;page=<?php echo $page ?>"><?php echo $page ?></a></li>
    <?php $page++; }?>
    <!--li class="active"><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li-->
  </ul>
</div>

<?php include "templates/include/footer.php" ?>

