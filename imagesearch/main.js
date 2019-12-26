 const API_URL = 'https://api.unsplash.com/search/photos/?client_id=8b5779e3b76830a9fb4985951e7224d8c53cc721c796a8f00c0dcbe69402f447';
//const API_URL = 'https://api.github.com/users';
const form = document.querySelector('form');
const input = document.querySelector('input');
const loadingImage = document.querySelector('#loadingImage');
const imageSection = document.querySelector('.images');

loadingImage.style.display = 'none';

form.addEventListener('submit', formSubmitted);

function formSubmitted(event) {
  event.preventDefault();
  const searchTerm = input.value;
  
  searchStart();
  search(searchTerm)
    .then(displayImages)
    .then(() => {
      loadingImage.style.display = 'none';
    });
}

function searchStart() {
  loadingImage.style.display = '';
  imageSection.innerHTML = '';
}

function search(searchTerm) {
  const url = `${API_URL}&query=${searchTerm}`;
  //const url = `${API_URL}`;
  return fetch(url)
    .then(response => response.json())
    .then(result => {
      console.log(result.results);
      //return result.photos;
      return result.results;
      
    });
}

function displayImages(images) {
  images.forEach(image => {
    const a = document.createElement('a');
    a.href=`edit_image.html?img=${image.urls.small}`;
    console.log(a.src);
    //a.innerText="ADD CAPTION"; 
    


   console.log(image.urls.full);
    const imageElement = document.createElement('img');
    imageElement.style="height:300px;width:315px;padding: 3px";
    imageElement.src = image.urls.small;
    imageElement.classList.add('img', 'img-responsive','four');
    a.appendChild(imageElement);
    
    imageSection.appendChild(a);
    
  });
}




























