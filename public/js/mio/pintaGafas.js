$(function(){

    

    $(document.body).on("click","#verCarrito",
        function(){
            $("#PPsbmincart").hide();
            $("#modalReservas").modal("show");
            $('#myTable').DataTable({
                data: creaJsonConCarrito(),
                columns: [
                    { data: 'nombre' },
                    { data: 'cantidad' },
                    { data: 'precio' }
                ]
            });

            // $( "#datepicker" ).datepicker();
            
            $.getJSON("/api/tramos/todos",function(data){

                rellenaConTramos(data)
            });

            $("#btnAlquilar").click(function(){

                let max=$("#myTable tbody tr").length;
                for(let i=0;i<max;i++){

                    var nombreABuscar=$($("#myTable tbody tr")[i].children[0]).text();
                    var cantidadProductoCarrito=parseInt($($("#myTable tbody tr")[i].children[1]).text());
                    var cantidad=parseInt(dameNumeroTotalDeUnProductoNoAlquilado(nombreABuscar));
                    
                    if(cantidadProductoCarrito<=cantidad){
                        var fechaInicioReserva=$("#datepicker")[0].value;
                        var tramoIndex = $("#selectTramos")[0].options.selectedIndex;
                        var tramo=$("#selectTramos")[0].options[tramoIndex];
                        
                        
                        $.ajax({
                            async: false,
                            url: "/api/botella/update/"+nombreABuscar+"/"+cantidadProductoCarrito,
                            success: function(data) {
                                console.log(data);                    
                            }
                        });

                    }else{

                        console.log("no se puede alquilar");
                    }
                    
                }
                
            })
        }
    );

    $('#modalReservas').on('hidden.bs.modal', function () {
        $("#PPsbmincart").show();
    })

    var buffer = almacenaPaginaVacia();

    $("#overlay").show();
    $(".loader").show();

    
    $.getJSON("/api/botellas/todas",function(data){
        
        console.log(data);
        if(rellenaCajasBotellas(data)){

            $("#overlay").hide();
            $(".loader").hide();

            creaElementoPaginacion(data);

            $(".pagination li a").click(function(ev){
                

                ev.preventDefault();
                limpiaContenido();
                var indexPrimerElementoDeVuelto=($(this).attr("class").split("pagina")[1]);
                
                if(indexPrimerElementoDeVuelto>1){

                    indexPrimerElementoDeVueltos=((indexPrimerElementoDeVuelto-1)*12)+1;
                }else{

                    indexPrimerElementoDeVueltos=1;

                }

                $.getJSON("/api/botellas/pagina/"+indexPrimerElementoDeVueltos,function(data2){
                    console.log(data2);
                    rellenaCajasBotellasPagina(data2);
                    
                });
                
            });
        }
        
        
    }).fail(function(){

        console.log("Los datos recibidos no estan en formato JSON");
    });

    
});

function rellenaCajasBotellas(coleccion){ //creaCajasGafas(data)

    //####    IDEA DE FUNCIONAMENTO

   //####    La pagina tendra 12 cajas pero si solo hay 5 productos las otras 7 cajas estaran vacias
   //####    por lo que el resto que estan vacias seran invisibles para impedir que haya espacio sin utilizar
   //####    en la pagina.

   //####    FIN
   
    let max=$("#productos").children().length;
    for(let caja=0;caja<max;caja++){

        var inputId = $("<input>");
        inputId.attr("type","hidden");
        inputId.attr("name","id");
        inputId.attr("value",coleccion[caja].id_producto);

        $($("#productos .titulo-producto")[caja]).text(coleccion[caja].nombre);
        $($("#productos .precio-producto")[caja]).text(coleccion[caja].precio+" €");
        //Por si falla la carga de los elementos
        // $(document.getElementById("productos").children[caja].children[0].children[0].children[1].children[0].children[2]).attr("value",coleccion[caja].nombre);//nombre en el carrito
        // $(document.getElementById("productos").children[caja].children[0].children[0].children[1].children[0].children[2]) .attr("value",coleccion[caja].precio);//precio en el carrito
        $($("#productos").children()[caja].children[0].children[0].children[1].children[0].children[2]).attr("value",coleccion[caja].nombre);//nombre en el carrito
        $($("#productos").children()[caja].children[0].children[0].children[1].children[0].children[3]).attr("value",coleccion[caja].precio);//precio en el carrito
        $(".product-img img").eq(caja).attr("src", "../../images/subidas/"+coleccion[caja].img);

        $($("#productos").children()[caja].children[0].children[0].children[1].children[0]).append(inputId);
        
       
    }
    return true;
}

function rellenaCajasBotellasPagina(coleccion){ //creaCajasGafas(data)

   
    let max=coleccion.length;
    for(let caja=0;caja<max;caja++){

        $($("#productos .titulo-producto")[caja]).text(coleccion[caja].nombre);
        $($("#productos .precio-producto")[caja]).text(coleccion[caja].precio+" €");
        $($("#productos").children()[caja].children[0].children[0].children[1].children[0].children[2]).attr("value",coleccion[caja].nombre);//nombre en el carrito
        $($("#productos").children()[caja].children[0].children[0].children[1].children[0].children[3]).attr("value",coleccion[caja].precio);//precio en el carrito
        $(".product-img img").eq(caja).attr("src", "../../images/subidas/"+coleccion[caja].img)
    }
    
    return true;
}

function creaElementoPaginacion(coleccion){//se le pasa el json con todos los productos agrupados solo para saber la longitud
    
    //hace un length de todos los productos agrupados y los divide entre 12 elemento por pagina para sacar el nuemro de paginas
    var numeroPaginas = Math.ceil(14/12);
    for(let npagina=0;npagina<numeroPaginas;npagina++){
        var a = $("<a>");
        var li = $("<li>");

        li.attr("class", "page-item");

        a.attr("href", "#");
        a.attr("class", "page-link"+" pagina"+(npagina+1));
        a.text(npagina+1);
        li.append(a);
        $(".pagination").append(li);
    }
    
}

function elementosPaginados(numeroPagina){

    $.getJSON("/api/botellas/pagina/"+numeroPagina,function(data){

        console.log(data);

    }).fail(function(){

        console.log("Los datos recibidos no estan en formato JSON");
    });
}


function almacenaPaginaVacia(){

    return $("#productos");
}

function cargaPagina(numeroPagina,coleccion){//debemos pasarle el numero del elemento que queremos ver, el elemento 13 (pagina2), no la posicion en el json (12)

    // if((numeroPagina-1)>=0){

    //     var indexJson=((numeroPagina-1)*12);
    // }else{

    //     var indexJson=0;
    // }
    
   
    let max=(coleccion.length)-12;
    for(let caja=0;caja<max;caja++){

        $($("#productos .titulo-producto")[caja]).text(coleccion[indexJson].nombre);
        $($("#productos .precio-producto")[caja]).text(coleccion[indexJson].precio+" €");
        $($("#productos").children()[caja].children[0].children[0].children[1].children[0].children[2]).attr("value",coleccion[indexJson].nombre);//nombre en el carrito
        $($("#productos").children()[caja].children[0].children[0].children[1].children[0].children[3]).attr("value",coleccion[indexJson].precio);//precio en el carrito
        $(".product-img img").eq(caja).attr("src", "../../images/subidas/"+coleccion[indexJson].img)
        indexJson=indexJson+1;
    }
    
}

function limpiaContenido(){

    let max=$("#productos").children().length;
    for(let caja=0;caja<max;caja++){
        $($("#productos .titulo-producto")[caja]).text("");
        $($("#productos .precio-producto")[caja]).text("");
        $($("#productos").children()[caja].children[0].children[0].children[1].children[0].children[2]).attr("value","");//nombre en el carrito
        $($("#productos").children()[caja].children[0].children[0].children[1].children[0].children[3]).attr("value","");//precio en el carrito
        $(".product-img img").eq(caja).attr("src", "");
       
    }
}

function creaJsonConCarrito(){

    var arrayObjetos=[];

    let max=$("#PPsbmincart form ul").children().length;
    for(let i=0;i<max;i++){

        var idCarrito="";

        let nombreCarrito=$($("#PPsbmincart").children()[0].children[1].children[i].children[0].children[0]).text();
        
        let cantidadCarrito=$("#PPsbmincart").children()[0].children[1].children[i].children[1].children[0].getAttribute("value")

        let precioCarrito=$($("#PPsbmincart").children()[0].children[1].children[i].children[3].children[0]).text().split("$")[1];

        let objeto = {id:idCarrito,nombre:nombreCarrito,cantidad:cantidadCarrito,precio:precioCarrito};

        arrayObjetos[i]=objeto;
    }
    
    return arrayObjetos;
}

function dameInfoProductoPorNombre(nombreCarrito){

    $.getJSON("/api/botella/busca/"+nombreCarrito,function(data){

        console.log(data);
        return data;
    });

}

function rellenaConTramos(coleccion){

    for(let i=0;i<coleccion.length;i++){

        let option=$("<option>");
        option.attr("value",coleccion[i].id);
        option.text(coleccion[i].duracion_tramo);
        $("#selectTramos").append(option);
    }
    
}

// function dameNumeroTotalDeUnProductoNoAlquilado(nombre){

//     //los que tengan el alquilado en false y los que su fecha de finalizacion de alquilacion sea el dia de empezar a alquilar 
//     // este producto
//     var primerJson;
//     var numero1;
//     var numero2;
//     $.getJSON("/api/botella/busca/"+nombre,function(data){

//         primerJson=data[0].id_producto;
//         console.log("1: "+primerJson);
        
//     }).done(function() {//Cuando se reciban los datos
        
//         $.getJSON("/api/botella/buscaNA/"+primerJson,function(data2){
    
//             var numero1=data2[0].registros;
//             console.log("2: "+numero1);
//         }).done(function() {

//             console.log($("#datepicker")[0].value);
//             $.getJSON("/api/botella/buscaNAFecha/"+$("#datepicker")[0].value,function(data3){//buscamos numero de producto que termina el alquiler el dia solicitado

//                 var numero2=data3[0].registros;
//                 console.log("3: "+numero2);
//             }).done(function() {
                
//                 console.log("total: "+numerototal);
//                 var numerototal=numero1+numero2;
//                 return numerototal;
//             });;
//         });

//       });
// }

function dameNumeroTotalDeUnProductoNoAlquilado(nombre){

    //los que tengan el alquilado en false y los que su fecha de finalizacion de alquilacion sea el dia de empezar a alquilar 
    // este producto
    var idP;
    var numero1;
    var numerototal;

    $.ajax({
        async: false,
        url: "/api/botella/busca/"+nombre,
        success: function(data) {
            var primerJson=JSON.parse(data);
            idP=primerJson[0].id_producto;

            $.ajax({
                async: false,
                url: "/api/botella/totalLibre/"+$("#datepicker")[0].value+"/"+idP,
                success: function(data2) {
                    
                    numerototal=data2;
                    
                }
            }); 

        }
    });


    return numerototal;

}