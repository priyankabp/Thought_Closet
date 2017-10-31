	  <footer class="text-center">
        Copyright &copy; by <a href="#">Priyanka Phapale</a> from 2017- <?php echo date('Y');?>.
      </footer>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js"></script>
    <script src="js/code.js"></script>
    <script type="text/javascript">
      
      tinymce.init({
      selector: "textarea#textarea",
      height: 200,
      plugins: [
        "advlist autolink link image lists charmap print preview hr anchor pagebreak",
        "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
        "table contextmenu directionality emoticons template textcolor paste fullpage textcolor colorpicker textpattern"
      ],

      toolbar1: "newdocument fullpage | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | styleselect formatselect fontselect fontsizeselect",
      toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media code | insertdatetime preview | forecolor backcolor",
      toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | print fullscreen | ltr rtl | visualchars visualblocks nonbreaking template pagebreak restoredraft",
      content_css: [
        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
        '//www.tinymce.com/css/codepen.min.css'],

      menubar: false,
      toolbar_items_size: 'small',

      style_formats: [{
        title: 'Bold text',
        inline: 'b'
      }, {
        title: 'Red text',
        inline: 'span',
        styles: {
          color: '#ff0000'
        }
      }, {
        title: 'Red header',
        block: 'h1',
        styles: {
          color: '#ff0000'
        }
      }, {
        title: 'Example 1',
        inline: 'span',
        classes: 'example1'
      }, {
        title: 'Example 2',
        inline: 'span',
        classes: 'example2'
      }, {
        title: 'Table styles'
      }, {
        title: 'Table row 1',
        selector: 'tr',
        classes: 'tablerow1'
      }],

      templates: [{
        title: 'Test template 1',
        content: 'Test 1'
      }, {
        title: 'Test template 2',
        content: 'Test 2'
      }],
      
      init_instance_callback: function () {
        window.setTimeout(function() {
          $("#div").show();
         }, 1000);
      },
      <?php
      $media_query = "SELECT * FROM media";
      $media_run = mysqli_query($connection,$media_query);
      if (mysqli_num_rows($media_run) > 0) {
      ?>
      image_list: [
        <?php
          while($media_row = mysqli_fetch_array($media_run)){
            $media_name = $media_row['image'];
        ?>
        {title: '<?php echo $media_name?>', value: 'media/<?php echo $media_name?>'},
        <?php } ?>
      ]
      <?php } ?>
    });

    </script>
  </body>
</html>