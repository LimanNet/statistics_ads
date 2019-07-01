<?php include "templates/include/header.php" ?>

<div class="conteiner">
  <div class="row">
    <div class="col-sm-5"></div>
    <div class="col-sm-2">
      <a class="btn" href="">Create new resource</a>
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
          <a class="btn btn-danger" href="?action=deleteResource&amp;id=<?php echo $resource->id; ?>">Del</a>
          </div>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
  </div>
</div>

</div>
<?php include "templates/include/footer.php" ?>

