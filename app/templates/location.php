<?php include 'header.php'?>
    <body>
    <h1>Locations : <?php echo $location->getName()?></h1>
    <div class="input-append">
	    <form action="/locations/<?php echo $location->getId() ?>" method="POST">
	    <input type="hidden" name="_method" value="PUT">
	    <input type="text" name="name" id="appendedInputButtons" class="input-large" value="<?php echo $location->getName() ?>">
	    <input type="submit" value="Update" class="btn btn-primary">
	</form>
	<input disabled type="text" name="name" class="input-large"value="<?php echo $location->getCreatedAt() ?>">
	</div>
	<form action="/locations/<?php echo $location->getId() ?>" method="POST">
	    <input type="hidden" name="_method" value="DELETE">
	    <input type="submit" value="Delete" class="btn btn-danger">
	</form>
	<h2>Comments</h2>
	<div id="comments">
	<?php
	$comments = $location->getComments();
	if ($comments === null){
		echo "There is currently no comments associated with this location. <br/>";
	}
	else{
	foreach ($comments as $comment) : 
	?>
	<div id="comment">
	<div class="header">
	<?php
			echo $comment->getId(); 
			echo " : " . $comment->getUserName() . " - " . $comment->getCreatedAt() . "<br/>";
	?>
	</div>
	<?php 	
			echo $comment->getBody() . "<br/><br/>"; 
	?>
	</div>
	<?php 
	 endforeach;
	}
?>
</div>
	
        <footer><br/>
            <input type="button" onclick="location.href='/locations'" value="Back to list" class="btn"/>
        </footer>
    </body>
</html>
