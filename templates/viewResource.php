<?php include "templates/include/header.php" ?>

<div class="container">
  <div class="table-responsive">          
  <table class="table table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>URL</th>
        <th>Theme</th>
        <th>Contact</th>
      </tr>
    </thead>
    <tbody>
      
      <tr>
        <td><?php echo $resource->id; ?></td>
        <td><?php echo $resource->url; ?></td>
        <td><?php echo $resource->themeName; ?></td>
        <td><?php echo $resource->contact; ?></td>
      </tr>

    </tbody>
  </table>
  </div>
</div>

<div class="container text-center">
  <h2>Рекламные блоки:</h2>
  <?php foreach ( $results['listAdUnits'] as $adunit ) { ?>
    <div class="col-sm-3"><a class="btn btn-default" href="?action=editAdUnit&amp;id=<?php echo $adunit->id ?>"><?php echo $adunit->title ?></a></div>
  <?php } ?>
</div>

<?php include "templates/include/footer.php" ?>

