/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function (){
    $("li#item").click(function (){
        $("ul#opcoes").slideToggle('fast');
    });
});

$(document).ready(function(){
    $(".openBox").click(function(){
        
        $(".fullScreen").fadeIn("fast");
    });
 
    $(".button").click(function(){
        $(".fullScreen, .dialog").fadeOut("fast");
    });
});