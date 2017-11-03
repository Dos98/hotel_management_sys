
(function(){
    // Initialize Firebase
    var config = {
        apiKey: "AIzaSyDU_D77bzaLU5JKyHv5NuPaq9a7d8QKNr4",
        authDomain: "dc-hotels.firebaseapp.com",
        databaseURL: "https://dc-hotels.firebaseio.com",
        projectId: "dc-hotels",
        storageBucket: "dc-hotels.appspot.com",
        messagingSenderId: "797668789956"
    };

    const txtEmail= document.getElementById('txtEmail');
    const txtPass= document.getElementById('txtPass');
    const btnLogin= document.getElementById('btnLogin');
    const btnLogout= document.getElementById('btnLogout');
    const btnSignup= document.getElementById('btnSignup');


    btnLogin.addEventListener('click',e=>{
        //get email and pass
        const email=txtEmail.value;
        const pass=txtPass.value;
        const auth=firebase.auth();
        // sign up
        const promise = auth.signInWithEmailandPassword(email,pass);
        promise.catch(e=>console.log(e.message));
    });


}());