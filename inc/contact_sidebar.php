<div class="widgets">
              <form action="index.php" method="post">
            <div class="input-group">
              <input name="search-title" type="text" class="form-control" placeholder="Search for...">
              <span class="input-group-btn">
                <input type="submit" value="Go" class="btn btn-default" name="search">
              </span>
            </div><!-- /input-group -->
            </form>
          </div><!--widgets close-->

          <div class="widgets">
            <div class="popular">
              <h4>Popular Posts</h4>
              
              <?php
              $p_query = "SELECT * FROM posts WHERE status = 'publish' ORDER BY views DESC LIMIT 5 ";
              $p_run = mysqli_query($con, $p_query);
              if (mysqli_num_rows($p_run) > 0) {
                while ($p_row = mysqli_fetch_array($p_run)) {
                  $p_id = $p_row['id'];
                  $p_date = getdate ($p_row['date']);
                  $p_day = $p_date['mday'];
                  $p_month = $p_date['month'];
                  $p_year = $p_date['year'];
                  $p_title = $p_row['title'];
                  $p_image = $p_row['image'];
                

              ?>
              <hr>
              <div class="row">
                <div class="col-xs-4">
                  <a href="post.php?post_id=<?php echo $p_id;?>"><img src="img/<?php echo $p_image;?>" alt="image"></a>
                </div>
                <div class="col-xs-8 details">
                  <a href="post.php?post_id=<?php echo $p_id;?>"><h6><?php echo $p_title;?></h6></a>
                  <p><i class="fa fa-clock-o"></i> <?php echo "$p_day $p_month $p_year";?></p>
                </div>
              </div>
              <?php
                }
              }
              else{
                echo "<h3>No Post Available</h3>";
              }
              ?>

            </div>
          </div><!--widgets close-->
          <div class="widgets">
            <div class="popular">
              <h4>Recent Posts</h4>
              
              <?php
              $p_query = "SELECT * FROM posts WHERE status = 'publish' ORDER BY id DESC LIMIT 5 ";
              $p_run = mysqli_query($con, $p_query);
              if (mysqli_num_rows($p_run) > 0) {
                while ($p_row = mysqli_fetch_array($p_run)) {
                  $p_id = $p_row['id'];
                  $p_date = getdate ($p_row['date']);
                  $p_day = $p_date['mday'];
                  $p_month = $p_date['month'];
                  $p_year = $p_date['year'];
                  $p_title = $p_row['title'];
                  $p_image = $p_row['image'];
                

              ?>
              <hr>
              <div class="row">
                <div class="col-xs-4">
                  <a href="post.php?post_id=<?php echo $p_id;?>"><img src="img/<?php echo $p_image;?>" alt="image"></a>
                </div>
                <div class="col-xs-8 details">
                  <a href="post.php?post_id=<?php echo $p_id;?>"><h6><?php echo $p_title;?></h6></a>
                  <p><i class="fa fa-clock-o"></i> <?php echo "$p_day $p_month $p_year";?></p>
                </div>
              </div>
              <?php
                }
              }
              else{
                echo "<h3>No Post Available</h3>";
              }
              ?>

            </div>
          </div><!--widgets close-->
