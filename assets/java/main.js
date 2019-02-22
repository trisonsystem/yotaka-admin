var languages = [];

$( document ).ready(function() {
  $.cookie(keyword+"Lang", "en");
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