$(function(){

    console.log("File JavaScript Loaded Sucessfuly");
    $.getJSON("/api/botellas/todas",function(data){

        console.log(data);
        if(rellenaCajasGafas(data)){


        }
        
        
    }).fail(function(){

        console.log("Los datos recibidos no estan en formato JSON");
    });
})

function rellenaCajasGafas(coleccion){ //creaCajasGafas(data)

   
    let max=$("#productos").children().length;
    for(let caja=0;caja<max;caja++){
        $($("#productos .titulo-producto")[caja]).text(coleccion[caja].nombre);
        $($("#productos .precio-producto")[caja]).text(coleccion[caja].precio+" €");
        $($("#productos").children()[caja].children[0].children[0].children[1].children[0].children[2]).attr("value",coleccion[caja].nombre);//nombre en el carrito
        $($("#productos").children()[caja].children[0].children[0].children[1].children[0].children[3]).attr("value",coleccion[caja].precio);//precio en el carrito
        $(".product-img img").eq(caja).attr("src", "../../images/subidas/"+coleccion[caja].img)
       
    }
        return true;
}

function creaElementoPaginacion(){

    var elementoPaginacion = $("#paginacion");
    //hace un length de todos
    $("<a>")
}


// function creaCajasGafas(coleccion){ //creaCajasGafas(data)

//     var contenedor_productos= $("#productos");
//     let max=coleccion.length;
//     for(let caja=0;caja<max;caja++){

//         var caja_producto=$("<div>");
//         var enlace_img=$("<a>");
//         var product_img = $("<div>");
//         var img_producto=$("<img>");
//         var p_mask = $("<div>");
//             var form_hidden = $("<form>");
//             var input1 = $("<input>");
//             var input2 = $("<input>");
//             var input3 = $("<input>");
//             var input4 = $("<input>");
//             var boton = $("<button>");
//             var etiquetaI = $("<i>");
//         var nombre_producto=$("<h4>");
//         var precio_producto=$("<h5>");

//         caja_producto.attr("class", "col-md-4 women-grids wp1 animated wow slideInUp");
//         caja_producto.attr("data-wow-delay", ".5s");
        
//         enlace_img.attr("href", "#");

//         product_img.attr("class","product-img");

//         img_producto.attr("src", "../../images/subidas/"+coleccion[caja].img);

//         p_mask.attr("class", "p-mask");

//         form_hidden.attr("action", "#");
//         form_hidden.attr("method", "post");

//         input1.attr("type", "hidden");
//         input1.attr("name", "cmd");
//         input1.attr("value", "_cart");

//         input2.attr("type", "hidden");
//         input2.attr("name", "add");
//         input2.attr("value", "1");

//         input3.attr("type", "hidden");
//         input3.attr("name", "w3ls1_item");
//         input3.attr("value", coleccion[caja].nombre);

//         input4.attr("type", "hidden");
//         input4.attr("name", "amount");
//         input4.attr("value", coleccion[caja].precio);
        
//         boton.attr("type", "submit");
//         boton.attr("class", "w3ls-cart pw3ls-cart");
        

//         etiquetaI.attr("class","fa fa-cart-plus");
//         etiquetaI.attr("aria-hidden","true");
        

//         nombre_producto.attr("class","titulo-producto");
//         nombre_producto.text(coleccion[caja].nombre);
        
//         precio_producto.attr("class","precio-producto");
//         precio_producto.text(coleccion[caja].precio+" €");
        
//         boton.append(etiquetaI);
//         boton.text("Add to cart");
//         form_hidden.append(input1);
//         form_hidden.append(input2);
//         form_hidden.append(input3);
//         form_hidden.append(input4);
//         form_hidden.append(boton);
//         p_mask.append(form_hidden);
//         product_img.append(img_producto);
//         product_img.append(p_mask);
//         enlace_img.append(product_img);
//         caja_producto.append(enlace_img);
//         caja_producto.append(nombre_producto);
//         caja_producto.append(precio_producto);
//         contenedor_productos.append(caja_producto);
//     }
//         return true;
// }