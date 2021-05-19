<?= $this->extend('App\Views\layout_app.php') ?>
<?= $this->section('main') ?>

	<div class="w3-row-padding w3-padding-64 w3-container">
		<div class="w3-content">

			<table id="tabella" class="stripe" style="width:100%">
		        <thead>
		            <tr>
		            	<th>Isbn</th>
		                <th>Title</th>
		                <th>Author</th>
		            </tr>
		        </thead>
		        <tbody>
		        	<?php foreach ($res as $key => $book):?>

		            <tr>
		                <td><a href="<?= base_url() ?>/books/<?= $book->isbn ?>"><h5 class="w3-padding-32"><?= $book->isbn ?></h5></a></td>
		                <td><a href="<?= base_url() ?>/books/<?= $book->isbn ?>"><h5 class="w3-padding-32"><?= $book->title ?></h5></a></td>
		                <td><?= $book->author ?></td>
		            </tr>

		            <?php endforeach ;?>
		        </tbody>
		        <tfoot>
		            <tr>
		                <th>Isbn</th>
		                <th>Title</th>
		                <th>Author</th>
		            </tr>
		        </tfoot>
		    </table>
		</div>
	</div>

<?= $this->endSection() ?>

<?= $this->section('pageScripts') ?>

<script type="text/javascript">
	$(document).ready(function()
	{
		$('#tabella').DataTable();
	});	
</script>

<?= $this->endSection() ?>