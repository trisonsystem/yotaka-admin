var languages = [];

$( document ).ready(function() {
  // $.cookie(keyword+"Lang", "en");
  
  update_login();
  SetLeague();
  
});


function SetLeague(){
  var lang      = $.cookie( keyword +"Lang");
  $.get( "language/getLang", { lang: lang }, function( arrData ) {
    var aData     = jQuery.parseJSON(arrData);
    languages     = aData;
    $.each(aData,function(key ,row){
        $('.lang_' + key).html( row );
    });
  });
}

function forLang(){
    $.each(languages,function(key ,row){
      $('.lang_' + key).html( row );
    });
}

function changeLang(lang){

    // $.get( "language/change_lang", { lang: lang }, function( arrData ) {
      $.removeCookie(keyword+"Lang");
      $.cookie(keyword+"Lang", lang);
      location.reload();
    // });
}

var si_update_login;
function update_login(){
  
      $.get( "login/update_login", { }, function( arrData ) {
        var aData     = jQuery.parseJSON(arrData);
        console.log( aData.status_flag );
        if (aData.status_flag == "false") { 
           location = "login";
        }
      });
  setInterval(function(){ 
      update_login();
  }, 10000);
    
}