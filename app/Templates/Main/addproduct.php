<div class="row">
	<div class="col-md-6">
		<h1>product toevoegen</h1>
		<br>
		<form method="post" action="<?= $this->link(array('controller' => 'main', 'action' => 'addproduct')) ?>">
			<div class="form-group">
				<label for="title">Title</label>
				<input type="text" class="form-control" id="title" placeholder="Title" name="title">
			</div>
			<div class="form-group">
				<label for="description">Description</label>
				<textarea type="text" class="form-control" id="description" placeholder="Description" name="description"></textarea>
			</div>
			<div class="form-group">
				<label for="images">Images</label>
				<textarea type="text" class="form-control" id="images" placeholder="Images" name="images"></textarea>
			</div>
			<div class="form-group">
				<label for="price">Price</label>
				<input type="text" class="form-control" id="price" placeholder="Price" name="price">
			</div>
			<div class="form-group">
				<label for="stock">Stock</label>
				<input type="text" class="form-control" id="stock" placeholder="Stock" name="stock">
			</div>
			
			<button type="submit" class="btn btn-primary">Submit</button>
		</form>
	</div>
</div>