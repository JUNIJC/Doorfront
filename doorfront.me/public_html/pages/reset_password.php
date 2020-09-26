<?php
defined('ROOT') || die();
User::logged_in_redirect();

$email = (isset($parameters[0])) ? $parameters[0] : false;
$lost_password_code = (isset($parameters[1])) ? $parameters[1] : false;

if(!$email || !$lost_password_code) redirect();

/* Check if the lost password code is correct */
$stmt = $database->prepare("SELECT `user_id` FROM `users` WHERE `email` = ? AND `lost_password_code` = ?");
$stmt->bind_param('ss', $email, $lost_password_code);
$stmt->execute();
$stmt->store_result();
$num_rows = $stmt->num_rows;
$stmt->fetch();
$stmt->close();

if($num_rows < 1 || strlen($lost_password_code) < 32) redirect();

if(!empty($_POST)) {
	/* Check for any errors */
	if(strlen(trim($_POST['new_password'])) < 6) {
		$_SESSION['error'][] = $language->reset_password->error_message->short_password;
	}
	if($_POST['new_password'] !== $_POST['repeat_password']) {
		$_SESSION['error'][] = $language->reset_password->error_message->passwords_not_matching;
	}

	if(empty($_SESSION['error'])) {
		/* Encrypt the new password */
		$new_password = password_hash($_POST['new_password'], PASSWORD_DEFAULT);

		/* Update the password & empty the reset code from the database */
		$stmt = $database->prepare("UPDATE `users` SET `password` = ?, `lost_password_code` = 0  WHERE `email` = ?");
		$stmt->bind_param('ss', $new_password, $_POST['email']);
		$stmt->execute();
		$stmt->close();

		/* Store success message */
		$_SESSION['success'][] = $language->reset_password->success_message->password_updated;

	}

	display_notifications();

}

?>

<div class="d-flex justify-content-center">
    <div class="card card-shadow col-md-5 border-0">
        <div class="card-body">

            <h4><?= $language->reset_password->header ?></h4>

            <form action="" method="post" role="form">

                <input type="hidden" name="email" value="<?= $email ?>" class="form-control" />

                <div class="form-group mt-5">
                    <label><?= $language->reset_password->input->new_password ?></label>
                    <input type="password" name="new_password" class="form-control" />
                </div>

                <div class="form-group">
                    <label><?= $language->reset_password->input->repeat_password ?></label>
                    <input type="password" name="repeat_password" class="form-control" />
                </div>

                <div class="form-group mt-5">
                    <button type="submit" name="submit" class="btn btn-default btn-block my-1"><?= $language->global->submit_button ?></button>
                </div>

            </form>

        </div>
    </div>
</div>
