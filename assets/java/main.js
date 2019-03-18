var languages = [];

$( document ).ready(function() {
  // $.cookie(keyword+"Lang", "en");
  
  
  // SetLeague();
  update_login();
  setInterval(function(){ 
      update_login();
  }, 2 * 60 * 1000);
});


function SetLeague(){
  var lang      = $.cookie( keyword +"Lang");
  
  $.get( "language/getLang", { lang: lang }, function( arrData ) {
    var aData     = jQuery.parseJSON(arrData);
    languages     = aData;
    // $.each(aData,function(key ,row){
    //     $('.lang_' + key).html( row );
    // });
  });
}

function forLang(){
    // $.each(languages,function(key ,row){
    //   $('.lang_' + key).html( row );
    // });
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
      if (aData.status_flag == "false" || aData.status_flag == false) { 

        $.get( "login/logout", { }, function( arrData ) {  console.log("logout");    });

         location = "login";
      }
    });
}



$.fn.numOnly = function(){ 
    return this.each(function(){ 
        $(this).keydown(function (e) {
          if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 || (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || (e.keyCode >= 35 && e.keyCode <= 40)) {
              return;
          }
          if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
              e.preventDefault();
          }
      });
    });
}

$.fn.FullnumOnly = function(){ //ไม่เอา .
    return this.each(function(){ 
        $(this).keydown(function (e) {
          if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 || (e.keyCode === 65 && (e.ctrlKey === true || e.metaKey === true)) || (e.keyCode >= 35 && e.keyCode <= 40)) {
              return;
          }
          if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
              e.preventDefault();
          }
      });
    });
}