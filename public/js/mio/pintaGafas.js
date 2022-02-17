$(function(){

    console.log("File JavaScript Loaded Sucessfuly");
    $.getJSON("../js/mio/JsonGafas.txt",function(data){

        console.log(data);

        $.each(data,function(ind,element){
            $(".product-img img").attr("src","");
            $(".titulo-producto")[ind].innerHTML=element.nombre;
            $(".precio-producto")[ind].innerHTML=element.precio;
        });

        // let max=data.length;
        // for(let i=0;i<max;i++){
                
        //     $(".titulo-producto").eq(i).text(data[i].nombre);
        //     $(".precio-producto").eq(i).text(data[i].precio);
        //     $(".product-img img").eq(i).attr("src","a");
        // } 
        
    }).fail(function(){

        console.log("El data recogido no es un JSON");
    });
})