
<!-- START web page layout -->
<? $yunlist = json_decode($result, true); ?>

<table style="width:99%; margin: 0 auto">
	<td style="width:33%" valign="top">
		<table style="width:100%" border="0" >
			<tr style="height:50%">
				<h2>List all boards</h2>
				<td>
					<h3>Connected</h3>
					<select id="yunlist_c" multiple="multiple" size="5">
						<? foreach ($yunlist["list"] as $board): ?>
							<? if ($board["status"] == "C"): ?>
								<option value="<?=$board["board_code"]?>"> <?=$board["board_code"]?> </option>
							<? endif ?>
						<? endforeach ?>
					</select>
				</td>
			</tr>
			<tr style="height:50%">
				<td>
					<h3>Disconnected</h3>
					<? if (sizeof($yunlist["list"]) > 0): ?>
						<? foreach ($yunlist["list"] as $board): ?>
							<? if ($board["status"] == "D"): ?>
								<?= $board["board_code"] ?> <br/>
							<? endif ?>
						<? endforeach ?>
					<? endif ?>
				</td>
			</tr>
		</table>
	</td>
	<td style="width:67%">
		<table border="0" style="width:100%" >
			<tr style="height:25%">
				<h2>Commands</h2>
				<td>
					<h3>PIN Management</h3>
                                        <button class="button tiny radius" value="1" onclick="led_action(this)">LED ON</button>
                                        <button class="button tiny radius" value="0" onclick="led_action(this)">LED OFF</button>

				</td>
			</tr>
			<tr style="height:25%">
				<td>
					<h3>Services</h3>
					<button class="button tiny radius" id="sshstart">SSH START</button>
					<button class="button tiny radius" id="sshstop">SSH STOP</button>
				</td>
			</tr>
			<tr style="height:25%">
				<td>
					<h3>Plugin Management</h3>
					<button class="button tiny radius" data-reveal-id="modal-create-plugin">Create Plugin</button>
					<button class="button tiny radius" data-reveal-id="modal-inject-plugin">Inject Plugin</button>
					<button class="button tiny radius" data-reveal-id="modal-run-plugin">Run Plugin</button>
					<!-- <button class="button tiny radius" data-reveal-id="modal-call-plugin">Call Plugin</button> -->
					<button class="button tiny radius" data-reveal-id="modal-kill-plugin">Kill Plugin</button>
				</td>
			</tr>
			<!--
			<tr style="height:25%">
				<td>
					<h3>Extras</h3>
					<button class="button tiny radius" onclick="window.open('http://smartme-data.unime.it/dataset/14141414')">CKAN</button>
				</td>
			</tr>
			-->
		</table>
	</td>
</table>
<h1>
 <fieldset>
  <legend>Output</legend>
	<p id="output" />
 </fieldset>
</h1>
<!-- STOP web page layout -->



<!-- START modal section -->
<div id="modal-create-plugin" class="reveal-modal small" data-reveal>
        <section>
                <h3>Create Plugin</h3>
		<a class="close-reveal-modal"aria-label="Close">&#215;</a>
                   <fieldset>
                        <legend>Plugin Management</legend>
                        <div class="row">
                                <label>Plugin Name
                                        <input id="create_plugin_name" type="text" placeholder="Plugin Name" name="name" value="" />
                                </label>
				<label>Plugin Json
					<textarea id="create_plugin_json" placeholder="Insert here the json" name="text" rows="5"></textarea>
				</label>
                                <label>Javascript Code
					<input type="file" name="userfile" id="userfile" size="20" />
                                        <textarea id="create_plugin_code" placeholder="Insert here the code" name="text" rows="15"></textarea>
                                </label>
                        </div>
                   </fieldset>
                   <div class="row">
                    <div class="large-12 columns">
                        <button id="create_plugin" class="button tiny radius">
                            Send
                        </button>
                    </div>
                   </div>
        </section>
</div>


<div id="modal-inject-plugin" class="reveal-modal small" data-reveal>
        <section>
                <h3>Inject Plugin</h3>
		<a class="close-reveal-modal"aria-label="Close">&#215;</a>
                   <fieldset>
                        <legend>Plugin Management</legend>
                        <div class="row">
                                <label>Plugin Name
                                        <input id="inject_plugin_name" type="text" placeholder="Plugin Name" name="name" value="" />
                                </label>
                                <label>Board List
                                <select id="inject_yunlist" multiple="multiple" size="5">
                                        <? foreach ($yunlist["list"] as $board): ?>
						<? if ($board["status"] == "C"): ?>
	                                                <option value="<?=$board["board_code"]?>"> <?=$board["board_code"]?> </option>
						<? endif ?>
                                        <? endforeach ?>
                                </select>
                                </label>
				<label>Autostart
					<select id="inject_autostart">
						<option value="true">True</option>
						<option value="false">False</option>
					</select>
				</label>
                        </div>
                   </fieldset>
                   <div class="row">
                    <div class="large-12 columns">
                        <button id="inject_plugin" class="button tiny radius">
                            Send
                        </button>
                    </div>
                   </div>
        </section>
</div>

<div id="modal-run-plugin" class="reveal-modal small" data-reveal>
        <section>
                <h3>Run Plugin</h3>
		<a class="close-reveal-modal"aria-label="Close">&#215;</a>
                   <fieldset>
                        <legend>Plugin Management</legend>
                        <div class="row">
                                <label>Plugin Name
                                        <input id="run_plugin_name" type="text" placeholder="Plugin Name" name="name" value="" />
                                </label>
                                <label>Board List
                                <select id="run_yunlist">
                                        <? foreach ($yunlist["list"] as $board): ?>
						<? if ($board["status"] == "C"): ?>
	                                                <option value="<?=$board["board_code"]?>"> <?=$board["board_code"]?> </option>
						<? endif ?>
                                        <? endforeach ?>
                                </select>
				<!--
				<select id="run_plugin_category">
					<option value="call">call</option>
					<option value="daemon">daemon</option>
				</select>
				-->
                                </label>
                                <label>Plugin Json
                                        <textarea id="run_plugin_json" placeholder="Insert here the json" name="text" rows="10"></textarea>
                                </label>
                        </div>
                   </fieldset>
                   <div class="row">
                    <div class="large-12 columns">
                        <button id="run_plugin" class="button tiny radius">
                            Send
                        </button>
                    </div>
                   </div>
        </section>
</div>
<!--
<div id="modal-call-plugin" class="reveal-modal small" data-reveal>
	<section>
		<h3>Call Plugin</h3>
		<a class="close-reveal-modal"aria-label="Close">&#215;</a>
		<fieldset>
			<legend>Plugin Management</legend>
			<div class="row">
				<label>Plugin Name
					<input id="call_plugin_name" type="text" placeholder="Plugin Name" name="name" value="" />
				</label>
				<label>Board List
					<select id="call_yunlist">
						<? foreach ($yunlist["list"] as $board): ?>
							<? if ($board["status"] == "C"): ?>
								<option value="<?=$board["board_code"]?>"> <?=$board["board_code"]?> </option>
							<? endif ?>
						<? endforeach ?>
					</select>
					<select id="call_plugin_category">
						<option value="call">call</option>
						<option value="daemon">daemon</option>
					</select>
				</label>
				<label>Plugin Json
					<textarea id="call_plugin_json" placeholder="Insert here the json" name="text" rows="10"></textarea>
				</label>
			</div>
		</fieldset>
		<div class="row">
			<div class="large-12 columns">
				<button id="call_plugin" class="button tiny radius">
					Send
				</button>
			</div>
		</div>
	</section>
</div>
-->
<div id="modal-kill-plugin" class="reveal-modal small" data-reveal>
        <section>
                <h3>Kill Plugin</h3>
		<a class="close-reveal-modal"aria-label="Close">&#215;</a>
                   <fieldset>
                        <legend>Plugin Management</legend>
                        <div class="row">
                                <label>Plugin Name
                                        <input id="kill_plugin_name" type="text" placeholder="Plugin Name" name="name" value="" />
                                </label>
                                <label>Board List
                                <select id="kill_yunlist" multiple="multiple" size="5">
                                        <? foreach ($yunlist["list"] as $board): ?>
						<? if ($board["status"] == "C"): ?>
	                                                <option value="<?=$board["board_code"]?>"> <?=$board["board_code"]?> </option>
						<? endif ?>
                                        <? endforeach ?>
                                </select>
                                </label>
                        </div>
                   </fieldset>
                   <div class="row">
                    <div class="large-12 columns">
                        <button id="kill_plugin" class="button tiny radius">
                            Send
                        </button>
                    </div>
                   </div>
        </section>
</div>
<!-- STOP modal section -->


<!-- START script section -->
<script>
	var delay = 5000;


	function led_action(button){

		if ($('#yunlist_c option:selected').length == 0) { alert('Select a Board'); }
		else {
			var list = document.getElementById("yunlist_c");
			var selected_list = [];
			var output_string = '';
			document.getElementById("output").innerHTML ='';
			var value = button.value;

			for(var i=0; i< list.length; i++){
				if (list.options[i].selected)
					selected_list.push(list[i].value);
			}

			for(var i=0; i< selected_list.length; i++){
				//---------------------------------------------------------------------------------
				(function(i){
					setTimeout(function(){
				//---------------------------------------------------------------------------------
						var board_id = selected_list[i];
						$.ajax({
							url: '<?= $this -> config -> site_url()?>index.php/Yun/led_management',
							type: 'GET',
							dataType: 'json',
							data: {board: board_id, command: 'digital', pin: '13', val: value},
							contentType: 'application/json',
							success: function(response){
								//alert(JSON.stringify(response));
								document.getElementById("output").innerHTML += board_id +': '+JSON.stringify(response) +'<br />';
							},
							error: function(response){
								alert(JSON.stringify(response));
								//document.getElementById("output").innerHTML += board_id +': '+response.responseText +'<br />';
							}
						});
				//---------------------------------------------------------------------------------
					},delay*i);
				})(i);
				//---------------------------------------------------------------------------------
			}

		} //end else
	}


	$('#sshstart').click(function(){

		if ($('#yunlist_c option:selected').length == 0) { alert('Select a Board'); }
		else {

			var list = document.getElementById("yunlist_c");
			var selected_list = [];

                        for(var i=0; i< list.length; i++){
                                if (list.options[i].selected)
                                        selected_list.push(list[i].value);
                        }

			for(var i=0; i< selected_list.length; i++){

			//var board_id =$('#yunlist_c').val();
			var board_id = selected_list[i];
			$.ajax({
				url: '<?= $this -> config -> site_url()?>index.php/Yun/ssh_management',
				type: 'GET',
				dataType: 'json',
				data: {board: board_id, command: 'start'},
				contentType: 'application/json',
				success: function(response){
					//alert(JSON.stringify(response));
					document.getElementById("output").innerHTML = JSON.stringify(response);
				},
				error: function(response){
					alert(JSON.stringify(response));
					//document.getElementById("output").innerHTML = response.responseText;
				}
			});
			}
		} //end else
	});


	$('#sshstop').click(function(){

		if ($('#yunlist_c option:selected').length == 0) { alert('Select a Board'); }
		else {
			//var board_id =$('#yunlist_c').val();
                        var list = document.getElementById("yunlist_c");
                        var selected_list = [];

                        for(var i=0; i< list.length; i++){
                                if (list.options[i].selected)
                                        selected_list.push(list[i].value);
                        }

                        for(var i=0; i< selected_list.length; i++){
			var board_id = selected_list[i];

			$.ajax({
				url: '<?= $this -> config -> site_url()?>index.php/Yun/ssh_management',
				type: 'GET',
				dataType: 'json',
				data: {board: board_id, command: 'stop'},
				contentType: 'application/json',
				success: function(response){
					//alert(JSON.stringify(response));
					document.getElementById("output").innerHTML = JSON.stringify(response);
				},
				error: function(response){
					alert(JSON.stringify(response));
					//document.getElementById("output").innerHTML = response.responseText;
				}
			});
			}
		} //end else
	});


	$('#create_plugin').click(function(){

		var plugin_name = document.getElementById("create_plugin_name").value;
		var plugin_json = document.getElementById("create_plugin_json").value;
		var plugin_code = document.getElementById("create_plugin_code").value;

		$.ajax({
			url: '<?= $this -> config -> site_url()?>index.php/Yun/create_plugin',
			type: 'GET',
			dataType: 'json',
			data: {plugin_name : plugin_name, plugin_json: plugin_json, plugin_code: plugin_code},
			contentType: 'application/json',
			success: function(response){
				//alert(JSON.stringify(response));
				document.getElementById("output").innerHTML = JSON.stringify(response);
			},
			error: function(response){
				alert(JSON.stringify(response));
				//document.getElementById("output").innerHTML = response.responseText;
			}
		});
	});

	function readSingleFile(evt) {
        	//Retrieve the first (and only!) File from the FileList object
	        var f = evt.target.files[0]; 

        	if (f) {
                	var r = new FileReader();
	                r.onload = function(e) { 
        	                var contents = e.target.result;
                	        //alert('contents: '+contents);
                        	document.getElementById("create_plugin_code").innerHTML = contents;
	                }
        	        r.readAsText(f);
	        }
		else { alert("Failed to load file"); }
	}

  document.getElementById('userfile').addEventListener('change', readSingleFile, false);


	$('#inject_plugin').click(function(){

		if ($('#inject_yunlist option:selected').length == 0) { alert('Select a Board'); }
		else {
			var list = document.getElementById("inject_yunlist");
			var selected_list = [];
			var output_string = '';

			document.getElementById("output").innerHTML ='';
			var plugin_name = document.getElementById("inject_plugin_name").value;
			var inject_autostart = document.getElementById("inject_autostart").value;

			//for(var i=0; i<$('#inject_yunlist option:selected').length; i++){
			for(var i=0; i< list.length; i++){
				if (list.options[i].selected)
					selected_list.push(list[i].value);
			}

			for(var i=0; i< selected_list.length; i++){
				var board_id = selected_list[i];
				//---------------------------------------------------------------------------------		
				(function(i){
					setTimeout(function(){
				//---------------------------------------------------------------------------------
						$.ajax({
							url: '<?= $this -> config -> site_url()?>index.php/Yun/inject_plugin',
							type: 'GET',
							dataType: 'json',
							data: {plugin_name : plugin_name, board: board_id, inject_autostart: inject_autostart},
							contentType: 'application/json',
							success: function(response){
								//alert(JSON.stringify(response));
								document.getElementById("output").innerHTML += board_id +': '+JSON.stringify(response) +'<br />';
							},
							error: function(response){
								alert(JSON.stringify(response));
								//document.getElementById("output").innerHTML += board_id +': '+response.responseText +'<br />';
							}
						});
				//---------------------------------------------------------------------------------
					},delay*i);
				})(i);
				//---------------------------------------------------------------------------------
			}
		}
	});



	$('#run_plugin').click(function(){

		if ($('#run_yunlist option:selected').length == 0) { alert('Select a Board'); }
		else {

			var plugin_name = document.getElementById("run_plugin_name").value;
			var plugin_json = document.getElementById("run_plugin_json").value;
			//var plugin_category = document.getElementById("run_plugin_category").value;
			//var plugin_category = 'async';

			var board_id =$('#run_yunlist').val();

			$.ajax({
				url: '<?= $this -> config -> site_url()?>index.php/Yun/run_plugin',
				type: 'GET',
				dataType: 'json',
				//data: {plugin_name : plugin_name, board: board_id, plugin_json: plugin_json, plugin_category: plugin_category},
				data: {plugin_name : plugin_name, board: board_id, plugin_json: plugin_json},
				contentType: 'application/json',
				success: function(response){
					//alert(JSON.stringify(response));
					document.getElementById("output").innerHTML = JSON.stringify(response);
				},
				error: function(response){
					alert(JSON.stringify(response));
					//document.getElementById("output").innerHTML = response.responseText;
				}
			});
		}
	});


	$('#call_plugin').click(function(){

		if ($('#call_yunlist option:selected').length == 0) { alert('Select a Board'); }
		else {

			var plugin_name = document.getElementById("call_plugin_name").value;
			var plugin_json = document.getElementById("call_plugin_json").value;
			//var plugin_category = document.getElementById("call_plugin_category").value;
			var plugin_category = 'sync';

			var board_id =$('#call_yunlist').val();

			$.ajax({
				url: '<?= $this -> config -> site_url()?>index.php/Yun/call_plugin',
				type: 'GET',
				dataType: 'json',
				data: {plugin_name : plugin_name, board: board_id, plugin_json: plugin_json, plugin_category: plugin_category},
				contentType: 'application/json',
				success: function(response){
					//alert(JSON.stringify(response));
					document.getElementById("output").innerHTML = JSON.stringify(response);
				},
				error: function(response){
					alert(JSON.stringify(response));
					//document.getElementById("output").innerHTML = response.responseText;
				}
			});
		}
	});


	$('#kill_plugin').click(function(){

		if ($('#kill_yunlist option:selected').length == 0) { alert('Select a Board'); }
		else {

			var list = document.getElementById("kill_yunlist");
			var selected_list = [];

			var plugin_name = document.getElementById("kill_plugin_name").value;
			var board_id =$('#kill_yunlist').val();

			for(var i=0; i< list.length; i++){
				if (list.options[i].selected)
					selected_list.push(list[i].value);
			}

			for(var i=0; i< selected_list.length; i++){
				var board_id = selected_list[i];

				//---------------------------------------------------------------------------------             
				(function(i){
					setTimeout(function(){
				//---------------------------------------------------------------------------------
						$.ajax({
							url: '<?= $this -> config -> site_url()?>index.php/Yun/kill_plugin',
							type: 'GET',
							dataType: 'json',
							data: {plugin_name : plugin_name, board: board_id},
							contentType: 'application/json',
							success: function(response){
								//alert(JSON.stringify(response));
								document.getElementById("output").innerHTML = JSON.stringify(response);
							},
							error: function(response){
								alert(JSON.stringify(response));
								//document.getElementById("output").innerHTML = response.responseText;
							}
						});
				//---------------------------------------------------------------------------------
					},delay*i);
				})(i);
				//---------------------------------------------------------------------------------
			}
		}
	});
</script>


<!-- STOP script section -->
