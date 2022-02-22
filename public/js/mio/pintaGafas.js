$(function(){

    console.log("File JavaScript Loaded Sucessfuly");
    $.getJSON("/api/botellas/todas",function(data){

        console.log(data);

        crearCajasGafas(data);
        
    }).fail(function(){

        console.log("Los datos recibidos no estan en formato JSON");
    });
})

function crearCajasGafas(coleccion){ //creaCajasGafas(data)

    var contenedor_productos= $("#productos");
    let max=coleccion.length;
    for(let caja=0;caja<max;caja++){

        var caja_producto=$("<div>");
        var enlace_img=$("<a>");
        var img_producto=$("<img>");
        var p_mask = $("<div>");
            var form_hidden = $("<form>");
            var inpu1 = $("<input>");
            var input2 = $("<form>");
            var input3 = $("<form>");
            var input4 = $("<form>");
            var boton = $("<button>");
        var nombre_producto=$("<h4>");
        var precio_producto=$("<h5>");

        caja_producto.attr("class", "col-md-4 women-grids wp1 animated wow slideInUp");
        caja_producto.attr("data-wow-delay", ".5s");
        
        enlace_img.attr("href", "#");

        img_producto.attr("src", "../../images/subidas/"+coleccion[caja].img);

        p_mask.attr("class", "p-mask");

        form_hidden.atter("action", "#");
        form_hidden.atter("method", "post");
        
        nombre_producto.attr("class","titulo-producto");
        nombre_producto.text(coleccion[caja].nombre);
        
        
        precio_producto.attr("class","precio-producto");
        precio_producto.text(coleccion[caja].precio+" €");
        
        
        caja_producto.append(enlace_img);
        caja_producto.append(img_producto);
        caja_producto.append(nombre_producto);
        caja_producto.append(precio_producto);
        contenedor_productos.append(caja_producto);
    }
}