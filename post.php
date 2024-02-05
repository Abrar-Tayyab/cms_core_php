<?php require_once('inc/top.php'); ?>
  </head>
  <body>

    <style type="text/css">
      .center {
  display: block;
  margin-left: auto;
  margin-right: auto;
}
    </style>

<?php require_once('inc/header.php'); ?>

<?php

if (isset($_GET['post_id'])) {
      $post_id = $_GET['post_id'];

      $views_query = "UPDATE `posts` SET `views` = views + 1 WHERE `posts`.`id` = $post_id;";
      mysqli_query($con,$views_query);

      $query = "SELECT *, (SELECT COUNT(`id`) FROM `comments` WHERE comments.post_id = posts.id) AS `total_comment` FROM posts WHERE status = 'publish' and id = $post_id";
      $run = mysqli_query($con, $query);
      if (mysqli_num_rows($run) > 0) {
          $row = mysqli_fetch_array($run);
          $id = $row['id'];
          $date = getdate($row['date']);
          $day = $date['mday'];
          $month = $date['month'];
          $year = $date['year'];
          $title = $row['title'];
          $tags = $row['tags'];
          $views = $row['views'];
          $image = $row['image'];
          $author_image = $row['author_image'];
          $author = $row['author'];
          $categories = $row['categories'];
          $post_data = $row['post_data'];
          $comments = $row['total_comment'];
      }
      else{
        header('Location: index.php');
      }
}
?>

   <div class="jumbotron">
     <div class="container">
       <div id="details" class="animated fadeInLeft">
         <h1>Custom<span> Post</span></h1>
         <p>Here you can put your own tag line to make it more attractive.</p>
       </div>
     </div>
     <img src="img/top-image.jpg" alt="top image">
   </div>

  <section>
    <div class="container">
      <div class="row">
        <div class="col-md-8">

            <div class="post">
              <div class="row">
                <div class="col-md-2 post-date">
                  <div class="day"><?php echo $day; ?></div>
                  <div class="month"><?php echo $month; ?></div>
                  <div class="year"><?php echo $year; ?></div>
                </div>
                <div class="col-md-8 post-title">
                  <a href="post.php?post_id=<?php echo $id;?>"><h2><?php echo $title; ?></h2></a>
                  <p>Written by: <span><?php echo ucfirst($author); ?></span></p>
                </div>
                <div class="col-md-2 profile-picture">
                  <img src="img/<?php echo $author_image;?>" >
                </div>
              </div>
              <div style="padding: 10px 10px">
              <a href="img/<?php echo $image; ?>"><img src="img/<?php echo $image; ?>" class="img-responsive center" style="box-shadow:0 10px 16px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);"></a>
              </div>
              <div class="desc">
                <?php echo $post_data; ?>
              </div>

              <div class="bottom">
                <span class="first">
                  <i class="fa fa-folder"></i><a href="#"> <?php echo ucfirst($categories); ?> </a>
                </span> |
                <span class="second">
                  <i class="fa fa-comment"></i><a href="post.php?post_id=<?php echo $id; ?>"> Comment ( <?php echo $comments; ?> ) </a>
                </span> |
                <span class="three">
                  <i class="fa fa-eye"></i><a href="#"> Views ( <?php echo $views; ?> )</a>
                </span>
              </div> 
            </div>

            <div class="related-posts">
              <h3>Related Posts</h3><hr>
              <div class="row">
                <?php
                $r_query = "SELECT * FROM posts WHERE status = 'publish' AND categories LIKE '%$categories%' LIMIT 3";
                $r_run = mysqli_query($con,$r_query);
                while ($r_row = mysqli_fetch_array($r_run)) {
                  $r_id = $r_row['id'];
                  $r_title = $r_row['title'];
                  $r_image = $r_row['image'];
                ?>
                <div class="col-sm-4">
                  <a href="post.php?post_id=<?php echo $r_id;?>">
                    <img src="img/<?php echo $r_image;?>">
                    <h4><?php echo $r_title;?></h4>
                  </a>
                </div>
              <?php }?>
              </div>
            </div>

            <div class="author">
              <div class="row">
                <div class="col-sm-2">
                  <img src="img/<?php echo $author_image;?>" alt="Profile Image" class="img-circle">
                </div>
                <div class="col-sm-10">

                  <h5 style="color: #c1c1c1"><i class="fa fa-star"></i> Admin</h5>
                  <h4 style="text-decoration: none;"><?php echo ucfirst($author);?></h4>
                  <?php
                  $bio_query = "SELECT * FROM users WHERE username = '$author'";
                  $bio_run = mysqli_query($con, $bio_query);
                  if (mysqli_num_rows($bio_run) > 0 ) {
                    $bio_row = mysqli_fetch_array($bio_run);
                    $author_details = $bio_row['details'];      
                  ?>
                  <p><?php echo $author_details;?></p>
               
                <?php }?>

                </div>
              </div>
            </div>
            <?php
            $c_query = "SELECT * FROM comments WHERE status = 'approve' AND post_id = $post_id";
            $c_run = mysqli_query($con,$c_query);
            if (mysqli_num_rows($c_run)>0){
            ?>
            <div class="comment">
              <h3>Comments</h3><hr>
              <?php
              while ($c_row=mysqli_fetch_array($c_run)) {
                $c_id = $c_row['id'];
                $c_name = $c_row['name'];
                $c_username = $c_row['username'];
                $c_image = $c_row['image'];
                $c_comment = $c_row['comment'];
                $c_role = $c_row['role'];
                $c_date = getdate ($c_row['date']);
                $c_day = $c_date['mday'];
                $c_month = $c_date['month'];
                $c_year = $c_date['year'];
              ?>
              <div class="row single-comment">
                <div class="col-sm-2">
                  <img src="img/<?php echo $c_image;?>" alt="Profile Picture" class="img-circle">
                </div>
                <div class="col-sm-8">
                  <?php if(isset($c_role) && $c_role == 'admin'){ ?>
                  <h5 style="color: #c1c1c1"><i class="fa fa-star"></i> <?php echo ucfirst($c_role); ?></h5>
                  <?php } ?>
                  <h4><?php echo ucfirst($c_name);?></h4>
                  <p><?php echo $c_comment;?></p>
                </div>
                <div class="col-sm-2"><p style="font-size: 10px"><i class="fa fa-clock-o"></i> <?php echo "$c_day $c_month $c_year";?></p></div>
              </div>
              <?php }?>
            </div>
            <?php }?>
            
            <?php
            if (isset($_POST['submit'])) {
              $cs_name = $_POST['name'];
              $cs_email = $_POST['email'];
              $cs_website = $_POST['website'];
              $cs_comment = $_POST['comment'];
              $cs_date = time();

              if (empty($cs_name) or empty ($cs_email) or empty($cs_comment)) {
                $error_msg = "All (*) feilds are Required";
              }
              else{
                $cs_query = "INSERT INTO `comments` (`id`, `date`, `name`, `username`, `post_id`, `email`, `website`, `image`, `comment`, `status`,`role`) VALUES (NULL, '$cs_date', '$cs_name', 'user', '$post_id', '$cs_email', '$cs_website', 'unknown-picture.png', '$cs_comment', 'pending','user')";
                if (mysqli_query($con,$cs_query)) {
                    $msg = "Comment Submited and waiting for Approval";

                      $cs_name = "";
                      $cs_email = "";
                      $cs_website = "";
                      $cs_comment = "";
                  }
                    else{
                      $error_msg = "Comment has not be submited";
                 }
              }
            }
            ?>

            <div class="comment-box">
              <div class="row">
                <div class="col-xs-12">
                  <form action="" method="post">
                    <div class="form-group">
                      <label for="full-name">Full Name:*</label>
                      <input type="text" value="<?php if(isset($cs_name)){echo $cs_name;}?>" id="full name" class="form-control" placeholder="Full Name" name="name">
                    </div>

                    <div class="form-group">
                      <label for="email">Email Address:*</label>
                      <input type="text" value="<?php if(isset($cs_email)){echo $cs_email;}?>" id="email" class="form-control" placeholder="Email Address" name="email">
                    </div>

                    <div class="form-group">
                      <label for="website">Website:</label>
                      <input type="text" value="<?php if(isset($cs_website)){echo $cs_website;}?>" id="website" class="form-control" placeholder="Website" name="website">
                    </div>

                    <div class="form-group">
                      <label for="comment">Comment:*</label>
                      <textarea id="comment"  name="comment" cols="30" rows="10" placeholder="Your Comment Should be Here" class="form-control"
                      value="<?php if(isset($cs_comment)){echo $cs_comment;}?>"
                      ></textarea>
                    </div>

                    <input type="submit" name="submit" class="btn btn-primary" value="Comment">
                    <?php
                    if (isset($error_msg)) {
                      echo "<span style='color:red;' class='pull-right'>$error_msg</span>";
                    }
                    else if(isset($msg)){
                      echo "<span style='color:green;' class='pull-right'>$msg</span>";
                    }
                    ?>
                  </form>
                </div>
              </div>
            </div>

        </div>

        <div class="col-md-4">
          <?php require_once('inc/sidebar.php'); ?>
          </div><!--widgets close-->


        </div>
      </div>
    </div>
  </section>
  
  <?php include_once('inc/footer.php');?>