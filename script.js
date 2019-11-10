jQuery(function($) {
  // alert('Hi! Welcome!');
  // });
  // jQuery(function($) {
  //     $('img#logo').attr('src', 'https://wpcloudcms.com/wp-content/themes/dividose-divi/images/logo.png');
  // });

  // Page Loader Starts
  
  $(".et_pb_text_overlay_wrapper h2 a:empty").parent().parent().css('background','rgba(255, 0, 0, 0)');
//   $(".et_pb_text_overlay_wrapper h2 a").parent().hide();
  //   sticky Side Menu ends
  
  $("ul#menu-primary-menu li ul.sub-menu").addClass("level1");
  $("ul#menu-primary-menu li ul.sub-menu>li ul.sub-menu ").removeClass("level1").addClass("level2");

  var isloading = false;
  // Append a div for the load icon
  $("#page-container").append("<div class='loader et-fb-icon et-fb-icon--loading'><a href='.' class='loading-spinner'><span></span></a><div class='loading-txt'>Loading... <div id='time_left'></div></div></div>");
  // When the page is loaded hide loader 
  // $(window).load(function() {
  $(".loader").hide();
  isloading = false;
  // })
  // When a link is clicked, display the loader unless it is one of the links listed
  $("a").not("a.um-profile-photo-img, li.yz-navbar-item>a, .gallery-icon a, .et_social_share, .um.um-account a, .pagination a, a[href*='#'],.uap-ap-wrap a, .uap-ap-menu li a, nav.bp-navs li a").click(function(e) {
    if (isloading === false) {
      $(".loader").fadeIn("slow");
    } else {
      $(".loader").hide();
      isloading = false;
    }
    var timeLeft = 3;
var elem = document.getElementById('time_left');
var timerId = setInterval(countdown, 1000);

function countdown() {
    if (timeLeft == -1) {
        clearTimeout(timerId);
        doSomething();
    } else {
        elem.innerHTML = 'Please, wait ' + timeLeft + ' Seconds!';
        timeLeft--;
    }
}
    setTimeout(function() {
        $(".loader").fadeOut('fast');
    }, 3000);
  })
  // Page Loader Ends

  //   $('#main-content-panel .entry').each(function() {
  //    if($(this).is(':contains("Replace Me")')) {
  //         $(this).css('color', 'red'); 
  //     }      
  //    });

  //inserting Header and Footer in theme Frontend

//   $("header#main-header").after($("#dividose-header"));
//   $("#dividose-header").show();
  $("#main-content").before($("#dividose-header"));
  $("#dividose-header").show();
  $("footer#main-footer").before($("#dividose-footer"));
  $("#dividose-footer").show();

  $("#dividose-header").each(function() {
    if (!$(this).text().trim().length) {
      $("#dividose-header").addClass("hide");
    }
  });
  $("#dividose-footer").each(function() {
    if (!$(this).text().trim().length) {
      $("#dividose-footer").addClass("hide");
    }
  });
 $("header#main-header").after($("#logo-site-title"));


  //   Hide Header and Footer when editing with Library

  //       if($('title').is(':contains("Header")')) {
  //         $('div#dividose-header').removeAttr("style").hide().addClass('remove-header');
  //         $('div#dividose-sidebar').removeAttr("style").hide().addClass('remove-sidebar');
  //         $('div#dividose-footer').removeAttr("style").hide().addClass('remove-footer');
  //         }    
  //        if($('title').is(':contains("Footer")')) {
  //          $('div#dividose-header').removeAttr("style").hide().addClass('remove-header');
  //          $('div#dividose-sidebar').removeAttr("style").hide().addClass('remove-sidebar');
  //         $('div#dividose-footer').removeAttr("style").hide().addClass('remove-footer');
  //         }    
// if(window.location.href.indexOf("indev") > -1) 
//             {
//                  alert("your url contains the name indev");
//             }

}); // Jquery end
