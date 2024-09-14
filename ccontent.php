<?php include('header_dashboard.php'); ?>
<?php include('session.php');
	$get_id = $_GET['id'];
 ?>

    <body>
		<?php include('navbar_student.php'); ?>
        <div class="container-fluid">
            <div class="row-fluid">
				<?php include('sidebar.php'); ?>
                <div class="span9" id="content">
                 
                <div class="span9" id="content">
                     <div class="row-fluid">
					   <!-- block -->
                        <div id="block_bg" class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">Modules</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
									<form action="delete_ccontent.php" method="post">
  									<table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
									
										<thead>
										  <tr>
												<th>S/N</th>
												<th>Content Title</th>
												<th>Action </th>
										   </tr>
										</thead>
										<tbody>
											
												<?php
												$x=1;
											$subject_query = mysqli_query($conn,"SELECT * from coursecontent WHERE course = '$get_id' ")or die(mysqli_error());
											while($row = mysqli_fetch_array($subject_query)){
											$id = $row['cc_id'];
											?>
										
											<tr>
													
													<td><?php echo $x; ?></td>
													<td><?php echo $row['cctitle']; ?></td>
												
													<td width="30"><a href="content_view.php<?php echo '?id='.$id. '&cid='.$get_id ?>" class="btn btn-success"><i class="icon-folder-open-alt"></i> </a></td>
										</tr>
											
											<?php
											$x++;
										} ?>   
                              
										</tbody>
									</table>
									</form>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>


                </div>
            </div>
		<?php include('footer.php'); ?>
        </div>
		<?php include('script.php'); ?>
    </body>

</html>     