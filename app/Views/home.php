<?= $this->extend('App\Views\layout_app.php') ?>
<?= $this->section('main') ?>

	<?php foreach ($res as $key => $book):?>

		<?php if($key%2 == 0) :?>

		<!-- First Grid -->
		<div class="w3-row-padding w3-padding-64 w3-container">
		  <div class="w3-content">
		    <div class="w3-twothird">
		      <h1><?= $book->isbn ?></h1>
		      <a href="<?= base_url() ?>/books/<?= $book->isbn ?>">
		      	<h5 class="w3-padding-32"><?= $book->title ?></h5>
		      </a>

		      <p class="w3-text-grey"><?= $book->author ?></p>
		    </div>

		    <div class="w3-third w3-center">
		      <i class="fa fa-book w3-padding-64 w3-text-red" style="font-size: 86px;"></i>
		    </div>
		  </div>
		</div>

		<?php else :?>

		<!-- Second Grid -->
		<div class="w3-row-padding w3-light-grey w3-padding-64 w3-container">
		  <div class="w3-content">
		    <div class="w3-third w3-center">
		      <i class="fa fa-book w3-padding-64 w3-text-red w3-margin-right" style="font-size: 86px; color: #3b7aec !important;"></i>
		    </div>

		    <div class="w3-twothird">
		    	<a href="<?= base_url() ?>/books/<?= $book->isbn ?>">
		      		<h1><?= $book->isbn ?></h1>
		      	</a>
		      	<h5 class="w3-padding-32"><?= $book->title ?></h5>

		      	<p class="w3-text-grey"><?= $book->author ?></p>
		    </div>
		  </div>
		</div>

		<?php endif ;?>

	<?php endforeach ;?>

<?= $this->endSection() ?>