var adminThemer = function(GSCS) {

	var pri = [
		GSCS.returnSetting('adminxml_plus', 'primary_0'),
		GSCS.returnSetting('adminxml_plus', 'primary_1'),
		GSCS.returnSetting('adminxml_plus', 'primary_2'),
		GSCS.returnSetting('adminxml_plus', 'primary_3'),
		GSCS.returnSetting('adminxml_plus', 'primary_4'),
		GSCS.returnSetting('adminxml_plus', 'primary_5'),
		GSCS.returnSetting('adminxml_plus', 'primary_6')
	], 
	sec = [
		GSCS.returnSetting('adminxml_plus', 'secondary_0'),
		GSCS.returnSetting('adminxml_plus', 'secondary_1')	
	],
	colorsArr = function(obj) {
		var output = [pri[0].value, pri[1].value, pri[2].value, pri[3].value, pri[4].value, pri[5].value, pri[6].value, sec[0].value, sec[1].value];
		if (!obj)	output = [pri[0].value(), pri[1].value(), pri[2].value(), pri[3].value(), pri[4].value(), pri[5].value(), pri[6].value(), sec[0].value(), sec[1].value()];
		return output;
	},
	pluginLang = ko.unwrap(GSCS.returnSetting('adminxml_plus', 'plugin_lang').label).split(';'),
	presets = [
		{
			name: 'Nature', 
			author: 'Christophe Aubry', 
			url: 'nature/607/', 
			authUrl: 'http://www.netplume.net/', 
			colors: ['#325A49','#40745E','#A6A6A0','#325A49','#F1F2E9','#325A49','#F1F2E9','#373737','#41361D']
		},
		{
			name: 'Lichen', 
			author: 'Christophe Aubry', 
			url: 'lichen/605/', 
			authUrl: 'http://www.netplume.net/',	
			colors: ['#354037','#62736F','#62736F','#354037','#A8B8AC','#26140D','#FFFFFF','#97A69E','#26140D']
		},
		{
			name: 'Java Blue', 
			author: 'Christophe Aubry', 
			url: 'javablue-admin-theme/597/', 
			authUrl: 'http://www.netplume.net/', 
			colors: ['#375D81','#6A8BAB','#375D81','#375D81','#6A8BAB','#D7E8F7','#D7E8F7','#375D81','#375D81']
		},
		{ 
			name: 'Simple Black',
			author: 'Chris Cagle',
			url: 'simple-black/134/',
			authUrl: 'http://www.cagintranet.com/',
			colors: ['#444444','#111111','#333333','#333333','#333333','#E8EDF0','#E3E3E3','#9F2C04','#CF3805']
		},
		{
			name: 'Nightmare', 
			author: 'AmBo Batpyiiikob', 
			url: 'nightmare/853/',	
			colors: ['#000000','#000000','#777777','#3366CC','#F1F2E9','#FFFFFF','#FFFFFF','#336699','#336699']
		},
		{
			name: 'Metro Goldwyn Mayer', 
			author: 'Kevin Van Lierde', 
			url: 'metro-goldwyn-mayer/944/', 
			authUrl: 'http://webketje.com', 
			colors: ['#332926','#473933','#957148','#957148','#E5CF8E','#6C5546','#E5D4A2','#000000','#825E35']
		},
		{
			name: 'Sunset', 
			author: 'Kevin Van Lierde', 
			url: 'sunset/945/', 
			authUrl: 'http://webketje.com', 
			colors: ['#46625D','#4E6F66','#FBB779','#4F6C64','#F8EEB2','#4E6F66','#FFFBE2','#F27146','#F27146']
		}
	];
	
	// IE8 polyfills
	function addEvent(element, event, listener) {
		var element = document.getElementById(element);
	  if (element.attachEvent)
	    element.attachEvent('on' + event, listener);
	  else if (element.addEventListener)
			element.addEventListener(event, listener, false);
	}
	function getElementsByClass(selector) {
		if (document.getElementsByClassName)
			return document.getElementsByClassName(selector);
		else if (document.querySelectorAll)
			return document.querySelectorAll('.' + selector);
	}
	
	// simple output function for the preset list
	function buildPresets() {
		var parent = document.getElementById('admin-theme-presets'), row, col, color;
		for (var i = 0; i < presets.length; i++) {
		
			row = document.createElement('div');
			col = document.createElement('span');
			var input = document.createElement('input');
			input.type = 'radio';
			input.name = 'admin-theme-presets';
			col.innerHTML = '<a href="http://get-simple.info/extend/admin-theme/' + presets[i].url + '">' + presets[i].name + '</a> ' + pluginLang[1] + ' ' + (presets[i].authUrl ? '<a href="' + presets[i].authUrl + '">' + presets[i].author + '</a>' : presets[i].author);
			row.appendChild(input);
			row.appendChild(col);
			
			for (var j = 0; j < presets[i].colors.length; j++) {
				color = document.createElement('span');
				color.style.backgroundColor = presets[i].colors[j];
				row.appendChild(color);
			}
			parent.appendChild(row);
		}
	}
	function generateAdminXMLData(data) {
	
		var tree = {node: 'item', children: [
	    {node: 'title',  content: 'Custom Admin Theme'},
	    {node: 'author', content: ''},
	    {node: 'link',   content: ''}, 
	    {node: 'primary', children: [
	      {node: 'darkest', content: pri[0].value(),  comment: 'tab hover background, link hover'},
	      {node: 'darker',  content: pri[1].value(),  comment: 'non-active tab background, active main tab text hover'},
	      {node: 'dark',    content: pri[2].value(),  comment: 'header bottom fade color'},
	      {node: 'middle',  content: pri[3].value(),  comment: 'separators, active main tab text'},
	      {node: 'light',   content: pri[4].value(),  comment: 'header top fade color'},
	      {node: 'lighter', content: pri[5].value(),  comment: 'site name link color'},
	      {node: 'lightest',content: pri[6].value(),  comment: 'non-active tab text, separators'}
	    ]},
	    {node: 'secondary', children: [
	      {node: 'darkest', content: sec[0].value(),  comment: 'side tab active shadow'},
	      {node: 'lightest',content: sec[1].value(),  comment: 'side tab active background, page subtitles'}
	    ]}
	  ]},
	  output = '<?xml version="1.0"?>\n<!--\n\n\n\tThis XML document is meant to change the colors within the GetSimple 3.0 Administrative Console\n\t******************************************************************************************************\n\tA few things to make note of:\n\t\t1. There are a couple images within `/admin/template/images` that might need to change as a result\n\t\t2. This is to be placed in the root of `/themes/` as `admin.xml`\n\t\t3. Colors need the hash in front of the numbers. eg: #333333\n\t\t4. Do not use shortcut hex values. eg. #333\n\t\t5. Only works with GetSimple version 3.0\n\n-->';
	  
	  if (data.name)
	    tree.children[0].content = data.name;
	  if (data.author)
	    tree.children[1].content = data.author;
	  if (data.link)
	    tree.children[2].content = data.link;
	  
		function iterateAdminXMLTree(node, indent) {
		  var indent = indent || 1, count = 0, tabs = '';
		  while (count < indent) {
		    tabs += '\t';
		    count++;
		  }
		  output += '\n' + tabs + '<' + node.node + '>';
	    if (node.comment) 
	      output += '\n' + tabs + '<!-- ' + node.comment + ' -->\n' + tabs;
		  if (node.children) {
		    indent++;
		    for (var i = 0; i < node.children.length; i++) 
		      iterateAdminXMLTree(node.children[i], indent);
		    indent--;
		    output += '\n' + tabs;
		  } else {
		    if (node.comment) 
		      output += tabs + node.content + '\n' + tabs;
		    else
		      output += node.content;
		  }
		  output += '</' + node.node + '>';
		}
	
	  iterateAdminXMLTree(tree, output);
	  return output;
	}
	function genPreview() {
	
		var replaceArr = colorsArr(), style, output = ['.header {  border-top: 1px solid $color_1;  background: $color_3;',
	    'background: -moz-linear-gradient(top, $color_4 0%, $color_2 100%);',
	    'background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,$color_4), color-stop(100%,$color_2));',
	    'filter: progid: DXImageTransform.Microsoft.gradient( startColorstr=\'$color_4\', endColorstr=\'$color_2\',GradientType=0 );}',
	    '.wrapper .nav li a:link, .wrapper .nav li a:visited, .wrapper #pill li a:link, .wrapper #pill li a:visited {  color: $color_6;  background: $color_1;}',
	    '.wrapper #pill li.debug a:link,.wrapper #pill li.debug a:visited,.wrapper #pill li.debug a:hover {  border-left: 1px solid $color_3;}',
	    '#edit .wrapper .nav li a.pages,#pages .wrapper .nav li a.pages,#menu-manager .wrapper .nav li a.pages,#plugins .wrapper .nav li a.plugins,',
	    '#settings .wrapper .nav li a.settings,#components .wrapper .nav li a.theme,#theme .wrapper .nav li a.theme,#sitemap .wrapper .nav li a.theme,',
	    '#theme-edit .wrapper .nav li a.theme,#navigation .wrapper .nav li a.theme,#upload .wrapper .nav li a.files,#image .wrapper .nav li a.files,',
	    '#backups .wrapper .nav li a.backups,#support .wrapper .nav li a.support,#log .wrapper .nav li a.support,#health-check .wrapper .nav li a.support,',
	    '#backup-edit .wrapper .nav li a.backups,#archive .wrapper .nav li a.backups, #load .wrapper .pages li a.pages,#load .wrapper .plugins li a.plugins,',
	    '#load .wrapper .settings li a.settings,#load .wrapper .theme li a.theme,#load .wrapper .files li a.files,#load .wrapper .backups li a.backups,',
	    '#load  .wrapper .support li a.support,#load .wrapper .nav li a.current,#loadtab .wrapper .nav li a.current {  color: $color_1;}',
	    '.wrapper .nav li a:active, .wrapper .nav li a:focus, .wrapper .nav li a:hover, .wrapper #pill li a:hover, .wrapper #pill li a:focus {  background: $color_0;}',
	    '.wrapper .nav li.rightnav a.first {  border-left: 1px solid $color_3;} .wrapper< #pill li.leftnav a {  border-left: 1px solid $color_3;}',
	    '.wrapper a:link, .wrapper a:visited {color: $color_3;} .header h1 {  text-shadow: 1px 1px 0px $color_2;}',
	    '.header h1 a:link,.header h1 a:visited,.header h1 a:hover {color: $color_5;} h3 {color: $color_8;} h3.floated {  color: $color_8;}',
	    '#sidebar .snav li a:link, #sidebar .snav li a:visited {  color: $color_6;  background: $color_1;  text-shadow: 1px 1px 0px $color_0;}',
	    '#sidebar .snav li.current a {text-shadow: 1px 1px 0px $color_7; background: $color_8 url(\'template/images/active.png\') center left no-repeat !important;}',
	    '#sidebar .snav li a.current {  background: $color_8 url(\'images/active.png\') center left no-repeat !important;text-shadow: 1px 1px 0px $color_7;}',
	    '#sidebar .snav li a.current:hover {  text-shadow: 1px 1px 0px $color_7;  background: $color_8 url(\'images/active.png\') center left no-repeat !important;}',
	    '#sidebar .snav li a:hover {  background: $color_0;} .edit-nav a:link, .edit-nav a:visited {  background-color: $color_1;}',
	    '.edit-nav a:hover, #sidebar .edit-nav a:hover, .edit-nav a.current { background-color: $color_8;} .popup table a:link, .popup table a:visited {color: $color_3;}',
	    '.wrapper a.component:hover { color: $color_6; background: $color_1;  border: 1px solid $color_0;}',
	    '.wrapper .secondarylink a:hover {  background: $color_3;} .uploadifyProgressBar {  background-color: $color_6;} #sidebar .snav li.upload {background: $color_1;}'].join('');
	    
	  if (!document.getElementById('adminxml-plus-styles')) {
			style = document.createElement('style');
			style.id = 'adminxml-plus-styles';
			document.head.appendChild(style);
		}
		
	  for (var i = 0; i < replaceArr.length; i++) {
	    output = output.replace(new RegExp('\\$color_' + i, 'g'), replaceArr[i]);
	  }
	  document.getElementById('adminxml-plus-styles').innerHTML = output;
	}
	function setLang() {
		var fs = document.getElementById('cs-render-bottom').getElementsByTagName('fieldset');
		fs[0].getElementsByTagName('legend')[0].textContent = pluginLang[0];
		fs[0].getElementsByTagName('button')[0].textContent = pluginLang[2];
		fs[1].getElementsByTagName('legend')[0].textContent = pluginLang[3];
		fs[1].getElementsByTagName('label')[0].textContent = pluginLang[4];
		fs[1].getElementsByTagName('label')[1].textContent = pluginLang[5];
		fs[1].getElementsByTagName('label')[2].textContent = pluginLang[6];
		fs[1].getElementsByTagName('button')[0].textContent = pluginLang[7];
	}
	function init() {
		var settings = getElementsByClass('setting').length ? getElementsByClass('setting') : getElementsByClass('ko-list-item');
		buildPresets();
		genPreview();
		setLang();
		
		// hack Knockout to make sure the preview is updated on any color change
		var allColors = ko.computed(function(){	return colorsArr();	});
		allColors.subscribe(genPreview);
		
		document.getElementById('themegen-auth').value = GSCS.returnSetting('adminxml_plus','theme_gen_author').value();
		document.getElementById('themegen-auth-url').value = GSCS.returnSetting('adminxml_plus','theme_gen_link').value();
		// adminXML export generator
		addEvent('admin-xml-export','click', function() { 
			var obj = {
				author: document.getElementById('themegen-auth').value,
				link: document.getElementById('themegen-auth-url').value,
				name: document.getElementById('themegen-name').value
			};
			
			GSCS.returnSetting('adminxml_plus','theme_gen_author').value(document.getElementById('themegen-auth').value);
			GSCS.returnSetting('adminxml_plus','theme_gen_link').value(document.getElementById('themegen-auth-url').value);
			
			saveTextAs(generateAdminXMLData(obj), 'admin.xml'); 
		});
		
		// save the current theme to admin.xml
		addEvent('cs-save', 'click', function() { 
			var colors = colorsArr(), obj = {
				author: document.getElementById('themegen-auth') ? document.getElementById('themegen-auth').value : 'Custom admin Theme',
				link: document.getElementById('themegen-auth-url') ? document.getElementById('themegen-auth-url').value : '',
				name: document.getElementById('themegen-name') ? document.getElementById('themegen-name').value : '' 
			};
			for (var i = 0; i < presets.length; i++) {
				if (presets[i].colors.join(',') === colors.join(',')) {
					obj = {
						author: presets[i].author,
						link: presets[i].authUrl || '',
						name: presets[i].name
					};
				}
			}
			$.ajax({
				type: 'POST',
	      url: '../plugins/adminxml_plus/adminxml_save.php',
	      data: {admin_theme_data: generateAdminXMLData(obj) }
			});
		});
		
		// preset setter
		addEvent('admin-theme-set', 'click', function() {
			var index = -1, radio = document.getElementsByName('admin-theme-presets'),
					settings = colorsArr(true);
			for (var i = 0; i < radio.length; i++) {
				if (radio[i].checked) index = i;
			}
			if (index > -1) {
				for (var i = 0; i < settings.length; i++) {
					settings[i](presets[index].colors[i]);
				}
			}
			GS.notifier(pluginLang[8], 'notify', null, 'medium');
		});
	}
	return init;
};

// hook into GS Custom Settings
addHook('adminxml_plus', { 
	init: function() { adminThemer(GSCS)(); }, 
	update: function() { document.getElementById('adminxml-plus-styles').innerHTML = document.getElementById('adminxml-plus-styles').innerHTML.slice(2,document.getElementById('adminxml-plus-styles').innerHTML.length-3); },
	dispose: function() { document.getElementById('adminxml-plus-styles').innerHTML = '/*' + document.getElementById('adminxml-plus-styles').innerHTML + '*/'; }
});