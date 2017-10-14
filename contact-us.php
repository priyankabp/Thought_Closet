<?php require_once('include/top.php');?>
  </head>
  <body>
    <?php require_once('include/header.php');?>

    <div class="jumbotron">
      <div class="container">
        <div id="details" class="animated fadeInLeft">
          <h1>Thought Closet <span>Contact US</span></h1>
          <p>We are available 24X7. So Feel Free to Contact Us</p>
        </div>
      </div>
      <img src="images/top-image.jpg" alt="Top Image">
    </div>

    <section>
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <div class="row">
              <div class="col-md-12">
                <script src='https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDlR6XcEHsR0dc8yvMyXXParWd2x26GPYY'></script>
                <div style='overflow:hidden;height:400px;width:100%;'>
                  <div id='gmap_canvas' style='height:400px;width:100%;'></div>
                  <style>#gmap_canvas img{max-width:none!important;background:none!important}</style>
                </div> 
                <a href='https://www.embed-map.net/'>Rendering google maps...</a> 
                <script type='text/javascript' src='https://embedmaps.com/google-maps-authorization/script.js?id=0c2f4bcdc0bb27e20a99bc53188f7f525f429661'></script>
                <script type='text/javascript'>function init_map(){var myOptions = {zoom:12,center:new google.maps.LatLng(40.7130082,-74.01316889999998),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById('gmap_canvas'), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(40.7130082,-74.01316889999998)});infowindow = new google.maps.InfoWindow({content:'<strong>World Trade Center</strong><br>285 Fulton St,<br> New York, NY 10007<br>'});google.maps.event.addListener(marker, 'click', function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);
              </script>
              </div>
              <div class="col-md-12 contact-us-form">
                <h2>Contact Form</h2><hr>
                <form action="form">
                  <div class="form-group">
                    <label for="fullname">Full Name*:</label>
                    <input type="text" id="fullname" class="form-control" placeholder="Fullname" name="">
                  </div>
                  <div class="form-group">
                    <label for="email">Email*:</label>
                    <input type="text" id="fullname" class="form-control" placeholder="Email" name="">
                  </div>
                  <div class="form-group">
                    <label for="website">Website:</label>
                    <input type="text" id="fullname" class="form-control" placeholder="Website name" name="">
                  </div>
                  <div class="form-group">
                    <label for="message">Message:</label>
                    <textarea id="message" cols="30" rows="10" class="form-control" placeholder="Your message here..."></textarea>
                  </div>

                  <a href="#"><input type="submit" name="Submit" value="Submit" class="btn btn-primary"></a>
                </form>
              </div>
            </div>
          </div>

          <div class="col-md-4"> <!-- Right side menu of the screen open -->
            <?php require_once('include/right_sidebar.php');?>
          </div> <!-- Right side menu of the screen closed -->
        </div>
      </div>
    </section>
  <?php require_once('include/footer.php');?>