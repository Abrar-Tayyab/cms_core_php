<?php require_once('inc/top.php'); ?>
  </head>
  <body>
    
<?php require_once('inc/header.php'); ?>

   <div class="jumbotron">
     <div class="container">
       <div id="details" class="animated fadeInLeft">
         <h1>Contact<span> Us</span></h1>
         <p>We are available 24*7. So Feel Free to Contact Us.</p>
       </div>
     </div>
     <img src="img/top-image.jpg" alt="top image">
   </div>

  <section>
    <div class="container">
      <div class="row">
        <div class="col-md-8">
            <div class="row">
              <div class="col-md-12">
                <script src='https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCMTnJtKslloUz1mXJKHDYH2wi47ZoVxS0'></script><div style='overflow:hidden;height:400px;width:100%;'><div id='gmap_canvas' style='height:400px;width:100%;'></div><style>#gmap_canvas img{max-width:none!important;background:none!important}</style></div> <a href='https://www.stat-counter.org/'> </a> <script type='text/javascript' src='https://embedmaps.com/google-maps-authorization/script.js?id=225f60a78eda68e13e3b8a5f4de3cd55216c21e3'></script><script type='text/javascript'>function init_map(){var myOptions = {zoom:12,center:new google.maps.LatLng(41.31,-72.92000000000002),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(41.31,-72.92000000000002)});infowindow = new google.maps.InfoWindow({content:'<strong></strong><br><br><br>'});google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
              </div>
              <div class="col-md-12 contact-form">
                <h2>Contact Form</h2><hr>
                <form>
                  <div class="form-group">
                    <label for="full-name">Full Name:*</label>
                    <input type="text" name="" id="full-name" class="form-control" placeholder="Full Name">
                  </div>

                  <div class="form-group">
                    <label for="email">Email:*</label>
                    <input type="text" name="" id="email" class="form-control" placeholder="Email">
                  </div>
                  <div class="form-group">
                    <label for="website">Website:</label>
                    <input type="text" name="" id="website" class="form-control" placeholder="Full Name">
                  </div>
                  <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea type="text" name="" id="message" cols="30" rows="10" class="form-control" placeholder="Your Message Should be Here"></textarea>
                  </div>

                  <input type="submit" name="submit" value="submit" class="btn btn-primary">

                </form>
              </div>
            </div>
        </div>

        <div class="col-md-4">
          <?php require_once('inc/contact_sidebar.php'); ?>
          </div><!--widgets close-->

          <div class="widgets">
            <div class="popular">
              <h4>Categories</h4>
              <hr>
            <div class="row">
              <div class="col-xs-6">
                <ul>
                  <?php
                  $c_query = "SELECT * FROM categories";
                  $c_run = mysqli_query($con,$c_query);
                  if (mysqli_num_rows($c_run) > 0) {
                    $count = 2;
                    while ($c_row = mysqli_fetch_array($c_run)) {
                      $c_id = $c_row['id'];
                      $c_category = $c_row['category'];
                      
                      $count = $count + 1;

                      if (($count % 2) == 1) {
                        echo "<li><a href='index.php?cat=".$c_id."'>".(ucfirst($c_category))."</a></li>";
                      }

                    }
                  }
                  else{
                    echo "<p>No category</p>";
                  }
                  ?>
                </ul>
              </div>
              <div class="col-xs-6">
                <ul>
                  <?php
                  $c_query = "SELECT * FROM categories";
                  $c_run = mysqli_query($con,$c_query);
                  if (mysqli_num_rows($c_run) > 0) {
                    $count = 2;
                    while ($c_row = mysqli_fetch_array($c_run)) {
                      $c_id = $c_row['id'];
                      $c_category = $c_row['category'];
                      
                      $count = $count + 1;

                      if (($count % 2) == 0) {
                        echo "<li><a href='index.php?cat=".$c_id."'>".(ucfirst($c_category))."</a></li>";
                      }

                    }
                  }
                  else{
                    echo "<p>No category</p>";
                  }
                  ?>
                </ul>
              </div>
            </div>
          </div>
          </div><!--widgets close-->

          <div class="widgets">
            <div class="categories">
              <h4>Social Icons</h4>
              <hr>
            <div class="row">
              <div class="col-xs-4">
                <a href="https://web.facebook.com/PixProduction2/?ref=bookmarks"><img src="img/facebook.png" alt="facebook"></a>
              </div>
              <div class="col-xs-4"><a href="http://www.twitter.com"><img src="img/twitter.png" alt="twitter"></a></div>
              <div class="col-xs-4"><a href="http://www.google.com"><img src="img/googleplus.png" alt="googleplus"></a></div>
            </div>
              <hr>
            <div class="row">
              <div class="col-xs-4">
                <a href="http://www.linkedin.com"><img src="img/linkedin.png" alt="linkedin"></a>
              </div>
              <div class="col-xs-4"><a href="http://skype.com"><img src="img/skype.png" alt="skype"></a></div>
              <div class="col-xs-4"><a href="http://youtube.com"><img src="img/youtube.gif" alt="youtube"></a></div>
            </div>
          </div>
          </div><!--widgets close-->
        </div>
      </div>
    </div>
  </section>
<?php include_once('inc/footer.php');?>