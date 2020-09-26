<?php defined('ROOT') || die() ?>

	        <?php include 'includes/widgets/bottom_ads.php' ?>

		</div><!-- END Container -->

        <?php include 'includes/footer.php' ?>


		<?php if($page == 'dashboard'): ?>

			<div class="modal fade" id="edit_link" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<form action="dashboard" method="post" role="form">
							<div class="modal-header">
								<h5 class="modal-title"><?= $language->dashboard->edit_link_modal->header ?></h5>

								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>

							<div class="modal-body">
								<input type="hidden" class="form-control" name="link_id" value="" />

								<div class="form-group">
									<input type="text" class="form-control" name="title" placeholder="<?= $language->dashboard->input->title_placeholder ?>">
								</div>
								<div class="form-group">
									<input type="text" class="form-control" name="url" placeholder="<?= $language->dashboard->input->url_placeholder ?>">
								</div>

								<?php if($account->colored): ?>
			                    <div class="btn-group" data-toggle="buttons">
			                        <label class="btn btn-dark active">
			                            <input type="radio" name="color" value="dark">
			                        </label>
			                        <label class="btn btn-primary">
			                            <input type="radio" name="color" value="primary" >
			                        </label>
			                        <label class="btn btn-success">
			                            <input type="radio" name="color" value="success" >
			                        </label>
			                        <label class="btn btn-danger">
			                            <input type="radio" name="color" value="danger" >
			                        </label>
			                        <label class="btn btn-warning">
			                            <input type="radio" name="color" value="warning" >
			                        </label>
			                        <label class="btn btn-info">
			                            <input type="radio" name="color" value="info" >
			                        </label>
			                    </div>
			                    <?php endif ?>
							</div>

							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal"><?= $language->global->close ?></button>
								<div class="text-center">
									<button type="submit" name="submit" class="btn btn-primary"><?= $language->global->submit_button ?></button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>

			<script>
				$('#edit_link').on('show.bs.modal', function (event) {
					var button = $(event.relatedTarget);
					var link_id = button.data('id');
					var title = button.data('title');
					var url = button.data('url');
					var color = button.data('color');
					var modal = $(this);

					modal.find('.modal-body input[name="title"]').val(title);
					modal.find('.modal-body input[name="url"]').val(url);
					modal.find('.modal-body input[name="link_id"]').val(link_id);
					modal.find('.modal-body input[name="color"][value="'+color+'"]').attr('checked', true);
					modal.find('.modal-body input[name="color"][value="'+color+'"]').trigger('click');

				})
			</script>
		<?php endif ?>

	</body>
</html>
