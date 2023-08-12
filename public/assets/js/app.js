import Places from '../places.js/../..'
import Map from '../modules/map.js'
//import 'slick-carousel'
//import 'slick-carousel/slick/slick.css'
//import 'slick-carousel/slick/slick-theme.css'

Map.init()

let inputAddress = document.querySelector('#add_annoucement_Description')
if (inputAddress !== null) {
  let place = Places({
    container: inputAddress
  })
  place.on('change', e => {
    //document.querySelector('#add_annoucement_Description').value = e.suggestion.city
    document.querySelector('#add_annoucement_lat').value = e.suggestion.latlng.lat
    document.querySelector('#add_annoucement_lng').value = e.suggestion.latlng.lng
  })
}


let searchAddress = document.querySelector('#add_annoucement_Description')
if (searchAddress !== null) {
  let place = Places({
    container: searchAddress
  })
  place.on('change', e => {
    document.querySelector('#lat').value = e.suggestion.latlng.lat
    document.querySelector('#lng').value = e.suggestion.latlng.lng
  })
}

let $ = require('jquery')
require('../css/app.css');
require('select2')

$('[data-slider]').slick({
  dots: true,
  arrows: true
})
$('select').select2()
let $contactButton = $('#contactButton')
$contactButton.click(e => {
  e.preventDefault();
  $('#contactForm').slideDown();
  $contactButton.slideUp();
})

// Suppression des éléments
document.querySelectorAll('[data-delete]').forEach(a => {
  a.addEventListener('click', e => {
    e.preventDefault()
    fetch(a.getAttribute('href'), {
      method: 'DELETE',
      headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({'_token': a.dataset.token})
    }).then(response => response.json())
      .then(data => {
        if (data.success) {
          a.parentNode.parentNode.removeChild(a.parentNode)
        } else {
          alert(data.error)
        }
      })
      .catch(e => alert(e))
  })
})


// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
// var $ = require('jquery');

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');
