<!-- Navbar -->
<div class="w3-top">
  <div class="w3-bar w3-red w3-card w3-left-align w3-large">
    <a class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-red" href="javascript:void(0);" onclick="myFunction()" title="Toggle Navigation Menu"><i class="fa fa-bars"></i></a>

    <a href="<?= base_url() ?>/books" class="w3-bar-item w3-button w3-padding-large <?php if(current_url() == base_url() . '/books' || current_url() == base_url() . '/') :?> w3-white <?php endif ;?>">Books</a>
    <a href="<?= base_url() ?>/books/new" class="w3-bar-item w3-button w3-padding-large <?php if(current_url() == base_url() . '/books/new') :?> w3-white <?php endif ;?>">Create</a>
    <a href="<?= base_url() ?>/books/list" class="w3-bar-item w3-button w3-padding-large <?php if(current_url() == base_url() . '/books/list') :?> w3-white <?php endif ;?>">List</a>

    <a href="<?= base_url() ?>/logout" class="w3-bar-item w3-padding-large w3-button" style="float:right;">Logout</a>
  </div>

</div>