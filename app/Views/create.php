<?= $this->extend('App\Views\layout_app.php') ?>

<?= $this->section('main') ?>

	<!-- First Grid -->
	<div class="w3-row-padding w3-padding-64 w3-container">
	  <div class="w3-content">
	    <div class="w3-twothird">
	    	<form action="<?= base_url() ?>/books/create" method="POST">
	    		<input type="hidden" name="_method" value="PUT" />

			    <label for="isbn">ISBN</label>
			    <input type="text" id="isbn" name="isbn" placeholder="isbn..">

			    <label for="title">Title</label>
			    <input type="text" id="title" name="title" placeholder="title..">

			    <label for="author">Author</label>
			    <input type="text" id="author" name="author" placeholder="author..">

			    <input type="submit" value="Submit">
			</form>
	    </div>
	  </div>
	</div>

<?= $this->endSection() ?>



