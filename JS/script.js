// Función para detectar cuándo el contenido está en la parte superior de la ventana o cerca de ella
function isElementNearTop(element) {
  const rect = element.getBoundingClientRect();
  return rect.top <= window.innerHeight / 1; 
}

// Función para mostrar u ocultar el contenido con un fade in según la posición del scroll
function handleContentVisibility() {
  const content = document.querySelector(".about");
  if (isElementNearTop(content)) {
    content.style.opacity = "1";
  } else {
    content.style.opacity = "0";
  }
}

// Agregar un event listener para detectar el scroll de la página
window.addEventListener("scroll", handleContentVisibility);


