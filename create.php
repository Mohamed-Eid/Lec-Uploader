<?php 

	function mksafe($data)
	{
		$data = trim($data);
		$data = strip_tags($data);
		$data = htmlspecialchars($data);
		$data = addslashes($data);
		return $data;
	}

  	include 'config.php';
  	include 'header.php';

?>
	 <!-- Start Upload Form -->
  
  <div class="row">

<?php 
	if (isset($_REQUEST['submit']))
	{
		if (empty($_REQUEST['title']) OR empty($_REQUEST['subject']))
		{
			echo '<p class="alert alert-warning">U cannot leave any of filds empty </p>';
		}
		else
		{
			$title    = mksafe($_REQUEST['title']);
			$subject  = mksafe($_REQUEST['subject']);
			$comment  = mksafe($_REQUEST['comment']);
			$date     = date('y-m-d');
			$file     = $_FILES["file"]["name"];
			$tmp_name = $_FILES["file"]["tmp_name"];
			$path     = "image/".$file;
			$file1    = explode(".",$file);
			$ext      = $file1[1];
			$allowed  = array("jpg","png","gif","pdf","mp3","mp4","wmv");

			if(in_array($ext,$allowed))
			{
				move_uploaded_file($tmp_name,$path);
				mysqli_query($db_connect, "INSERT INTO posts(title, subject,comment,file, created_at) VALUES('$title','$subject','$comment','$file','$date')");
				echo 
					'<p class="alert alert-success">
						Done
					</p>';
			}
				

		}
	}
?>  
    <form class="col s12" action="create.php" enctype="multipart/form-data" method="post">
        <div class="row">
			<div class="input-field col s12">
				<input id="lec" type="text" name="title">
				<label for="lec">Lecture Number</label>
			</div>
        </div>
        <div class="row">
			<div class="input-field col s12">
				<input id="subject" type="text" name="subject">
				<label for="subject">Subject Name</label>
			</div>
		</div>
		
		<div class="row">
			<div class="input-field col s12">
				<textarea id="textarea1" class="materialize-textarea" name="comment"></textarea>
				<label for="textarea1">Your Comment</label>
			</div>
        </div>
        
		<div class="file-field input-field">
			<div class="btn">
				<span>File</span>
				<input type="file" name="file">
			</div>
			<div class="file-path-wrapper">
				<input class="file-path validate" type="text">
			</div>
		</div>		
		<div class="row">
			<div class="col s12">
				Upload The Pdf Now:
				<div class="input-field inline">
					<button class="btn waves-effect waves-light" type="submit" name="submit">Upload
						<i class="material-icons right">send</i>
					</button>
				</div>
			</div>
		</div>    
  </div>	 
	 <!-- End Upload Form -->
<?php include 'footer.php'; ?>