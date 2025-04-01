const name = document.getElementById('name');
const email = document.getElementById('email');
const phone = document.getElementById('phone');
const password = document.getElementById('password');

// const name_error = document.getElementById('name_error');

// form.addEventListner('submit',(e)=>{
//     if (name.value === '' || name.value == null){
//         e.preventDefault();
//         name_error.innerHTML = "Name is Required";

//     }
         
// });



const container = document.getElementById('container');

const registerBtn = document.getElementById('register');

const loginBtn = document.getElementById('login');

registerBtn.addEventListener('click', ()=>{
    container.classList.add("active");
});

loginBtn.addEventListener('click',() =>{
    container.classList.remove("active");
});

function isNumberKey(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    // Only allow numbers (0-9)
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
