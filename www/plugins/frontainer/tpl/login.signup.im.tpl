<div id="signup_forms_panel">
	<form class="signup_forms" action="[[action]]" method="post">
		<div class="signup_view">
			<input name="login" value="1" type="hidden">
			<fieldset>
				<legend>[[lang_legend_loginform]]</legend>
				<div>
					<input id="email" name="email" type="email" placeholder="[[lang_email_tv]]" required >
				</div>
				<div>
					<input id="password" name="password" type="password" placeholder="[[lang_pass_tv]]" required>
				</div>
			</fieldset>
			<p><input id="submit" name="sender" type="submit" value="[[lang_submil_login]]"></p>
			<p class="infoline-bottom"><a title="[[lang_forgot_pass_title]]" href="[[recovery_link]]">[[lang_forgot_pass]]</a></p>
		</div>
	</form>
</div>