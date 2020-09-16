import $ from 'jquery';
import 'what-input';
// Foundation JS relies on a global variable. In ES6, all imports are hoisted
// to the top of the file so if we used `import` to import Foundation,
// it would execute earlier than we have assigned the global variable.
// This is why we have to use CommonJS require() here since it doesn't
// have the hoisting behavior.
window.$ = $;
window.jQuery = $;
import './touchSwipe';
import './easing';
require('foundation-sites');
import './scrollTo';

// If you want to pick and choose which modules to include, comment out the above and uncomment
// the line below
//import './lib/foundation-explicit-pieces';
$(document).foundation();
$(document).ready(function (){
    
    /*    Back to top button    
    var back_top = $('#back_top');

    back_top.click(function (e) {
        e.preventDefault();
        scrollTo(0, 900);
    });

    function scrollTo(target, speed) {
        $(window).scrollTo(target,speed,'easeInOutCubic');
    }

    $(window).on('scroll', function () {
        if ($(this).scrollTop() > 749) {
            back_top.stop().animate({ opacity: 1 }, 250);
        } else {
            back_top.stop().animate({ opacity: 0 }, 250);
        }
    });  
  */  
  
  var showClass = 'show';

  $('input').on('checkval', function () {
    var label = $(this).prev('label');
    if(this.value !== '') {
      label.addClass(showClass);
    } else {
      label.removeClass(showClass);
    }
  }).on('keyup', function () {
    $(this).trigger('checkval');
  });

});
