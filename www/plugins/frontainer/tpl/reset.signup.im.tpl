<div id="signup_forms_panel">
	<form class="signup_forms" action="[[action]]" method="post">
		<div class="signup_view">
			<input name="reset" value="1" type="hidden">
			<input name="key" value="[[reset_key]]" type="hidden">
			<input name="user" value="[[reset_name]]" type="hidden">
			<fieldset>
				<legend>[[lang_legend_resetform]]</legend>
				<div>
					<input class="password" name="password" type="password" placeholder="[[lang_reset_pass_tv]]" required>
				</div>
				<div>
					<input class="password" name="confirm_password" type="password" placeholder="[[lang_reset_confirm_tv]]" required>
				</div>
			</fieldset>
			<p><input id="submit" name="sender" type="submit" value="[[lang_submit_reset]]"></p>
		</div>
	</form>
</div>