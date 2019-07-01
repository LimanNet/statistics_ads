<?php include "templates/include/header.php" ?>

<script>
function codeFor(id) {

  document.getElementById("code-"+id).innerText = 
  "document.getElementById(\"code-\""+id+").innerText =\"uni code\";";

}
</script>

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
      <a class="btn btn-default" href="?action=editResource">Создать рекламный блок</a>
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
        <th>Title</th>
        <th>Resource</th>
        <th>Description</th>
        <th>Tools</th>
        <th>Code</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ( $results['data'] as $adunit ) { ?>
      <tr>
        <td><?php echo $adunit->id; ?></td>
        <td><?php echo $adunit->title; ?></td>
        <td><?php echo $adunit->resourceId; ?></td>
        <td><?php echo $adunit->description; ?></td>
        <td>
          <div class="btn-group btn-group-sm"> 
          <a class="btn btn-primary" href="?action=editAdUnit&amp;id=<?php echo $adunit->id; ?>">Edit</a>
          <a class="btn btn-primary" href="#<?php echo $adunit->id; ?>" onclick="codeFor(<?php echo $adunit->id; ?>)">View Code</a>
          </div>
        </td>
        <td><code id="code-<?php echo $adunit->id; ?>"></code>
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
      <li <?php if( $page == $currentPage ) echo "class=\"active\"" ; ?>><a href="?action=listAdUnit&amp;page=<?php echo $page ?>"><?php echo $page ?></a></li>
    <?php $page++; }?>
  </ul>
</div>

<?php include "templates/include/footer.php" ?>