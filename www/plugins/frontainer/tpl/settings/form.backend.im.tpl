<div id="manager-header">
	<h3 class="floated">[[frontainer_title]]</h3>
	<div class="edit-nav clearfix"></div>
</div>
<div class="manager-wrapper">
	[[msgs]]
	<form class="largeform" action="load.php?id=frontainer" method="post" accept-charset="utf-8">
		<div class="fieldarea">
			<label for="sitename">[[sitename]]</label>
			<p><input id="sitename" class="text-fields-left text" name="sitename" type="text" value="[[sitename_value]]"></p>
		</div>
		<div class="fieldarea">
			<label for="email_from">[[email_from]]</label>
			<p class="field-info"><i class="fa fa-info-circle"></i> [[email_from_info]]</p>
			<p><input id="email_from" class="text-fields-left text" name="email_from" type="text" value="[[email_from_value]]"></p>
		</div>
		<div class="fieldarea">
			<label for="email_to">[[email_to]]</label>
			<p class="field-info"><i class="fa fa-info-circle"></i> [[email_to_info]]</p>
			<p><input id="email_to" class="text-fields-left text" name="email_to" type="text" value="[[email_to_value]]"></p>
		</div>

		<p><input name="submit" type="submit" class="submit" value="[[savebutton]]" /></p>
	</form>
</div>