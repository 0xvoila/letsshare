


firebase.auth().onAuthStateChanged(function(user) {
 // user is undefined if no user signed in
 if(!user){
        $("#myModal").modal("show");
        $("#deal-submit-btn").prop("disabled",true);
    }
  else {
      $("#myModal").modal("hide");
      $("#deal-submit-btn").prop("disabled",false);
  }
});


$('#login-btn').on('click', function(e) {
      e.preventDefault();
      e.stopPropagation();
      var email = $('#email').val();
      var password = $('#password').val();
      var credential = firebase.auth.EmailAuthProvider.credential(email, password);
      var auth = firebase.auth();
      auth.signInAndRetrieveDataWithCredential(credential).then(function(user){
          console.log('current user is ' + user);
          $("#myModal").modal("hide");
          
      }).catch(function(error){
          // Create a new user 
          auth.createUserWithEmailAndPassword(email,password).then(function(user){
            console.log("this is new user  " + user);
            $("#myModal").modal("hide");
          }).catch(function(error){
              
          });
      });
      
      // Step 2
      //  Get a credential with firebase.auth.emailAuthProvider.credential(emailInput.value, passwordInput.value)
      //  If there is no current user, log in with auth.signInWithCredential(credential)
      //  If there is a current user an it's anonymous, atttempt to link the new user with firebase.auth().currentUser.link(credential) 
      //  The user link will fail if the user has already been created, so catch the error and sign in.
});
