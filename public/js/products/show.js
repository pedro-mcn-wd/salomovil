let thumbnails = document.querySelectorAll('.thumbnail');
let currentIndex = 0;

for (const img of thumbnails) {
  img.addEventListener('click', changeMainImage);
}

function changeMainImage(e) {
  var mainImage = document.getElementById("mainImage");
  var tar = e.target;
  mainImage.src = tar.src;
  currentIndex = Array.from(thumbnails).indexOf(tar);
}

function changeImage(direction) {
  currentIndex += direction;
  var thumbnailsArray = Array.from(thumbnails);
  if (currentIndex < 0) {
    currentIndex = thumbnailsArray.length - 1;
  } else if (currentIndex >= thumbnailsArray.length) {
    currentIndex = 0;
  }
  var mainImage = document.getElementById("mainImage");
  mainImage.src = thumbnailsArray[currentIndex].src;
}

document.getElementById('prevBtn').addEventListener('click', function () {
  changeImage(-1);
});

document.getElementById('nextBtn').addEventListener('click', function () {
  changeImage(1);
});

// Desplazamiento horizontal con el botón de desplazamiento del ratón
var thumbnailsContainer = document.getElementById('thumbnailsContainer');
thumbnailsContainer.addEventListener('wheel', function (e) {
  e.preventDefault();
  thumbnailsContainer.scrollLeft += e.deltaY;
});

