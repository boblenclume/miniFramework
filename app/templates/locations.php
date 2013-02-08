<?php include 'header.php'?>


<h1>All locations</h1>
<?php if ($locations === null){
		echo "Il n'a actuellement aucune location";
	}
	else{?>
<table class="table">
	<thead>
		<tr>
			<th>#</th>
			<th>Name</th>
			<th>Created At</th>
		</tr>
	</thead>
	<tbody>
	<?php
	foreach ($locations as $loc) : ?>
		<tr>
			<td><?php echo $loc->getId(); ?></td>
			<td><a href="locations/<?php echo $loc->getId(); ?>"><?php echo $loc->getName(); ?></a></td>
			<td><a href="locations/<?php echo $loc->getId(); ?>"><?php echo $loc->getCreatedAt(); ?></a></td>
		</tr>
		<?php endforeach; }?>
	</tbody>
</table>

<form action="/locations" method="POST"><label for="name">Name:</label>
<div class="input-append">
	<input type="text" name="name" id="appendedInputButtons" class="input-large"> 
	<input type="submit"value="Add New" class="btn btn-primary"></div>
</form>
</body>
</html>
