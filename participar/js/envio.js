       
       
       var saveRespuestas="https://www.silviabaptista.es/participar/insertar-respuestas.php";
       var hostwork="https://www.silviabaptista.es/participar/";
       var dataCuestionario="https://www.silviabaptista.es/participar/respuestas.php";

	var i=0;
	var objeto;

	localStorage.removeItem("jsonData");
	var jsonData=new Object();

	localStorage.removeItem("jsonData");

    // Carga la plantilla donde se iran cargando las preguntas
	url=hostwork+"leearchivo.php";
	loadDoc(url);
    //alert(url);
	var survey=leeJSON(idcuestionario);



	function loadDoc(url) {
	  var xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
	      	document.getElementById("salida").innerHTML = this.responseText;
	    }
	  };
	  xhttp.open("GET", url, false);  
	  xhttp.send();
	}

	function readBody(xhr) {
	    var data;
	    if (!xhr.responseType || xhr.responseType === "text") {
		data = xhr.responseText;
	    } else if (xhr.responseType === "document") {
		data = xhr.responseXML;
	    } else {
		data = xhr.response;
	    }
	    return data;
	}


	function leeJSON(idcuestionario) {
	  var xhttp = new XMLHttpRequest();
	  //alert('cuestionario:  '+idcuestionario);
	  xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status ==200) {
			var objeto=this.responseText;
 			escribirHtml(xhttp.responseText);
	    }
	  };
	  xhttp.open("POST", dataCuestionario, true);
	  // enviar por POST el id de cuestionario a visualizar
	  xhttp.send('{\"id\":'+idcuestionario + '}'); 
	}

	function insertarJSON(jsonChoices) {
	  // Inserta el resultado en la base de datos
	  // "https://www.silviabaptista.es/participar/insertar-respuestas.php";
	  var url = saveRespuestas;
      //alert(url);
	  //var json = replaceAll(jsonChoices,'"','\"');
	  var json = jsonChoices;
	  var xhttp = new XMLHttpRequest();
 	
	  xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status ==200) {
			url=hostwork+"leegracias.php";
                console.log(url);
		        loadDoc(url);
	    }
	  };
	
	  xhttp.onerror = function() {
		url=hostwork+"leegracias.php";
        console.log(url);
		loadDoc(url);
	  	console.log('Hay un error!');
	  };
	
	  xhttp.open("POST", url, true); 
	  xhttp.setRequestHeader('Content-type','text/plain; charset=utf-8');
	  //ver=JSON.stringify(json);
	  console.log('ver fin: ');
	  //json=json.replace('"','');
	  console.log('{\"respuestas\":['+ json +']}');
	  xhttp.send('{\"respuestas\":['+ json +']}');
	 
	}

	function replaceAll(str, find, replace) {
	    return str.replace(new RegExp(find, 'g'), replace);
	}

	
	function siguientePregunta(idchoice){
		console.log('escribirHtml');
		var jsonData =localStorage.getItem("jsonData");
		var userSession;
        //alert('Contexta: '+jsonData);  
        // Cargamos las respuestas que llevamos contestadas

		if (jsonData==null){
			var arrayId = new Array();
			//arrayId.push('{respuesta:[');
		}else{
			var arrayId = new Array(jsonData);
		}
		//arrayId.push('{respuesta:' + idchoice.toString()+'}');

		
		//if (i === objeto.length-1){
		if (i === 0){
			var nombreUser =sessionStorage.getItem("usuario");
			arrayId.push('\"' + nombreUser.toString()+'\"');
			//arrayId.push(']');
		}
		arrayId.push('\"' + idchoice.toString()+'\"');
		console.log(arrayId);
		//if (i >= objeto.length){ // si acabamos insertamos al final el nombre de usuario
		//	userSession =sessionStorage.getItem(jsonUsuario);
		//	arrayId.push('{usuario:' + userSession.toString()+'}');
		//}
		jsonData=arrayId; 

		localStorage.setItem("jsonData", jsonData); //Grabamos en el localStorage las respuestas

 		i++; // Cargamos las siguientes respuestas
		if (i < objeto.length){
			document.getElementById('pregunta').innerHTML=objeto[i].pregunta;

			document.getElementById("respuesta1").value=objeto[i].respuestas["respuesta1"].idchoice;
			document.getElementById('respuesta1-texto').innerHTML=objeto[i].respuestas["respuesta1"].choice;
			document.getElementById("respuesta1").checked = false;

			document.getElementById("respuesta2").value=objeto[i].respuestas["respuesta2"].idchoice;
			document.getElementById('respuesta2-texto').innerHTML=objeto[i].respuestas["respuesta2"].choice;
			document.getElementById("respuesta2").checked = false
			//salidaJSON(objeto);
		}else{
			//var nombreUser =sessionStorage.getItem("usuario");
			//localStorage.setItem("jsonData",'{usuario:' +nombreUser+'}');
			//localStorage.setItem("jsonData",nombreUser);
			
		    jsonAnswer =localStorage.getItem("jsonData");
		    console.log(jsonAnswer);
			insertarJSON(jsonAnswer);
		}
      }

	function salidaJSON(salida){
		var z=1;
		for(var j in salida[i].respuestas) {
			    console.log('j:'+j,' salida_id:'+salida[i].respuestas[j].idchoice,  ' salida_texto:'+salida[i].respuestas[j].choice,false);
		        createRadioElementOtros(j,salida[i].respuestas[j].idchoice,salida[i].respuestas[j].choice,false);
			z++;
		}
	}

	function escribirHtml(entrada){  
	  if (entrada.length>0){
	  	
		objeto=JSON.parse(entrada);
		console.log('escribirHtml');
		console.log(objeto);
		document.getElementById('pregunta').innerHTML=objeto[i].pregunta;
		   
	 	document.getElementById("respuesta1").value=objeto[i].respuestas["respuesta1"].idchoice;
		document.getElementById('respuesta1-texto').innerHTML=replaceAll(objeto[i].respuestas["respuesta1"].choice,"'","\"");

		document.getElementById("respuesta2").value=objeto[i].respuestas["respuesta2"].idchoice;
		document.getElementById('respuesta2-texto').innerHTML=replaceAll(objeto[i].respuestas["respuesta2"].choice,"'","\"");
	   }
	}





