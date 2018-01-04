<div id="signup_forms_panel">
	<form class="signup_forms" action="[[action]]" method="post">
		<div class="signup_view">
			<input name="signup" value="1" type="hidden">
			<fieldset>
				<legend>[[lang_legend_signupform]]</legend>
				<div>
					<input id="name" name="name" type="text" placeholder="[[lang_user_name]]" required>
				</div>
				<div>
					<input id="email" name="email" type="email" placeholder="[[lang_email_tv]]" required >
				</div>
				<div>
					<input id="password" name="password" type="password" placeholder="[[lang_pass_tv]]" required>
				</div>
			</fieldset>
			<p><input id="submit" name="sender" type="submit" value="[[lang_submit_signup]]"></p>
			<p class="infoline-bottom"><a title="[[lang_already_registered]]" href="[[login_link]]">[[lang_already_registered]]</a></p>
		</div>
	</form>
</div>