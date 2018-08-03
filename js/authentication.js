
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
      var displayName = $("#display-name").val(); 
      var photoURL = "http://wfarm2.dataknet.com/static/resources/icons/set108/b5cdab07.png";
      var credential = firebase.auth.EmailAuthProvider.credential(email, password);
      var auth = firebase.auth();
      auth.signInAndRetrieveDataWithCredential(credential).then(function(user){
          $("#myModal").modal("hide");
          console.log('current user is ' + user);
      }).catch(function(error){
          // Create a new user 
          auth.createUserWithEmailAndPassword(email,password).then(function(user){
            $("#myModal").modal("hide");
            currentUser = firebase.auth().currentUser;
            currentUser.updateProfile({
                displayName : displayName,
                photoURL : photoURL
            }).then(function(user){
                currentUser = firebase.auth().currentUser;
                $.cookie("displayName", currentUser.displayName);
                $.cookie("profilePicURL", currentUser.photoURL);
            }).catch(function(error){
                console.log("Error in error " + error);
            });
          }).catch(function(error){
            console.log(error);  
          });
      });
      
      // Step 2
      //  Get a credential with firebase.auth.emailAuthProvider.credential(emailInput.value, passwordInput.value)
      //  If there is no current user, log in with auth.signInWithCredential(credential)
      //  If there is a current user an it's anonymous, atttempt to link the new user with firebase.auth().currentUser.link(credential) 
      //  The user link will fail if the user has already been created, so catch the error and sign in.
});
