<?php
header("HTTP/1.1 200 OK");
header('Access-Control-Allow-Origin: *');


echo '[{"titulo":"prueba CONDUCIR","idquestion":"212573","pregunta":"Si tenemos que arrancar nuestro vehículo con nieve en la vía, ¿con qué marcha lo haremos?","respuestas":{"respuesta1":{"idchoice":899285,"choice":"Con una marcha larga"},"respuesta2":{"idchoice":299387,"choice":"Con una marcha corta"}}},
{"titulo":"prueba Silvia","idquestion":"212575","pregunta":"Si los amortiguadores están en mal estado, ¿qué puede ocurrir?","respuestas":
{"respuesta1":{"idchoice":899286,"choice":"Que aumente peligrosamente la distancia de frenado."},
"respuesta2":{"idchoice":299388,"choice":"Que disminuya la distancia de frenado."}}},
{"titulo":"prueba Silvia","idquestion":"212575","pregunta":" ¿Las bicicletas pueden llevar remolque?","respuestas":
{"respuesta1":{"idchoice":899289,"choice":"Si"},
"respuesta2":{"idchoice":299389,"choice":"No"}}},

{"titulo":"prueba Silvia","idquestion":"212575","pregunta":"Circulando por una vía frecuentada por peatones, especialmente niños o ancianos, ¿qué haremos?","respuestas":{
	"respuesta1":{"idchoice":899287,"choice":"Reducir la velocidad, incluso llegando a detenerme."},
	"respuesta2":{"idchoice":299390,"choice":"Adoptaré las medidas necesarias para su seguridad, sin tener que moderar obligatoriamente la velocidad."}}},
{"titulo":"prueba Silvia","idquestion":"212577","pregunta":"¿Podremos realizar un cambio de dirección a la vista de esta señal?","respuestas":
{"respuesta1":{"idchoice":899288,"choice":"No, sólo podemos continuar de frente."},
"respuesta2":{"idchoice":299391,"choice":"Sí, tanto a la derecha como a la izquierda."}}},
{"titulo":"prueba Silvia","idquestion":"212579","pregunta":"¿Es recomendable mantener la velocidad indicada por la señal aunque las condiciones de la vía y la circulación sean favorables?","respuestas":
{"respuesta1":{"idchoice":899289,"choice":"Si"},
"respuesta2":{"idchoice":299392,"choice":"No, si las condiciones son favorables la recomendación no es aplicable."}}}]';

?>