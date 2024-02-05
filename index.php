<?php require_once('inc/top.php'); ?>
<?php require_once('admin/inc/db.php'); ?>

  </head>
  <body>

    <?php require_once('inc/header.php'); ?>
      
      <?php
      $number_of_posts = 3;

      // $count_views = "SELECT COUNT(views) FROM `posts` WHERE id = 18";
      // $count_views_result = mysqli_query($con,$count_views);


      if (isset($_GET['page'])) {
        $page_id = $_GET['page'];
      }
      else{
        $page_id = 1;
      }

      //..fetch categories
      if (isset($_GET['cat'])) {
        $cat_id = $_GET['cat'];
        $cat_query = "SELECT * FROM categories WHERE id = $cat_id";
        $cat_run = mysqli_query($con,$cat_query);
       
        $cat_row = mysqli_fetch_array($cat_run);
        $cat_name = $cat_row['category'];
      }


      if (isset($_POST['search'])) {
        $search = $_POST['search-title'];
        $all_posts_query = "SELECT *, (SELECT COUNT(`id`) FROM `comments` WHERE comments.post_id = posts.id) AS `total_comment` FROM posts WHERE status = 'publish'";
                $all_posts_query.= " and tags LIKE '%$search%'";
                 $all_posts_run = mysqli_query($con, $all_posts_query);
                $all_posts = mysqli_num_rows($all_posts_run);
                $total_pages = ceil($all_posts / $number_of_posts);
                $posts_start_from = ($page_id - 1) * $number_of_posts;
      }
          else{
            $all_posts_query = "SELECT *, (SELECT COUNT(`id`) FROM `comments` WHERE comments.post_id = posts.id) AS `total_comment` FROM posts WHERE status = 'publish'";
              if (isset($cat_name)) {
                $all_posts_query.= " and categories = '$cat_name'";
              }
                 $all_posts_run = mysqli_query($con, $all_posts_query);
                $all_posts = mysqli_num_rows($all_posts_run);
                $total_pages = ceil($all_posts / $number_of_posts);
                $posts_start_from = ($page_id - 1) * $number_of_posts;
      }
        
   
      ?>

   <div class="jumbotron">
     <div class="container">
       <div id="details" class="animated fadeInLeft">
         <h1>Pix<span> Blog</span></h1>
         <p>This Is My Blog Website</p>
       </div>
     </div>
     
     <img src="img/top-image.jpg" alt="top image">
   </div>

  <section>
    <div class="container">
      <div class="row">
        <div class="col-md-8">

          <?php

            if (isset($_POST['search'])) {
              $search = $_POST['search-title'];
              $query = "SELECT *, (SELECT COUNT(`id`) FROM `comments` WHERE comments.post_id = posts.id) AS `total_comment` FROM posts WHERE status = 'publish'";
              // SELECT *, COUNT(comments.comment) AS total_comment FROM posts LEFT JOIN comments ON posts.id = comments.post_id WHERE posts.status = 'publish'
              $query .= " and tags LIKE '%$search%'";
            $query .= " ORDER BY id DESC LIMIT $posts_start_from, $number_of_posts";
            }else{
              $query = "SELECT *, (SELECT COUNT(`id`) FROM `comments` WHERE comments.post_id = posts.id) AS `total_comment` FROM posts WHERE status = 'publish'";
              if (isset($cat_name)) {
                $query .= " and categories = '$cat_name'";
              }
              $query .= " ORDER BY id DESC LIMIT $posts_start_from, $number_of_posts";
            }

            $run = mysqli_query($con,$query);
            // echo $query;
            if (mysqli_num_rows($run) > 0) {
              while ($row = mysqli_fetch_array($run)) {
               // var_dump($row);die();
                $id = $row['id'];
                $date = getdate($row['date']);
                $day = $date['mday'];
                $month = $date['month'];
                $year = $date['year'];
                $title = $row['title'];
                $author = $row['author'];
                $author_image = $row['author_image'];
                $image = $row['image'];
                $categories = $row['categories'];
                $tags = $row['tags'];
                $post_data = $row['post_data'];
                $views = $row['views'];
                $status = $row['status'];
                $comments = $row['total_comment'];
                       
            ?>
            <div class="post" >
              <div class="row">
                <div class="col-md-2 post-date">
                  <div class="day"><?php echo $day; ?></div>
                  <div class="month"><?php echo $month; ?></div>
                  <div class="year"><?php echo $year; ?></div>
                </div>
                <div class="col-md-8 post-title">
                  <a href="post.php?post_id=<?php echo $id; ?>">
                    <h2>
                     <?php echo ucfirst($title); ?>
                    </h2></a>
                  <p>Written by: <span><?php echo ucfirst($author); ?></span></p>
                </div>
                <div class="col-md-2 profile-picture">
                  <img src="img/<?php echo $author_image;?>" align="profile picture" class="img-circle" >
                </div>
              </div>
              <div style="padding: 10px 10px">
              <a href="post.php?post_id=<?php echo $id; ?>"><img src="img/<?php echo $image; ?> " alt="post image" style="width: 100%" ></a>
              </div>
              <div class="desc">
                <a href="post.php?post_id=<?php echo $id; ?>" class="btn btn-primary">Read More</a>
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

            <?php

            }
            }
            else{
              echo "<center><h2>No Post Available</h2></center>";
            }
            ?> 


            <nav id="pagination">
                <ul class="pagination">
                  <?php
                  for ($i = 1; $i <= $total_pages ; $i++) { 
                    echo "<li class = '".($page_id == $i ? 'active': '')."'><a href='index.php?page=".$i."&".(isset($cat_name)?"cat=$cat_id":" ")."'>$i</a></li>";
                  }
                  ?>
                </ul>
              </nav>

        </div>

        <div class="col-md-4">
            <?php require_once('inc/sidebar.php'); ?>
          </div><!--widgets close-->


      </div>
    </div>
  </section>

 <?php include_once('inc/footer.php');?>
 