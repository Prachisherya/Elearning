<?php include('header_dashboard.php'); ?>
<?php include('session.php'); ?>
<?php $get_id = $_GET['id']; ?>
<?php $cget_id = $_GET['cid']; ?>

<body>
    <?php include('navbar_student.php'); ?>
    <div class="container-fluid">
        <div class="row-fluid">
            <?php include('sidebar.php'); ?>
            <div class="span9" id="content">
                <div class="span9" id="content">
                    <div class="row-fluid">
                        <!-- block -->
                        <div id="" class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">View Course Content</div>
                            </div>
                            <div class="block-content collapse in">
                                <a href="ccontent.php?id=<?php echo $cget_id ?>"><i class="icon-arrow-left"></i> Back</a>
                                <?php
                                $query = mysqli_query($conn, "SELECT * FROM coursecontent WHERE cc_id = '$get_id'") or die(mysqli_error($conn));
                                $row = mysqli_fetch_array($query);
                                ?>

                                <div class="alert alert-success">
                                    <center><strong><i class="icon-user icon-large"></i>&nbsp;View  <?php echo $row['cctitle']; ?> |</strong></center>
                                </div>

                                <p style="font-size: 18px;font-weight: bold;">Module: <?php echo $row['cctitle'];?> | Title: <?php echo $row['cc_desc'];?></p>
                                <div class="container">
                                    <embed src="admin/<?php echo $row['ccfile']; ?>" style="width: 100%; height: 900px;" />
                                </div>

                                <!-- Comment Section -->
                                <div class="container">
                                    <h4>Comments</h4>
                                    <form method="POST" action="">
                                        <div class="form-group">
                                            <textarea name="comment" class="form-control" rows="3" placeholder="Write your comment here..."></textarea>
                                        </div>
                                        <button type="submit" name="submit_comment" class="btn btn-primary">Submit</button>
                                    </form>

                                    <?php
                                    if (isset($_POST['submit_comment'])) {
                                        $comment = mysqli_real_escape_string($conn, $_POST['comment']);
                                        $user_id = $_SESSION['id'];

                                        if (!empty($comment)) {
                                            mysqli_query($conn, "INSERT INTO comments (course_content_id, user_id, comment) VALUES ('$get_id', '$user_id', '$comment')") or die(mysqli_error($conn));
                                            echo "<div class='alert alert-success'>Comment submitted successfully!</div>";
                                        } else {
                                            echo "<div class='alert alert-danger'>Comment cannot be empty!</div>";
                                        }
                                    }
                                    ?>

                                    <div class="comments-list">
                                        <?php
                                        $comment_query = mysqli_query($conn, "SELECT comments.comment, comments.timestamp, student.firstname, student.lastname,comments.id FROM comments JOIN student ON comments.user_id = student.student_id WHERE course_content_id = '$get_id' ORDER BY comments.timestamp DESC") or die(mysqli_error($conn));
                                        while ($comment_row = mysqli_fetch_array($comment_query)) {
                                            ?>
                                            <div class="comment-item">
                                                <p><strong><?php echo $comment_row['firstname'] . " " . $comment_row['lastname']; ?></strong> (<?php echo $comment_row['timestamp']; ?>):</p>
                                                <p><?php echo $comment_row['comment']; ?></p>
                                                <!-- Display Replies -->
                                            <?php
                                            $reply_query = mysqli_query($conn, "SELECT reply, timestamp FROM replies WHERE comment_id = '" . $comment_row['id'] . "' ORDER BY timestamp ASC") or die(mysqli_error($conn));
                                            while ($reply_row = mysqli_fetch_array($reply_query)) {
                                                ?>
                                                <div class="reply-item">
                                                    <p><strong>Admin</strong> (<?php echo $reply_row['timestamp']; ?>):</p>
                                                    <p><?php echo $reply_row['reply']; ?></p>
                                                </div>
                                                <?php
                                            }
                                            ?>
  
                                            </div>
                                            <hr>
                                        <?php } ?>
                                    </div>
                                </div>
                                <!-- End Comment Section -->
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
