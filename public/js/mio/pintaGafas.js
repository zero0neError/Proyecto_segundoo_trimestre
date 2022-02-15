$(function(){

    console.log("Cargando javascript file...");
    $.getJSON("../js/mio/JsonGafas.txt",function(data){

        console.log(data);
        
    }).fail(function(){

        console.log("El data recogido no es un JSON");
    });
})