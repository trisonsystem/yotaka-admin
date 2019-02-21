var languages = [];

$( document ).ready(function() {
  SetLeague();
});


function SetLeague(){
  var lang      = $.cookie( keyword +"Lang");
  $.get( "language/getLang", { lang: lang }, function( arrData ) {

    var aData     = jQuery.parseJSON(arrData);
    var datalang  = aData.lang;
    var FLang     = aData.txtLng;

    if (arrData.length > 2) {

      languages = datalang;

      $.each(datalang,function(key ,row){
        $('.lang_' + key).html( row );
      });

    }

    var strHTML = "<a class='"+lang+"'>"+FLang+"</a>";
    $('.current_language_lang').html( strHTML );
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