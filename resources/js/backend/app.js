import 'alpinejs'

window.$ = window.jQuery = require('jquery');
window.Swal = require('sweetalert2');

// CoreUI
require('@coreui/coreui');

// Boilerplate
require('../plugins');

const sendForm = function (e) {
    console.log(e)
    // e.preventDefault();
    // let id = e.target.dataset.id
    // console.log(id)
    // let form = document.getElementById('form-delete-' + id)
}
alert('Bonjour');
var a_deletes = document.querySelectorAll('.delete-parrain-btn');
if(a_deletes.length > 0){
    
    a_deletes.forEach((a, index) => {
        
        a.onclick = sendForm();
    });
    
}