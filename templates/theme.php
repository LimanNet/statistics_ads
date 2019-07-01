<?php include "templates/include/header.php" ?>
<script>
function editElement(id,name) {

  // отключим все кнопки
  var items = document.getElementsByClassName('btn');
  for (var i = 0; i < items.length; i++) {
      items[i].disabled=true;
  }

  document.getElementById(id).innerHTML = 
  "<tr><td>"+id+"</td>"
  +"<td><form id=\"f-theme\" method=\"post\" >"
  +"<input type=\"hidden\" name=\"form\" value=\"updateTheme\" >"
  +"<input type=\"hidden\" name=\"id\" value=\""+id+"\">"
  +"<input type=\"text\" name=\"name\" value="+name+">"
  +"</form></td>"
  +"<td><div class=\"btn-group btn-group-sm\"><input type=\"submit\" form=\"f-theme\" class=\"btn btn-primary\" value=\"Save\"><input type=\"reset\" form=\"f-theme\" onClick=\"history.go(0)\" class=\"btn btn-dark\"></div><td></tr>";

}
</script>

<div class="container">

<?php if ( isset( $_GET['status'] ) ) { ?>

        <div class="alert alert-success">
          <a href="?action=theme" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong><?php echo $_GET['status'] ?></strong>
        </div>
<?php } ?>
</div>

<div class="container">
  <form method="post">
    <input type="hidden" name="form" value="newTheme">
  <div class="row">
    <div class="col-sm-11">
    <div class="input-group">
      <span class="input-group-addon">New Theme</span>
      <input id="name" type="text" class="form-control" name="name" placeholder="Name">
    </div>
    </div>
    <div class="col-sm-1">
    <button type="submit" class="btn">Create</button>
    </div>
  </div>
  </form>
</div>

<div class="container">
  <div class="table-responsive">          
  <table class="table table-hover">
    <thead>
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Tools</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ( $results['results'] as $theme ) { ?>
      <tr id="<?php echo $theme->id; ?>">
        <td><?php echo $theme->id; ?></td>
        <td><?php echo $theme->name; ?></td>
        <td>
          <div class="btn-group btn-group-sm">
            <button class="btn btn-primary"  onclick="editElement('<?php echo $theme->id; ?>','<?php echo $theme->name; ?>');">Edit</button>
          </div>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
  </div>
</div>

<?php include "templates/include/footer.php" ?>

