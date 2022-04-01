  // Navigation (cố định thanh nav góc trên khi cuộn trang) 
  $(function() {
   var sticky_navigation_offset_top = $('#stick').offset().top;
   var sticky_navigation = function(){
    var scroll_top = $(window).scrollTop(); 
    
    if (scroll_top > sticky_navigation_offset_top) { 
     $('#stick').css({ 'position': 'fixed', 'top':0, 'left':0 });
    } else {
     $('#stick').css({ 'position': 'relative' }); 
    }   
   };
   
   sticky_navigation();
   
   $(window).scroll(function() {
     sticky_navigation();
   });
   
   // NOT required:
   // for this demo disable all links that point to "#"
   $('a[href="#"]').click(function(event){ 
    event.preventDefault(); 
   });
   
  });

  // =================================================
  // Banner (đổi ảnh banner sau 3 giây)
  window.onload = function(){
    setTimeout("switch_Image()", 3000);
  }
  var current = 1;
  var num_image =2;
  function switch_Image(){
      current++;
      document.images['bannerpic'].src ='images/bia' + current + '.jpg';
     if(current < num_image){
       setTimeout("switch_Image()", 3000);
     }else if(current == num_image){
       current = 0;
       setTimeout("switch_Image()", 3000);
     }
  }