$(function(){
    
    $(document.body).on("click","#verCarrito",
        function(){
            console.log("aaaaaah");
            
            window.location.href = "http://localhost:8000/vercarrito/hola";
            // $.ajax({
            //     method:"POST",
            //     url:"/vercarrito",
            //     data:{

            //         json : "Hola"
            //     },
            //     success:function(){

            //         
            //     }

            // });
        }
    );

    var buffer = almacenaPaginaVacia();

    $("#overlay").show();
    $(".loader").show();
    $.getJSON("/api/botellas/todas",function(data){
        
        console.log(data);
        if(rellenaCajasBotellas(data)){

            $("#overlay").hide();
            $(".loader").hide();

            creaElementoPaginacion(data);

            $("#paginacion a").click(function(ev){
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
                $("#overlay").hide();
                $(".loader").hide();
            });
        }
        
        
    }).fail(function(){

        console.log("Los datos recibidos no estan en formato JSON");
    });

    
});

function rellenaCajasBotellas(coleccion){ //creaCajasGafas(data)

   
    let max=$("#productos").children().length;
    for(let caja=0;caja<max;caja++){

        $($("#productos .titulo-producto")[caja]).text(coleccion[caja].nombre);
        $($("#productos .precio-producto")[caja]).text(coleccion[caja].precio+" €");
        $($("#productos").children()[caja].children[0].children[0].children[1].children[0].children[2]).attr("value",coleccion[caja].nombre);//nombre en el carrito
        $($("#productos").children()[caja].children[0].children[0].children[1].children[0].children[3]).attr("value",coleccion[caja].precio);//precio en el carrito
        $(".product-img img").eq(caja).attr("src", "../../images/subidas/"+coleccion[caja].img);
        $($("#productos")[caja]).text(coleccion[caja].nombre); 
       
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
    console.log("hola");
    //hace un length de todos los productos agrupados y los divide entre 12 elemento por pagina para sacar el nuemro de paginas
    var numeroPaginas = Math.ceil(14/12);
    for(let npagina=0;npagina<numeroPaginas;npagina++){

        let a = $("<a>");
        a.attr("href", "#");
        a.attr("class", "pagina"+(npagina+1));
        a.text(npagina+1);
        $("#paginacion").append(a);
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

jQuery(function($){
    $(document).ajaxSend(function() {
      $("#overlay").fadeIn(300);　
    });
          
    $('#button').click(function(){
      $.ajax({
        type: 'GET',
        success: function(data){
          console.log(data);
        }
      }).done(function() {
        setTimeout(function(){
          $("#overlay").fadeOut(300);
        },500);
      });
    });	
  });