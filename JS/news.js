const apiKey = 'ee0dd026874d4a01b73386a3cc365885'; // Tu propia clave API de Google News

// Función para obtener noticias de Fórmula 1
async function obtenerNoticiasFormula1() {
    try {
        const url = `https://newsapi.org/v2/everything?q=Formula%201&apiKey=${apiKey}`;
        const response = await fetch(url);
        const data = await response.json();
        return data.articles; // Devuelve los artículos de noticias
    } catch (error) {
        console.error('Error al obtener noticias:', error);
        return []; // Devuelve un array vacío en caso de error
    }
}

// Ejemplo de cómo usar la función para obtener y mostrar las noticias de Fórmula 1
// Ejemplo de cómo usar la función para obtener y mostrar las noticias de Fórmula 1
async function mostrarNoticiasFormula1() {
    try {
        const noticias = await obtenerNoticiasFormula1();
        const noticia1 = noticias[7];
        const noticia2 = noticias[1];
        const noticia3 = noticias[0];
        const noticia4 = noticias[3];
        console.log(noticia1);
        // Función para formatear la fecha
        const formatearFecha = fecha => {
            return new Date(fecha).toLocaleDateString('es-ES', {
                year: 'numeric',
                month: '2-digit',
                day: '2-digit'
            });
        };

        document.getElementById("notice-title1").textContent = noticia1.title+".";
        document.getElementById("notice-author1").textContent = "Author: " + (noticia1.author || 'Desconocido') + " | Date: " + formatearFecha(noticia1.publishedAt);
        document.getElementById("latest-news-notice1").style.backgroundImage = "linear-gradient(rgba(0, 0, 0, 0),rgba(0, 0, 0, 0.25),rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 1)),url('" + noticia1.urlToImage + "')";;
        document.getElementById("latest-news-notice1").addEventListener("click", ()=>{

        });

        document.getElementById("notice-title2").textContent = noticia2.title+".";
        document.getElementById("notice-author2").textContent = "Author: " + (noticia2.author || 'Desconocido') + " | Date: " + formatearFecha(noticia2.publishedAt);
        document.getElementById("latest-news-notice2").style.backgroundImage = "linear-gradient(rgba(0, 0, 0, 0),rgba(0, 0, 0, 0.25),rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 1)),url('" + noticia2.urlToImage + "')";;

        document.getElementById("notice-title3").textContent = noticia3.title+".";
        document.getElementById("notice-author3").textContent = "Author: " + (noticia3.author || 'Desconocido') + " | Date: " + formatearFecha(noticia3.publishedAt);
        document.getElementById("latest-news-notice3").style.backgroundImage = "linear-gradient(rgba(0, 0, 0, 0),rgba(0, 0, 0, 0.25),rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 1)),url('" + noticia3.urlToImage + "')";;

        document.getElementById("notice-title4").textContent = noticia4.title+".";
        document.getElementById("notice-author4").textContent = "Author: " + (noticia4.author || 'Desconocido') + " | Date: " + formatearFecha(noticia4.publishedAt);
        document.getElementById("latest-news-notice4").style.backgroundImage = "linear-gradient(rgba(0, 0, 0, 0),rgba(0, 0, 0, 0.25),rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 1)),url('" + noticia4.urlToImage + "')";;

    } catch (error) {
        console.error('Error al mostrar noticias:', error);
    }
}


// Llamamos a la función para mostrar las noticias de Fórmula 1 inmediatamente
mostrarNoticiasFormula1();

// Luego, configuramos para que se ejecute cada día
const milisegundosEnUnDia = 24 * 60 * 60 * 1000; // 24 horas * 60 minutos * 60 segundos * 1000 milisegundos
setInterval(mostrarNoticiasFormula1, milisegundosEnUnDia);
