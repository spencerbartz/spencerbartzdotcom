<?php
  include 'util/util.php';
  include 'php/site/_page_declaration.php';

  print_page_dec(__FILE__);
?>

<title>
	<?php echo "Spencer Bartz - Portfolio Website"; ?>
</title>

</head>

<!-- content-wrap starts here -->
<div id="content-wrap">
  <div id="content">

    <!-- Right side search box area -->
    <div id="sidebar" >

    </div>

    <!-- Left Side (Main Content)-->
    <div id="main">

      <div class="box">
        <h1><?php echo 'Welcome to <span class="white">spencerbartz.com</span>'; ?></h1>
        <p>
          <?php            
            $desc = 
            "This site is a compilation of some of my programming projects in various languages. " .
            "Web based projects can be run as-is. Java and Python require installation of " .
            "a separate runtime environment. Links to those downloads are at the bottom of this page. " .
            "All site functionality you see (e.g. search and news archives) is written from scratch in PHP, JavaScript, and MySQL. " .
            "This website as well as various other projects of mine are available " .
            "<a href=\"https://github.com/spencerbartz/spencerbartz.com\"> on GitHub. Feel free to have a look!</a>";
            echo $desc;
          ?>
		    </p>        
          <p class="post-footer align-right"><span class="date"><?php last_updated(__FILE__); ?></span></p>
      </div>

    </div>

    <!-- content-wrap ends here -->
  </div>
</div>

</body>
</html>
