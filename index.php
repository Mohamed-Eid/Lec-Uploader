<?php 
	
	include 'config.php';
	include 'header.php';

?>
<div >

<?php 
    $posts    = mysqli_query($db_connect, "SELECT * FROM posts");
        
    if (mysqli_num_rows($posts)>0)
    {
        while ($post = mysqli_fetch_array($posts)) 
    {
?>
	 <!-- Start Cards --> 
<?php	  
	 echo"<div class='col s12 m7'>
		<div class='card horizontal'>
		  <div class='card-stacked' align='center'>
			<div class='card-content'>
			  <h1>$post[title]</h1>
			  <h4>Subject : $post[subject]</h4>
			  <p class = 'text-muted'>
                 Date : $post[created_at]
               </p>
			  <p>$post[comment]</p>
			</div>		
			<div class='card-action'>"
?>			
			  <a href='image/<?php echo $post["file"] ?>'>Download</a> 
<?php	echo "</div>
		  </div>
		</div>
	  </div>"
?>	  	 
	 <!-- ENd Cards -->
    <?php
            }
        }else
            {
                echo '<p class="alert alert-info"> no data</p>';
            }

            

        
    ?>	 	 	 
</div>

	 <!-- Start Pagination -->
		<ul class="pagination" align="center">
			<li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
			<li class="active"><a href="#!">1</a></li>
			<li class="waves-effect"><a href="#!">2</a></li>
			<li class="waves-effect"><a href="#!">3</a></li>
			<li class="waves-effect"><a href="#!">4</a></li>
			<li class="waves-effect"><a href="#!">5</a></li>
			<li class="disabled"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
		</ul>
	 <!-- End Pagination -->



<?php include 'footer.php'; ?>