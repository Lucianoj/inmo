//$(function(){
//    // obtiene el click del boton crear
//    $('#modalButton').click(function(){
//        $('#modal').modal('show')
//                .find('#modalContent')
//                .load($(this).attr('value'));
//    });
//});
$(function(){
    //get the click of modal button to create / update item
    //we get the button by class not by ID because you can only have one id on a page and you can
    //have multiple classes therefore you can have multiple open modal buttons on a page all with or without
    //the same link.
//we use on so the dom element can be called again if they are nested, otherwise when we load the content once it kills the dom element and wont let you load anther modal on click without a page refresh
      $(document).on('click', '.showModalButton', function(){
         //check if the modal is open. if it's open just reload content not whole modal
        //also this allows you to nest buttons inside of modals to reload the content it is in
        //the if else are intentionally separated instead of put into a function to get the 
        //button since it is using a class not an #id so there are many of them and we need
        //to ensure we get the right button and content. 
        if ($('#modal').data('bs.modal').isShown) {
            $('#modal').find('#modalContent')
                    .load($(this).attr('value'));
            //dynamiclly set the header for the modal
            document.getElementById('modalHeader').innerHTML = "<h3 class='text-center text-info'><i class='fa fa-shopping-cart'></i> " + $(this).attr('title') + '</h3>';
        } else {
            //if modal isn't open; open it and load content
            $('#modal').modal('show')
                    .find('#modalContent')
                    .load($(this).attr('value'));
             //dynamiclly set the header for the modal
            document.getElementById('modalHeader').innerHTML =  "<h3 class='text-center text-info'><i class='fa fa-shopping-cart'></i> "  + $(this).attr('title') + '</h3>';
        }
    });
});

//
// jQuery(document).ready(function() {
//     function initMap() {
//         var map = new google.maps.Map(document.getElementById('map'), {
//             zoom: 8,
//             center: {lat: -34.397, lng: 150.644}
//         });
//         var geocoder = new google.maps.Geocoder();
//
//         $('#enviar')on('click', function () {
//             alert("click");
//             geocodeAddress(geocoder, map);
//         })
//         // document.getElementById('enviar').addEventListener('click', function () {
//         //     alert("click");
//         //     geocodeAddress(geocoder, map);
//         // });
//     }
//
//     function geocodeAddress(geocoder, resultsMap) {
//         var address = document.getElementById('address').value;
//         geocoder.geocode({'address': address}, function (results, status) {
//             if (status === google.maps.GeocoderStatus.OK) {
//                 resultsMap.setCenter(results[0].geometry.location);
//                 var marker = new google.maps.Marker({
//                     map: resultsMap,
//                     position: results[0].geometry.location
//                 });
//             } else {
//                 alert('Geocode was not successful for the following reason: ' + status);
//             }
//         });
//     }
// });

// /**
//  * Created by luciano on 09/10/16.
//  */
// var lat = null;
// var lng = null;
// var map = null;
// var geocoder = null;
// var marker = null;
//
//
//
//
// jQuery(document).ready(function(){
//     //obtenemos los valores en caso de tenerlos en un formulario ya guardado en la base de datos
//     lat = jQuery('#lat').val();
//     lng = jQuery('#long').val();
//     //Asignamos al evento click del boton la funcion codeAddress
//     jQuery('#pasar').click(function(){
//         codeAddress();
//         return false;
//     });
//     //Inicializamos la función de google maps una vez el DOM este cargado
//     initialize();
// });
//
// function initialize() {
//
//     // geocoder = new google.maps.Geocoder();
//     //
//     // //Si hay valores creamos un objeto Latlng
//     // if(lat !='' && lng != '') {
//     //     var latLng = new google.maps.LatLng(lat,lng);
//     // } else {
//     //     //Si no creamos el objeto con una latitud cualquiera como la de Mar del Plata, Argentina por ej
//     //     var latLng = new google.maps.LatLng(37.0625,-95.677068);
//     // }
//     // // Definimos algunas opciones del mapa a crear
//     // var myOptions = {
//     //     center: latLng,//centro del mapa
//     //     zoom: 15,//zoom del mapa
//     //     mapTypeId: google.maps.MapTypeId.ROADMAP //tipo de mapa, carretera, híbrido,etc
//     // };
//     // //creamos el mapa con las opciones anteriores y le pasamos el elemento div
//     // map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
//     //
//     // //creamos el marcador en el mapa
//     // marker = new google.maps.Marker({
//     //     map: map,//el mapa creado en el paso anterior
//     //     position: latLng,//objeto con latitud y longitud
//     //     draggable: true //que el marcador se pueda arrastrar
//     // });
//     //
//     // //función que actualiza los input del formulario con las nuevas latitudes
//     // //Estos campos suelen ser hidden
//     // updatePosition(latLng);
//
//
// }
//
// //funcion que traduce la direccion en coordenadas
// function codeAddress() {
//
//     // obtengo la direccion del formulario
//     var address = document.getElementById("direccion").value;
//     //hago la llamada al geodecoder
//     geocoder.geocode( { 'address': address}, function(results, status) {
//
//         //si el estado de la llamado es OK
//         if (status == google.maps.GeocoderStatus.OK) {
//             //centro el mapa en las coordenadas obtenidas
//             map.setCenter(results[0].geometry.location);
//             //coloco el marcador en dichas coordenadas
//             marker.setPosition(results[0].geometry.location);
//             //actualizo el formulario
//             updatePosition(results[0].geometry.location);
//
//             //Añado un listener para cuando el markador se termine de arrastrar
//             //actualize el formulario con las nuevas coordenadas
//             google.maps.event.addListener(marker, 'dragend', function(){
//                 updatePosition(marker.getPosition());
//             });
//         } else {
//             //si no es OK devuelvo error
//             alert("No podemos encontrar la direcci&oacute;n, error: " + status);
//         }
//     });
// }
//
// //funcion que simplemente actualiza los campos del formulario
// function updatePosition(latLng)
// {
//
//     jQuery('#lat').val(latLng.lat());
//     jQuery('#long').val(latLng.lng());
//
// }
//
