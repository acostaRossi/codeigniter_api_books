<?= $this->extend('App\Views\layout_app.php') ?>

<?= $this->section('main') ?>

	<!-- First Grid -->
	<div class="w3-row-padding w3-padding-64 w3-container">
	  <div class="w3-content">
	    <div class="w3-twothird">
	    	<form action="<?= base_url() ?>/books/<?= $res->isbn ?>" method="POST">
			    <label for="isbn">ISBN</label>
			    <input type="text" id="isbn" name="isbn" placeholder="isbn.." value="<?= $res->isbn ?>">

			    <label for="title">Title</label>
			    <input type="text" id="title" name="title" placeholder="title.." value="<?= $res->title ?>">

			    <label for="author">Author</label>
			    <input type="text" id="author" name="author" placeholder="author.." value="<?= $res->author ?>">

			    <input type="submit" value="Submit">
			</form>
	    </div>
	  </div>
	</div>

<?= $this->endSection() ?>