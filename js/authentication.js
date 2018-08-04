
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


$('#login-google-btn').on('click', function(e) {
      e.preventDefault();
      e.stopPropagation();
      // get googleAuthProvider 
        var provider = new firebase.auth.GoogleAuthProvider();
      provider.addScope('email');
      provider.addScope('profile');
    
      return firebase.auth().signInWithPopup(provider).then(function(){
          $("#myModal").modal("hide");  
            currentUser = firebase.auth().currentUser;
            $.cookie("email", currentUser.email);
            $.cookie("displayName", currentUser.displayName);
            $.cookie("profilePicURL", currentUser.photoURL);
          
      }).catch(function(error){
          console.log("Error in signIn with google");
      })  
});
