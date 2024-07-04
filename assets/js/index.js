 const glass = document.querySelector('.glass');
 const loginLink = document.querySelector('.login-link');
 const registerLink = document.querySelector('.register-link');

 registerLink.addEventListener('click', ()=> {
    glass.classList.add('active');
 });

 loginLink.addEventListener('click', ()=> {
    glass.classList.remove('active');
 });

    //password change
 function change(){

   var password = document.getElementById('password');

   if (password.type === "password"){
      password.type = "text";
   } else {
      password.type = "password";
   }
 };