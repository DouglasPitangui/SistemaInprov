/*
 * You would do something like that using Google API. 
 * Please note you must include the google maps library for this to work. 
 * Google geocoder returns a lot of address components so you must make an 
 * educated guess which one will have the city "administrative_area_level_1" 
 * is usually what you are looking for but sometimes locality is the city 
 * you are after. 
 * 
 * Anyhow - more details on google response types can be found here:
 *  http://code.google.com/apis/maps/documentation/javascript/services.html#GeocodingAddressTypes 
 * and here:
 *  http://code.google.com/apis/maps/documentation/javascript/services.html#ReverseGeocoding
 */
//$().ready(function() {
//    //CFácil
//    if (!isMobile()) {
////        var cFacilPos;
////        cFacilPos = new google.maps.LatLng('-20.266586999999998', '-40.29814650000001');
////        displayPosition(cFacilPos);
//        displayPosition('-20.266586999999998', '-40.29814650000001', 'mapcfacil');
//    }
////    $.get("http://ipinfo.io", function(response) {
////        console.log("Outra maneira: "+response.city, response.country);
////    }, "jsonp");
//    if (navigator.geolocation) {
//        navigator.geolocation.getCurrentPosition(successFunction, errorFunction);
//        initializeLocation();
//    } else {
////        console.log("Seu navegador não suporta geoLocalização");
////        alert("Seu navegador não suporta geoLocalização");
//    }
////    if (navigator.geolocation) {
////        navigator.geolocation.getCurrentPosition(function(position) {
////            var latLng = new google.maps.LatLng(
////                    position.coords.latitude,
////                    position.coords.longitude
////                    ),
////                    marker = new google.maps.Marker({
////                        position: latLng,
////                        map: map
////                    });
////
////            map.setCenter(latLng);
////        }, errorFunction);
////    }
//});
function initializeLocation() {
    geocoder = new google.maps.Geocoder();
}
var geocoder;

//Get the latitude and the longitude;
function successFunction(position) {
    var lat = position.coords.latitude;
    var lng = position.coords.longitude;
    codeLatLng(lat, lng);

//    console.log("Latitude:"+lat+"\nLongitude:"+lng);
}

function errorFunction() {
//    alert("Geocoder failed");
//    alert("Falha ao realizar geoLocalização");
    consolelog("Falha ao realizar geoLocalização");
}

function codeLatLng(lat, lng) {
    var latlng = new google.maps.LatLng(lat, lng);
    geocoder.geocode({'latLng': latlng}, function(results, status) {
        if (status == google.maps.GeocoderStatus.OK) {
//            console.log(results);
            if (results[1]) {
                //formatted address
//                alert(results[0].formatted_address);
//                console.log(results[0].formatted_address);

//                results.forEach(function (item) {
//                    console.log("Item: "+item);
//                })
                var bcidade = false;
                var bestado = false;
                var bbairro = false;
                for (var i = 0; i < results[0].address_components.length; i++) {
                    for (var b = 0; b < results[0].address_components[i].types.length; b++) {

                        //there are different types that might hold a city admin_area_lvl_1 usually does in come cases looking for sublocality type will be more appropriate
                        if (results[0].address_components[i].types[b] == "administrative_area_level_1") {
                            //this is the object you are looking for
                            var Estado = results[0].address_components[i];
//                            console.log("FOR: Estado Nome Curto: " + Estado.short_name + " Nome Longo: " + Estado.long_name);
//                            break;
                            bestado = true;
                        }
                        if (results[0].address_components[i].types[b] == "administrative_area_level_2") {
                            //this is the object you are looking for
                            var Cidade = results[0].address_components[i];
//                            console.log("FOR: Cidade Nome Curto: " + Cidade.short_name + " Nome Longo: " + Cidade.long_name);
//                            break;
                            bcidade = true;
                        }
                        if (bcidade && bestado) {
                            consolelog("FOR: Estado Nome Curto: " + Estado.short_name + " Nome Longo: " + Estado.long_name);
                            consolelog("FOR: Cidade Nome Curto: " + Cidade.short_name + " Nome Longo: " + Cidade.long_name);
//                            alert("FOR: Estado Nome Curto: " + Estado.short_name + " Nome Longo: " + Estado.long_name +
//                                "\nFOR: Cidade Nome Curto: " + Cidade.short_name + " Nome Longo: " + Cidade.long_name)
                            break;
                        }
                    }
                    if (bcidade && bestado) {
                        break;
                    }
                }
//                var Estado = results[0].address_components[5];
//                console.log("Estado\nNome Curto: " + Estado.short_name + "\nNome Longo: " + Estado.long_name + "\n");
//
//                var Cidade = results[0].address_components[4];
//                console.log("Cidade\nNome Curto: " + Cidade.short_name + "\nNome Longo: " + Cidade.long_name + "\n");
//
//                var Bairro = results[0].address_components[2];
//                console.log("Bairro\nNome Curto: " + Bairro.short_name + "\nNome Longo: " + Bairro.long_name + "\n");
//
//                var Rua = results[0].address_components[1];
//                console.log("Bairro\nNome Curto: " + Rua.short_name + "\nNome Longo: " + Rua.long_name + "\n");
//
//                var Cep = results[0].address_components[7];
//                console.log("Cep\nNome Curto: " + Cep.short_name + "\nNome Longo: " + Cep.long_name + "\n");
//
//                var Endereco = results[0].formatted_address;
//                console.log("Endereco: \nForma 1: " + Endereco + "\n");
//
//                Endereco = results[6].formatted_address;
//                console.log("Endereco: \nForma 2: " + Endereco + "\n");
////                alert("Cidade\nNome Curto: " + Cidade.short_name + "\nNome Longo: " + Cidade.long_name + "\nEndereco: \nForma 1: " + Endereco + "\nEndereco: \nForma 2: " + Endereco + "\n");
            } else {
//                alert("No results found");
                consolelog("Nenhum resultado encontrado para a geoLocalização:");
            }
        } else {
//            alert("Geocoder failed due to: " + status);
            consolelog("Falha ao executar a geoLocalização: " + status);
        }
    });
}

/**
 * @param {int} latitude Latitude para centralizar o mapa
 * @argument {int} longitude Longitude para centralizar o mapa
 * @argument {String} mapId Id do elemento que vai receber a imagem
 * @returns Cria a imagem do mapa no elemento passado
 * <br/>
 * <b>
 * <a href="https://developers.google.com/maps/documentation/staticmaps/?hl=pt-br">https://developers.google.com/maps/documentation/staticmaps/?hl=pt-br</a>
 * </b>
 * <pre>
 *sizes    API             scale=1	scale=2                                 scale=4<br/>
 *         Grátis          640x640	640x640 (retorna 1280 x 1280 pixels)	Não disponível.<br/>
 *         API Empresas    2048x2048	1024x1024 (retorna 2048 x 2048 pixels)	512x512 (retorna 2048 x 2048 pixels)
 * </pre>
 * <br/>
 * <b>Limites de uso</b>
 * <br/>25.000 solicitações de mapa estático gratuitas por aplicativo por dia.
 * <br/><br/>
 * <b>Como indicar o uso do sensor</b>
 * <br/><br/>
 * O uso da API do Google Static Maps exige que você indique se seu aplicativo 
 * está usando um "sensor" (como um localizador de GPS) para determinar a loca-
 * lização do usuário. Isso é importante especialmente para dispositivos móveis.
 * Os aplicativos devem transmitir um parâmetro de sensor obrigatório indicando 
 * se seu aplicativo está ou não usando um dispositivo de sensor.
 * <br/>
 * Os aplicativos que determinam a localização do usuário por meio de um sensor 
 * devem transmitir sensor=true no URL da solicitação da API do Google Static 
 * Maps. Se seu aplicativo não usar um sensor, transmita sensor=false.
 * <br/>
 */
//function displayPositionIMG(position) {
//    var latlon = position.coords.latitude + "," + position.coords.longitude;
function displayPositionIMG(latitude, longitude, mapId) {
    var latlon = latitude + "," + longitude;
    var mapId = document.getElementById(mapId);
    
    var size = mapId.offsetWidth + "x" + mapId.offsetHeight;
    var img_url = "http://maps.googleapis.com/maps/api/staticmap?center="
//            + latlon + "&zoom=14&size=400x300&sensor=false";
//            + latlon + "&zoom=14&size=400x300&sensor=false&format=jpg&markers=label:º|"+latlon;
            + latlon + "&zoom=14&size="+size+"&sensor=false&format=jpg&language=pt-BR&markers=label:º|"+latlon;

    mapId.innerHTML = "<center><img src='" + img_url + "'></center>";
}

/**
 * @mapId   {String}    Id do elemento que receberá o mapa criado
 * @txt     {String}    Texto que irá aparecer ao clicar no icone da localização no mapa
 */
//function displayPosition(position) {
//    var pos = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
function displayPosition(lat, lng, mapId, txt) {
    var pos = new google.maps.LatLng(lat, lng);
    var options = {
        zoom: 15,//12,
        center: pos,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var map = new google.maps.Map(document.getElementById(mapId), options);
    var marker = new google.maps.Marker({
        position: pos,
        map: map,
        title: "Nossa localização"
    });
//    var contentString = "<b>Timestamp:</b> " + parseTimestamp(position.timestamp) + "<br/><b>User location:</b> lat " + position.coords.latitude + ", long " + position.coords.longitude + ", accuracy " + position.coords.accuracy;
    var contentString;
    if (txt) {
        contentString = txt;
    } else {
        contentString = "Construa Fácil<br/>O mais completo portal de pesquisa da Construção Civil.";
    }
    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });
    google.maps.event.addListener(marker, 'click', function() {
        infowindow.open(map, marker);
    });
}
function displayError(error) {
    var errors = {
        1: 'Permissão negada',
        2: 'Posição indisponível',
        3: 'Timeout da requisição',
        4: 'Erro desconhecido'
    };
//    alert("Error: " + errors[error.code]);
    console.log("Error: " + errors[error.code]);
}
function parseTimestamp(timestamp) {
    var d = new Date(timestamp);
    var day = d.getDate();
    var month = d.getMonth() + 1;
    var year = d.getFullYear();
    var hour = d.getHours();
    var mins = d.getMinutes();
    var secs = d.getSeconds();
    var msec = d.getMilliseconds();
    return day + "." + month + "." + year + " " + hour + ":" + mins + ":" + secs + "," + msec;
}