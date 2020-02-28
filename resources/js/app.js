require('./bootstrap');
import Vue from 'vue'
import axios from 'axios'

$(document).ready(function(){
    $('#mobile-menu').click(function(){
        if($(this).hasClass('fas fa-bars')){
            $(this).removeClass("fas fa-bars");
            $(this).addClass("fas fa-times");

        }else{
            $(this).removeClass("fas fa-times");
            $(this).addClass("fas fa-bars");

        }
        $('#mobile-nav').slideToggle();
    })
})