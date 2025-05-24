var hiddenPath = $("#hiddenPath").val();

var moduloHola = $(".moduloHola").text();

console.log("modulo Hola " + moduloHola);


var data = new FormData();
data.append("moduloHola", moduloHola);

$.ajax({
    url:hiddenPath+"/ajax/hola_ajax.php",
    method: "POST",
    data: data,
    cache: false,
    contentType: false,
    processData: false,
    success:(response)=>{
        console.log("respuesta " + response);
    }
});