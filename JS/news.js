//API KEY DE NEWS API QUE NOS PERMITE REALIZAR CONSULTAS PARA OBTENER DATOS SOBRE LAS NOTICIAS
const apiKey = "ee0dd026874d4a01b73386a3cc365885";

// FUNCION PARA ENLAZAR Y CONSULTAR A LA API Y TRAERSE LAS NOTICIAS DE LA API
async function obtenerNoticiasFormula1() {
  try {
    const url = `https://newsapi.org/v2/everything?q=Formula%201&apiKey=${apiKey}`;
    const response = await fetch(url);
    const data = await response.json();
    return data.articles;
  } catch (error) {
    console.error("Error al obtener noticias:", error);
    return [];
  }
}

// FUNCION QUE MUESTRA LAS NOTICIAS OBTENIDAS DE LA API
async function mostrarNoticiasFormula1() {
  try {
    //RECOGER EN UN ARRAY LAS NOTICIAS Y ELEGIR 4 DE ELLAS
    const noticias = await obtenerNoticiasFormula1();
    const noticia1 = noticias[0];
    const noticia2 = noticias[1];
    const noticia3 = noticias[2];
    const noticia4 = noticias[3];
    console.log(noticias);
    // FORMATEAR FECHA PARA MOSTRARLA EN EL CONTENEDOR
    const formatearFecha = (fecha) => {
      return new Date(fecha).toLocaleDateString("es-ES", {
        year: "numeric",
        month: "2-digit",
        day: "2-digit",
      });
    };

    //RECOGER LOS ELEMENTOS DEL DOM Y PINTAR LOS DATOS DE LA API PARA LA NOTICIA 1
    document.getElementById("notice-title1").textContent = noticia1.title + ".";
    document.getElementById("notice-author1").textContent =
      "Author: " +
      (noticia1.author || "Desconocido") +
      " | Date: " +
      formatearFecha(noticia1.publishedAt);
    document.getElementById("latest-news-notice1").style.backgroundImage =
      "linear-gradient(rgba(0, 0, 0, 0),rgba(0, 0, 0, 0.25),rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 1)),url('" +
      noticia1.urlToImage +
      "')";
    document
      .getElementById("latest-news-notice1")
      .addEventListener("click", () => {
        window.location.href = "" + noticia1.url + "";
      });

    //RECOGER LOS ELEMENTOS DEL DOM Y PINTAR LOS DATOS DE LA API PARA LA NOTICIA 2
    document.getElementById("notice-title2").textContent = noticia2.title + ".";
    document.getElementById("notice-author2").textContent =
      "Author: " +
      (noticia2.author || "Desconocido") +
      " | Date: " +
      formatearFecha(noticia2.publishedAt);
    document.getElementById("latest-news-notice2").style.backgroundImage =
      "linear-gradient(rgba(0, 0, 0, 0),rgba(0, 0, 0, 0.25),rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 1)),url('" +
      noticia2.urlToImage +
      "')";
    document
      .getElementById("latest-news-notice2")
      .addEventListener("click", () => {
        window.location.href = "" + noticia2.url + "";
      });

    //RECOGER LOS ELEMENTOS DEL DOM Y PINTAR LOS DATOS DE LA API PARA LA NOTICIA 3
    document.getElementById("notice-title3").textContent = noticia3.title + ".";
    document.getElementById("notice-author3").textContent =
      "Author: " +
      (noticia3.author || "Desconocido") +
      " | Date: " +
      formatearFecha(noticia3.publishedAt);
    document.getElementById("latest-news-notice3").style.backgroundImage =
      "linear-gradient(rgba(0, 0, 0, 0),rgba(0, 0, 0, 0.25),rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 1)),url('" +
      noticia3.urlToImage +
      "')";
    document
      .getElementById("latest-news-notice3")
      .addEventListener("click", () => {
        window.location.href = "" + noticia3.url + "";
      });

    //RECOGER LOS ELEMENTOS DEL DOM Y PINTAR LOS DATOS DE LA API PARA LA NOTICIA 4
    document.getElementById("notice-title4").textContent = noticia4.title + ".";
    document.getElementById("notice-author4").textContent =
      "Author: " +
      (noticia4.author || "Desconocido") +
      " | Date: " +
      formatearFecha(noticia4.publishedAt);
    document.getElementById("latest-news-notice4").style.backgroundImage =
      "linear-gradient(rgba(0, 0, 0, 0),rgba(0, 0, 0, 0.25),rgba(0, 0, 0, 0.5),rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 1)),url('" +
      noticia4.urlToImage +
      "')";
    document
      .getElementById("latest-news-notice4")
      .addEventListener("click", () => {
        window.location.href = "" + noticia4.url + "";
      });

    //ERROR EN EL CASO DE NO MOSTRAR NOTICIAS
  } catch (error) {
    console.error("Error al mostrar noticias:", error);
  }
}

// LLAMAR A LA FUNCION PARA MOSTRAR LAS NOTICIAS
mostrarNoticiasFormula1();

// ACTUALIZAR LAS NOTICIAS CADA 5 MINUTOS(EJEMPLO) PARA OBTENER LAS ULTIMAS
setInterval(mostrarNoticiasFormula1, 300000); // 300000 milisegundos = 5 minutos
