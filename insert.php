<!doctype html>
<?php 
include("config.php");?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Image</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <style>
  #draggable { width: 150px; height: 150px; padding: 0.5em; }
  </style>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
	  $( "#resizable" ).resizable();
    $( "#draggable" ).draggable({
		drag : function(event, ui){
			var t;
            $('h1').html(ui.position.left + ' ' + ui.position.top);
			 $('left').html(ui.position.left);
			
          }
	});
  } );
  </script>
</head>
<body>
	<form action="insert.php" method="post" enctype="multipart/form-data">
								<h5>Select image to upload:</h5>
  								<input type="file" name="file">
								
                            <button class="btn vizew-btn mt-30" name="submit" type="submit">Upload</button>
                        </form>
    					<?php 
							$sql = "SELECT png FROM try ORDER BY srno DESC lIMIT 1";
								$result = mysqli_query($con,$sql);
								
								if(mysqli_num_rows($result) > 0)
								{ 
  									// output data of each row
  									while($row = mysqli_fetch_array($result))
									{
									?>
	
   <div >
   	<img src="1.jpg" alt="" width="500" height="500">
      <div id="draggable"><img alt="" src="<?php $filename = $row['png']; echo($filename); 
									}	
								} ?>" id="resizable">"
							</div>
	   <h1></h1>
	   
    </div>

 
 
</body>
</html>
<?php 
include("config.php");
if(isset($_POST["submit"])) {
$name= $_FILES['file']['name'];

if (isset($name)) {
	


$tmp_name= $_FILES['file']['tmp_name'];

	
$position= strpos($name, ".");

$fileextension= substr($name, $position + 1);

$fileextension= strtolower($fileextension);

$path1= '';

	$uploadOk = 1;
if (empty($name))
{
echo "Please choose a file";
}
else if (!empty($name)){
if (($fileextension !== "png") && ($fileextension !== "jpeg"))
{
echo "The file extension must be .jpeg, .jpeg in order to be uploaded";
}

else if (($fileextension == "png") || ($fileextension == "jpeg"))
{
if (move_uploaded_file($tmp_name, $path1.$name)) {
	

		
		$image ="$name"; 
		
			
		//Upload Data
		$sql = "INSERT INTO try (png) VALUES ('$image')";

if ($con->query($sql) === TRUE) {
   
	header('Location:insert.php');
	
} else {
  echo "Error: " . $sql . "<br>" . $con->error;
}
}
}
}
}
}
?>