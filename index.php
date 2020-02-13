<html>
	<head>
		<style>
			body{
				margin:0;
				padding:0;
				background-image:url("./TESTIMAGES/groupwallnc.jpg");
				background-repeat:no-repeat;
				background-position:center;
				background-size:cover;
				font-family:"Arial Black", Gadget, sans-serif;
			}
			#filter{
				margin:0;
				padding:0;
				background-color:white;
				opacity:.4;
				position:absolute;
				top:10%;
				width:100%;
				height:80%;
				z-index:-2;
			}
			.main_spacers{
				margin:0;
				padding:0;
				height:10%;
				width:100%;
				z-index:-1;
			}
			#main_wrapper{
				margin:0;
				padding:0;
				height:80%;
				width:100%;
				z-index:-1;
				opacity:1;
			}
			#main_wrapper:hover{
				opacity:1;
			}
			#main_wrapper p{
				margin:0;
				padding:0;
			}
			.main_wrapper_blocks{
				margin:0;
				padding:0;
				height:70%;
				width:33.33%;
				float:left;
			}
			@media only screen and (min-width: 1900px){
				#top{
					margin:0;
					padding:0;
					width:100%;
					height:30%;
					text-align:center;
				}
				.date{
					margin:0;
					padding:0;
					color:black;
					font-size:3em;
				}
				.time{
					margin:0;
					padding:0;
					color:black;
					font-size:3em;
				}
				.welcome{
					margin:0;
					padding:0;
					color:black;
					font-size:5em;
				}
				#main_wrapper_left{
					text-align: center;
				}
				#main_wrapper_left button{
					margin:0;
					padding:0;
					width:100px;
					height:50px;
				}
				#main_wrapper_center{
					text-align:center;
				}
				#main_wrapper_right{
					overflow-y:scroll;
				}
				#addToDo{
					margin:40px 0 0 40px;
					padding:0;
					height:50px;
					width:80%;
					font-size:2.5em;
					float:left;
				}
				#enterToDo{
					margin:40px 0 0 0;
					padding:0;
					height:50px;
					width:30px;
					font-size:2.5em;
					float:left;
				}
				#main_wrapper_center ul{
					margin:30px 0 0 0;
					padding:0;
					list-style-type:none;
					text-align:center;
				}
				#main_wrapper_center li{
					margin:auto;
					padding:0;
					font-size:2.5em;
					float:left;
				}
				.check{
					margin:auto;
					padding:0;
					font-size:2.5em;
					cursor:pointer;
					float:left;
				}
				#uploading_background_files{
					margin:40px 0 0 40px;
					padding:0;
				}
				#uploading_background_files .files{
					margin:0;
					padding:0;
					width:auto;
					height:50px;
				}
				#directory_wrapper{
					margin:40px 0 0 40px;
					padding:0;
				}
				#picname{
					margin:0 40px 0 0;
					padding:0;
					text-align:right;
					font-size:3em;
					color:white;
				}
			}
		</style>
	</head>

	<body>
		<div id="filter">
		</div>
		<div id="top_spacer" class="main_spacers">
		</div>
		<div id="main_wrapper">
			<div id="top">
				<div id="main_wrapper_headings">
					<p id="date" class="date">Date</p>
					<p id="welcome" class="welcome">Welcome Anthony</p>
					<p id="time" class="time">Time</p>
				</div>
			</div>
			<div id="main_wrapper_left" class="main_wrapper_blocks">
				<div id="uploading_background_files">
					<form method="POST" action="/insertBackgroundImage.php" enctype="multipart/form-data">
						<input class="files" type="file" name="insertBackgroundPicture[]" multiple="multiple"/>
						<button name="submitBackgroundPictures">Upload</button>
					</form>
				</div>
				<button name="backgroundChange" onclick="imageContent()">Change Background</button>

				<div id="holder">
				</div>
			</div>
			<div id="main_wrapper_center" class="main_wrapper_blocks">
				<input id="addTodo" name="addTodo" placeholder="Add new todo" />
				<button id="enterToDo" name="enterToDo"> > </button>
				<br style="clear:both">
				<ul>
					<button class="check" name="check"> :) </button>
					<li>Item 1</li>
					<br style="clear:both"/>
					<button class="check" name="check"> :) </button>
					<li>Item 2</li>
					<br style="clear:both"/>
					<button class="check" name="check"> :) </button>
					<li>Item 3</li>
					<br style="clear:both"/>
					<button class="check" name="check"> :) </button>
					<li>Item 4</li>
					<br style="clear:both"/>
				</ul>
			</div>
			<div id="main_wrapper_right" class="main_wrapper_blocks">
				<button name="gettingDirectory" onclick="getDirectory()">Retreive Directory</button>
				<div id="directory_wrapper">
				</div>
			</div>
		</div>
		<div id="bottom_spacer" class="main_spacers">
			<p id="picname">@groupwallnc.jpg</p>
		</div>

		<script>		

			function sendToDo(){

			}	

			function getDirectory(){
				var xhttp;
				var directoryContainer = document.querySelector('#directory_wrapper');

				xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function(){
					if(this.readyState == 4 && this.status == 200){
						var response = JSON.parse(this.responseText);
						directoryContainer.innerHTML = response.fruit[0][0];
					}
				};

				xhttp.open("GET", "returnDirectory.php", true);
				xhttp.send();
			}

			function dateTimeContent(){
				var xhttp;
				var dateContainer = document.querySelector("#date");
				var timeContainer = document.querySelector("#time");
				var welcomeContainer = document.querySelector("#welcome");

				xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function(){
					if(this.readyState == 4 && this.status == 200){
						var response = JSON.parse(this.responseText);
						dateContainer.innerText = response.date;
						timeContainer.innerText = response.time;
						welcomeContainer.innerText = response.welcome;
					}
				};

				xhttp.open("GET", "returnDateTime.php", true);
				xhttp.send();
			}

			function imageContent(){
				var xhttp;
				var body = document.querySelector("body");
				var currentUrl = getComputedStyle(body).backgroundImage;
				var regex = "([a-zA-Z0-9-_]*\\.)([a-zA-Z0-9-_]*\\.)*(jpg|png)";
				var pattern = new RegExp(regex);
				var x;

				if(pattern.test(currentUrl)){
					x = pattern.exec(currentUrl)[0];
					
					xhttp = new XMLHttpRequest();
					xhttp.onreadystatechange = function(){
						if(this.readyState == 4 && this.status == 200){
							var response = JSON.parse(this.responseText);
							body.style.backgroundImage = response.url;
							document.querySelector("#picname").innerText = 
								"@" + response.afterPicName;
							;
						}
					};
					xhttp.open("GET", "returnBackgroundImage.php?picture="+x, true);
					xhttp.send();
				} else{
					console.log("No matches");
					return;
				}
			}

			function tellTime(){
				var now = new Date();
				var time = "";


				(now.getHours() < 13) ? time += now.getHours() : time += now.getHours() - 12;
				time += ":";
				time += now.getMinutes();
				time += ":";
				time += now.getSeconds();
				document.querySelector("#time").innerText = time; 
				welcomeMessage(now.getHours());
			}

			function tellDate(){
				var now = new Date();
				var date = "";
				date += now.getMonth();
				date += "/";
				date += now.getDate();
				date += "/";
				date += now.getFullYear();
				document.querySelector("#date").innerText = date;

			}
			function welcomeMessage(hours){
				if(hours <= 5){
					document.querySelector("#welcome").innerText = "Up early aren't we Anthony";
				} else if(hours > 5 && hours < 11){
					document.querySelector("#welcome").innerText = "Good Morning Anthony";
				} else if(hours > 11 && hours < 17){
					document.querySelector("#welcome").innerText = "Good Afternoon Anthony";
				} else if(hours >= 17){
					document.querySelector("#welcome").innerText = "Good Evening Anthony";
				} else{
					document.querySelector("#welcome").innerText = "Welcome Anthony";
				}
			}

			setInterval(function(){
			//	tellDate();
			//	tellTime();
				dateTimeContent();
			}, 1000);

		</script>
	</body>
</html>