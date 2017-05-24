<?php
class Woohoo_registration_form
{

	private $username;
	private $email;
	private $password;
	private $first_name;
	private $last_name;

	function __construct()
	{
		add_shortcode( 'woohoo_registration_form', array( $this, 'shortcode' ) );
	}

	public function registration_form()
	{
		?>
		<form method="post" id="registerform" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>">
				<p class="form-group">
					<label class="login-field-icon fui-user" for="reg-fname"><?php woohoo_lang_t( 'Your First Name', 'woohoo' ); ?></label>
					<input name="reg_fname" type="text" class="form-control login-field" value="<?php echo(isset($_POST['reg_fname']) ? $_POST['reg_fname'] : null); ?>" id="reg-fname"/>
				</p>

				<p class="form-group">
					<label class="login-field-icon fui-user" for="reg-lname"><?php woohoo_lang_t( 'Your Last Name', 'woohoo' ); ?></label>
					<input name="reg_lname" type="text" class="form-control login-field" value="<?php echo(isset($_POST['reg_lname']) ? $_POST['reg_lname'] : null); ?>" id="reg-lname"/>
				</p>

				<p class="form-group">
					<label class="login-field-icon fui-mail" for="reg-email"><?php woohoo_lang_t( 'Your Email', 'woohoo' ); ?></label>
					<input name="reg_email" type="email" class="form-control login-field" value="<?php echo(isset($_POST['reg_email']) ? $_POST['reg_email'] : null); ?>" id="reg-email" required/>
				</p>

				<p class="form-group">
					<label class="login-field-icon fui-user" for="reg-name"><?php woohoo_lang_t( 'Choose Username', 'woohoo' ); ?></label>
					<input name="reg_name" type="text" class="form-control login-field" value="<?php echo(isset($_POST['reg_name']) ? $_POST['reg_name'] : null); ?>" id="reg-name" required/>
				</p>

				<p class="form-group">
					<label class="login-field-icon fui-lock" for="reg-pass"><?php woohoo_lang_t( 'Choose Password', 'woohoo' ); ?></label>
					<input name="reg_password" type="password" class="form-control login-field" value="<?php echo(isset($_POST['reg_password']) ? $_POST['reg_password'] : null); ?>" id="reg-pass" required/>
				</p>

				<p class="form-submit">
					<input class="button-primary" type="submit" name="reg_submit" value="Register"/>
				</p>
		</form>
		<?php
	}

	function validation()
	{

		if (empty($this->username) || empty($this->password) || empty($this->email)) {
			return new WP_Error('field', 'Required form field is missing');
		}

		if (strlen($this->username) < 4) {
			return new WP_Error('username_length', 'Username too short. At least 4 characters is required');
		}

		if (strlen($this->password) < 5) {
			return new WP_Error('password', 'Password length must be greater than 5');
		}

		if (!is_email($this->email)) {
			return new WP_Error('email_invalid', 'Email is not valid');
		}

		if (email_exists($this->email)) {
			return new WP_Error( 'email', 'Email Already in use' );
		}

		$details = array(
			'Username'      => $this->username,
			'First Name'    => $this->first_name,
			'Last Name'     => $this->last_name,
		);

		foreach ( $details as $field => $detail ) {
			if ( ! validate_username( $detail ) ) {
				return new WP_Error('name_invalid', 'Sorry, the "' . $field . '" you entered is not valid');
			}
		}
	}

	function registration()
	{

		$userdata = array(
			'user_login'    => esc_attr($this->username),
			'user_email'    => esc_attr($this->email),
			'user_pass'     => esc_attr($this->password),
			'first_name'    => esc_attr($this->first_name),
			'last_name'     => esc_attr($this->last_name),
		);

		if ( is_wp_error( $this->validation() ) )
		{
			echo '<div style="margin-bottom: 6px" class="btn btn-block btn-lg btn-danger">';
			echo '<strong>' . $this->validation()->get_error_message() . '</strong>';
			echo '</div>';
		}
		else {
			$register_user = wp_insert_user( $userdata );

			if (! is_wp_error( $register_user ) )
			{
				/*echo '<div style="margin-bottom: 6px" class="btn btn-block btn-lg btn-danger">';
				echo '<strong>Registration complete. Goto <a href="' . wp_login_url() . '">login page</a></strong>';
				echo '</div>';
				*/
			}
			else {
				echo '<div style="margin-bottom: 6px" class="btn btn-block btn-lg btn-danger">';
				echo '<strong>' . $register_user->get_error_message() . '</strong>';
				echo '</div>';
			}
		}
	}

	function shortcode()
	{
		ob_start();
		if ( isset( $_POST['reg_submit'] ) )
		{
			$this->username         = $_POST['reg_name'];
			$this->email            = $_POST['reg_email'];
			$this->password         = $_POST['reg_password'];
			$this->first_name       = $_POST['reg_fname'];
			$this->last_name        = $_POST['reg_lname'];
			$this->validation();
			$this->registration();
		}
		$this->registration_form();
		return ob_get_clean();
	}
}
new Woohoo_registration_form;