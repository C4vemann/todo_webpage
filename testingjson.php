<html>
	<head>
	</head>

	<body>
		<ul id="people">
		</ul>
		<script>

			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function() {
			    if (this.readyState == 4 && this.status == 200) {
			       	var response = JSON.parse(xhttp.responseText);
			      	var people = response.people;
			      	var output = '';
					for(var i = 0; i < people.length; i++){
						output += '<li>' + people[i].name + '</li>';
					}
					document.getElementById('people').innerHTML = output;
				}
			};
			xhttp.open("GET", "testingjson.json", true);
			xhttp.send();


/*			var person = {
				first: "Anthony",
				age: 24,
				address:{
					street:"169 Durkee Lane",
					city:"East Patchogue"
				},
				parents:["Lori","Michael"]

			}	
			person = JSON.stringify(person);
			console.log(person);
			person = JSON.parse(person);
			console.log(person);
			console.log(person.address.street);
			console.log(person.address.city);
			console.log(person.parents);
			console.log(person.parents[0]);
			console.log(person.parents[1]);


			var people = [
				{
					name:"Anthony",
					age: 24
				},
				{
					name:"Tom",
					age:27
				},
				{
					name:"Joe",
					age:22
				}
			];

			console.log(people);
			console.log(people[0]);
			console.log(people[1]);
			console.log(people[2]);

			people = JSON.stringify(people);
			console.log(people);
			people = JSON.parse(people);
			console.log(people);


*/
		</script>
	</body>
</html>