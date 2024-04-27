const fetch = require('node-fetch');
const xml2json = require('xml-js');

async function obtenerResultados() {
    try {
        const url = `https://ergast.com/api/f1/2008/drivers/alonso/results`;
        const response = await fetch(url);
        const xmlData = await response.text();
        const jsonData = xml2json.xml2json(xmlData, { compact: true, spaces: 4 });
        return JSON.parse(jsonData); // Convertir el JSON en un objeto JavaScript
    } catch (error) {
        console.error('Error al obtener resultados:', error);
        return {}; // Devuelve un objeto vacío en caso de error
    }
}

obtenerResultados().then(resultados => {
    console.log(resultados);
});
