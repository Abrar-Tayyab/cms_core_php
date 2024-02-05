<?php
$session_role2 = $_SESSION['role'];
$session_username2 = $_SESSION['username'];
?>


<nav class="navbar bg-primary navbar-fixed-top">
                  <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span  class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="index.php">
                        <div class="col-xs-3"><img src="img/logo/logo_transparent.png" alt="logo" width="90px" style="margin-left:-20px;margin-top: -30px"></div>
                      </a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                   
                     <ul class="nav navbar-nav navbar-right">
                        <li><a href="">Welcome: <i class="fa fa-user"></i> <?php echo ucfirst($session_username2);?></a></li>
                        <li><a href="add-post.php"><i class="fa fa-plus-square"></i> Add Post</a></li>
                        <?php
                        if ($session_role2 == 'Admin') {
                          
                        ?>
                        <li><a href="add_user.php"><i class="fa fa-user-plus"></i> Add User</a></li>
                      <?php }?>
                        <li><a href="profile.php"><i class="fa fa-user"></i> Profile</a></li>
                        <li><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>

                      </ul>
                      
                    </div><!-- /.navbar-collapse -->
                  </div><!-- /.container-fluid -->
              </nav>