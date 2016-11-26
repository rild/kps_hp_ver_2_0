<?php
$local_endpoint = "http://localhost/kps_honoka/";
$staging_endpoint = "http://131.113.100.213/~j140098t/kps_honoka/";
$endpoint = $local_endpoint;

echo '
<header>
  <div class="navbar navbar-default navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <a href=" '.$endpoint.'" class="navbar-brand">KPS</a>
        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>
      <div class="navbar-collapse collapse" id="navbar-main">
        <ul class="nav navbar-nav">
          <li><a href=" '.$endpoint.'php/main/top.php">Top</a></li>
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Menu<span class="caret"></span></a>
            <ul class="dropdown-menu" role="menu">
              <!-- general -->
              <li><a href=" '.$endpoint.'php/main/concert/concert.php#">Blog</a></li>
              <li><a href=" '.$endpoint.'php/main/concert/concert.php#">Portfolio</a></li>
              <!-- admin -->
              <li class="divider"></li>
              <li><a href=" '.$endpoint.'php/main/concert/top.php">Concert</a></li>
              <li><a href=" '.$endpoint.'php/main/concert/concert.php#">Member</a></li>
              <li><a href=" '.$endpoint.'php/main/concert/concert.php#">Article</a></li>
              <!-- user config -->
              <li class="divider"></li>
              <li><a href=" '.$endpoint.'main/concert/concert.php#">User</a></li>
              <li><a href="#">Help</a></li>
            </ul>
          </li>
        </ul>
        <!-- search -->
        <form class="navbar-form navbar-left" role="search">
          <div class="form-group">
            <input type="text" class="form-control" placeholder="Search">
          </div>
          <button type="submit" class="btn btn-default">Submit</button>
        </form>
        <ul class="nav navbar-nav navbar-right">
          <li><a href=" '.$endpoint.'php/users/signin/login.php">Logout</a></li>
        </ul>
      </div>
    </div>
  </div>
</header>
';
?>
