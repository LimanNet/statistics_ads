<?php include "templates/include/header.php" ?>

<div class="container">
	<div id="demo"></div>

<?php if ( isset( $_GET['error'] ) ) { ?>
        <div class="errorMessage"><?php echo $_GET['error'] ?></div>
<?php } ?>


<?php if ( isset( $_GET['status'] ) ) { ?>
        <div class="statusMessage"><?php echo $_GET['status'] ?></div>
<?php } ?>

</div>

<div class="container">
<!--	<form method="post">
		<input type="hidden" name="form" value="statistics">
-->		<input type="date" name="dateStart" id="dateStart" value="<?php //echo date( "Y-m-d" )?>">
		<input type="date" name="dateEnd" id="dateEnd" value="<?php echo date( "Y-m-d" )?>">
		<button type="button" onclick="showFilterTable()" class="btn btn-default">Submit</button>
<!--	</form> -->
</div>

<div class="container">
	
</div>

<div class="container">

	<table class="table table-striped">
		<thead>
		<tr>
			<th><button onclick="sortDate()" class="btn">Дата показа</button></th>
			<th><button onclick="sortAd()" class="btn">ID рекламного блока</button></th>
			<th><button onclick="sortRes()" class="btn">ID интернет-ресурса</button></th>
			<th><button onclick="sortISO()" class="btn">ISO коду страны</button></th>
			<th></th>
			<th>количество показов</th>
			<th>количество кликов</th>
		</tr>
		</thead>
		<tbody id="table">
	<?php foreach($stat as $row) { ?>
		<!--tr>
			<td><?php echo $row['dateView'] ?></td>
			<td><?php echo $row['adUnitId'] ?></td>
			<td><?php echo $row['resourceId'] ?></td>
			<td><?php echo $row['countryUser'] ?></td>
			<td></td>
			<td><?php echo $row['countView'] ?></td>
			<td><?php echo $row['counterClick'] ?></td>
		</tr-->
	<?php } ?>
		</tbody>
	</table>
</div>
<script type='text/javascript'>
	var array = <?php echo json_encode($stat);?>;
	var sortArray = sortDate();

	function sortDate(){
		sortArray = array.sort(function(a, b) {
			a = (new Date(a.dateView)).getTime();
		    b = (new Date(b.dateView)).getTime();
		    return a - b;
		});
		showTable();
	}

	function sortAd(){
		sortArray = array.sort((a, b) => a.adUnitId - b.adUnitId);
		showTable();
	}

	function sortRes(){
		sortArray = array.sort((a, b) => a.resourceId - b.resourceId);
		showTable();
	}

	function sortISO(){
	  	sortArray.sort((a, b) => {
		    if ( a.countryUser < b.countryUser ) return -1;
		    if ( a.countryUser < b.countryUser ) return 1;
		});
		showTable();
  	}
  //console.log(array);
  function showTable(){
  	  document.getElementById("table").innerHTML = "";
	  for (i = 0; i < sortArray.length; i++) { 
	  	document.getElementById("table").innerHTML += 
	  	"<tr>"+
	  	"<td>"+array[i].dateView + "</td>"+
	  	"<td>"+array[i].adUnitId + "</td>"+
	  	"<td>"+array[i].resourceId + "</td>"+
	  	"<td>"+array[i].countryUser + "</td>"+
	  	"<td></td>"+
	  	"<td>"+array[i].countView + "</td>"+
	  	"<td>"+array[i].counterClick + "</td>"+
	  	"</tr>";
	  }
  }

  // Filter array

	function showFilterTable(){
		var filteredValue = array.filter(function (item) {
			var	dateStart = document.getElementById("dateStart").value;
			var	dateEnd = document.getElementById("dateEnd").value;

      		return  new Date(dateStart) <= new Date(item.dateView) && new Date(item.dateView) <= new Date(dateEnd) ;
		});
		
  	  document.getElementById("table").innerHTML = "";
  	  
	  for (i = 0; i < filteredValue.length; i++) { 
	  	document.getElementById("table").innerHTML += 
	  	"<tr>"+
	  	"<td>"+filteredValue[i].dateView + "</td>"+
	  	"<td>"+filteredValue[i].adUnitId + "</td>"+
	  	"<td>"+filteredValue[i].resourceId + "</td>"+
	  	"<td>"+filteredValue[i].countryUser + "</td>"+
	  	"<td></td>"+
	  	"<td>"+filteredValue[i].countView + "</td>"+
	  	"<td>"+filteredValue[i].counterClick + "</td>"+
	  	"</tr>";
	  }
  }

</script>

<?php include "templates/include/footer.php" ?>

