<?php include('header_dashboard.php'); ?>
<?php include('session.php'); 

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
                                <div class="muted pull-left">Meetings</div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span12">
									<form action="delete_ccontent.php" method="post">
  									<table cellpadding="0" cellspacing="0" border="0" class="table" id="example">
									
										<thead>
										  <tr>
											    <th></th>
												<th>S/N</th>
												<th>Description</th>
												<th>Date</th>
												<th>Time</th>
												<th>Status </th>
												<th>Action </th>
										   </tr>
										<tbody>
													<?php
												$x=1;
											$subject_query = mysqli_query($conn,"select * from meeting ")or die(mysqli_error());
											while($row = mysqli_fetch_array($subject_query)){
											$id = $row['meeting_id'];
											$link = $row['meeting_link'];
											$date = $row['meeting_date'];
											$time = $row['meeting_time'];
											$desc = $row['meeting_desc'];
											$meeting_id = $row['meetingid'];
											$passcode = $row['passcode'];
											$status = $row['meetingstatus'];
										
											?>
										
											<tr>
													<td width="30">
													</td>
													<td><?php echo $x; ?></td>
													<td><?php echo $desc; ?></td>
													<td><?php echo $date; ?></td>
													<td><?php echo $time; ?></td>
													<td><?php echo $status; ?></td>
													<td width="30">
												<?php 
													if($status == 'Pending'){ ?>

													

												<?php }else if ($status == 'Started') { ?>
																							
													<a href="<?php echo $link; ?>" target="_blank" class="btn btn-success"><i class="icon-play">Join</i> </a>
													
												<?php }else{ ?>
													

												<?php	}
												?>
												</td>
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