
  // This is called with the results from from FB.getLoginStatus().
  /*function statusChangeCallback(response) {
    console.log('statusChangeCallback');
    console.log(response);
    // The response object is returned with a status field that lets the
    // app know the current login status of the person.
    // Full docs on the response object can be found in the documentation
    // for FB.getLoginStatus().
    if (response.status === 'connected') {
      // Logged into your app and Facebook.
      testAPI();
    } else if (response.status === 'not_authorized') {
      // The person is logged into Facebook, but not your app.
      //document.getElementById('status').innerHTML = 'Please log ' +        'into this app.';
    } else {
      // The person is not logged into Facebook, so we're not sure if
      // they are logged into this app or not.
      //document.getElementById('status').innerHTML = 'Please log ' + 'into Facebook.';
    }
  }*/

  // This function is called when someone finishes with the Login
  // Button.  See the onlogin handler attached to it in the sample
  // code below.
  /*function checkLoginState() {
    FB.getLoginStatus(function(response) {
      statusChangeCallback(response);
    });
  }*/

  
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '967317043381283',// socialresident app id
      xfbml      : true,
      version    : 'v2.5'
    });
  

  // Now that we've initialized the JavaScript SDK, we call 
  // FB.getLoginStatus().  This function gets the state of the
  // person visiting this page and can return one of three states to
  // the callback you provide.  They can be:
  //
  // 1. Logged into your app ('connected')
  // 2. Logged into Facebook, but not your app ('not_authorized')
  // 3. Not logged into Facebook and can't tell if they are logged into
  //    your app or not.
  //
  // These three cases are handled in the callback function.

  /*FB.getLoginStatus(function(response) {
    statusChangeCallback(response);
  }); */

  };

  // Load the SDK asynchronously
  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));

  // Here we run a very simple test of the Graph API after login is
  // successful.  See statusChangeCallback() for when this call is made.
  function fb_login(){
  FB.login(function(response) {
   if (response.authResponse) {
     //  console.log(response);
	  // return false;
    //console.log('Welcome!  Fetching your information.... ');
    FB.api('/me',{fields: "id,age_range,email,gender,name,birthday,picture"},  function(userInfo) {
       //console.log(userInfo);
      //console.log('Successful login for: ' + userInfo.email);
      if(typeof userInfo.id != 'undefined') 
                        {
							var imagefb = "";
                          
                            //console.log('Successful login for: ' + userInfo.name);
                           // JSON.stringify(userInfo);
                            jQuery.ajax({
                            type: "POST",
                            url: "facebook_postvalues.php", 
                            //data: { Id: userInfo.id, name: userInfo.name, email: userInfo.email},
                         data: { Id: userInfo.id, name: userInfo.name, email: userInfo.email,gender:userInfo.gender,picture:imagefb,birthday:userInfo.birthday},
                            success: function(msg) {
                                     msg = msg.trim();
                                     //alert(msg); 
                                     //console.log(msg);return false; 
                                  if(msg=="loginfail"){
                                        alert("Login Fail");
                                  }else{
                                        //alert("Login Sucessfull.");
                                        //window.location='profile';
                                        document.location.reload(true);
                                        return false; 
                                    //window.history.go(-1);
                                  }
                                  return false;  
                            }   
                        });     
                        }
    });
  }
  }, {scope: 'public_profile,email,user_about_me'});
  }
