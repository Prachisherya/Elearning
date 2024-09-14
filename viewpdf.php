<?php include 'includes/headers.php';
        include 'includes/connect.php';


$id = $_GET['id'];
  $sql = mysqli_query($conn,"SELECT * FROM paper WHERE pep_id = '$id'");
  $res = mysqli_fetch_assoc($sql);
        
 ?>


<div id="container">
    <div class="col-sm-1"></div>
    <div class="col-sm-10">
<div class="hero-unit-table">   
                                <div class="alert alert-success">
                                    <center><strong><i class="icon-user icon-large"></i>&nbsp;View  <?php echo $res['pep_name'];?> | Title : <?php echo $res['dir'];?> Journal</strong></center>
                                </div>
 
<p style="font-size: 18px;font-weight: bold;">Journal : <?php echo $res['pep_name'];?> | Title : <?php echo $res['pep_title'];?></p>
<div class="container">
	<embed src="<?php echo $res['dir']; ?>" type="application/pdf" style="width: 100%; height: 900px;" />
</div> 

</div>
</div>
</div>
