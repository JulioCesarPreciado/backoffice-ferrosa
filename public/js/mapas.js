/* Inicializamos las lineas */
var polyline = null
var map=null;
var markers= null;
// Creating map options
var mapOptions = {
    center: [20.4778966, -103.4453719],
    zoom: 11,
    minZoom: 10,

}

if (document.getElementById("map")) {
    cargarMapa()
}

function cargarMapa() {
    map = new L.map('map', mapOptions);
    // Creamos el cluster de los marcadores
    markers = L.markerClusterGroup();
    // Creating a Layer object
    L.tileLayer('https://mt1.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', {
        attribution: ''
    }).addTo(map);

    var styleTlajomulco = {
        fillColor: 'transparent',
        weight: 2,
        opacity: 1,
        color: 'red', //Outline color
        fillOpacity: 1
    };

    //Limite de Tlajomulco
    L.geoJson(tlajomulco, {
        style: styleTlajomulco
    }).addTo(map);

    setTimeout(function () {
        map.invalidateSize();
    }, 30);

    return map
}
