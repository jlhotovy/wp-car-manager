jQuery(document).ready(function() {

// make price and mileage required and change placeholder text for both  
    jQuery('#price.wpcm-input-text').parent().addClass('wpcm-required-field');
    jQuery('#price.wpcm-input-text').attr('placeholder', '10000 - Numerics only');
    jQuery('#mileage.wpcm-input-text').parent().addClass('wpcm-required-field');
    jQuery('#mileage.wpcm-input-text').attr('placeholder', '150000 - numerics only');
    
// hide the h2 header element before car details
    jQuery('#content.site-content .wpcm-fieldset-condition').prev('h2').css("display","none");
    
// change class name on the parent fieldset for description - original source had it as wpcm-fieldset-title
    jQuery('#content.site-content .wpcm-fieldset-title #description').parent().parent().attr('class','wpcm-fieldset-description');
    
// change label of description to Year for use as year dropdown
    jQuery('#content.site-content .wpcm-fieldset-description label').attr('for','description').text('Year')
    
// change label of contact button on car listing page
    jQuery('.wpcm-contact-button').text('Contact Seller')
    
// change URI of sign-in button on car listing page
    jQuery('.wpcm-car-form fieldset div.wpcm-account-sign-in .button').attr('href','/login/')
    
//change URI of sign-in text on my car listing page
    jQuery('#main.site-main .entry-content a:contains(Please)').attr('href','/login/')

//Remove display dashboard after car submission
    jQuery('.wpcm-submitted-actions').css('display', 'none')

// Remove logout option when selecting login while already logged in
    jQuery('.wppb-alert a').remove('')
  
// create description as dropdown for year
    jQuery(function(){
      var options="";
      var endingYear=2025;
      for(var i=1960;i<=endingYear;i++)
      {
         options+="<option value='"+i+"'>"+i+"</option>";
      }       
    jQuery('#description').replaceWith('<select id="description" name="wpcm_submit_car[description]" tabindex="-1"class="wpcm-input-text">' +
          '<option value="0">Select Year</option>' + options +
          '</select>');
    })   
    
// Hide datepicker for year
    jQuery('.wpcm-fieldset-frdate').css('display', 'none'); 
    
// create default datepicker date using year selected in date      
    jQuery('#wpcm-car-form.wpcm-car-form').submit(function(e){
       var yearin = jQuery('#description').val();
       //alert(yearin);
       var datein = yearin + '/01/01';
       //alert(datein);
       jQuery("#frdate").datepicker('setDate', new Date(datein));
       var newdate = jQuery('#frdate').val();
       //alert(newdate);
       var desc = jQuery("#description").val() + ' ' + jQuery("#make option:selected").text() + ' ' + jQuery("#model option:selected").text();
       jQuery('#title').val(desc);
    });
    
// hide discription from additional pages
    jQuery('#wpcm-vehicle-content').remove();
    jQuery('.entry-summary').remove();

// Misc changes to spacing of objects and font sizes
    jQuery('h1.entry-title').css('font-size','3em');
    jQuery('h2.entry-title').css('font-size','3em');
    jQuery('a.wpcm-button').css('margin-left','20px');
    jQuery('header.entry-header').css('margin-bottom','5px');
    jQuery('header.entry-header').css('margin-top','5px'); 
    jQuery('p').css('font-size','18px').css('color','blue').css('font-weight','800');
    jQuery('h3').css('font-size','18px').css('color','blue').css('font-weight','800');
    jQuery('li').css('color','blue').css('font-weight','800');
    jQuery('.menu-item').css('font-size','16px').css('font-weight','800');
    jQuery('.wpcm-vehicle-data').css('font-size','16px').css('font-weight','800');
    jQuery('.wpcm-dashboard-item-data').css('font-size','16px').css('font-weight','800');
    jQuery('.wpcm-listings-item-description').css('font-size','16px').css('font-weight','bold');
    jQuery('.wpcm-listings-item-data').css('font-size','16px').css('font-weight','bold');

//  ensure only numeric(no punctuation) in price field    
    jQuery("#price").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter 
        if (jQuery.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: Ctrl+C
            (e.keyCode == 67 && e.ctrlKey === true) ||
             // Allow: Ctrl+X
            (e.keyCode == 88 && e.ctrlKey === true) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    
// ensure only numeric(no punctuation) in mileage    
    jQuery("#mileage").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter 
        if (jQuery.inArray(e.keyCode, [46, 8, 9, 27, 13, 110]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: Ctrl+C
            (e.keyCode == 67 && e.ctrlKey === true) ||
             // Allow: Ctrl+X
            (e.keyCode == 88 && e.ctrlKey === true) ||
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    
// This function will capture the year from the title and populate the year in descripton drop down on edit  
    jQuery(function() {
        if (jQuery('#title').length) {
            if (jQuery('#title').val().length != 0) {
              
                var titleYear = jQuery('#title').val().substr(0, 4);
//                alert(titleYear);   
                jQuery('#description').val(titleYear);

            }              
        }               
    })
});

      
/*saved for testing purposes
jQuery('.button.wpcm-button').click(function(e){
    alert('Submit clicked');
});
jQuery('#wpcm-car-form.wpcm-car-form').submit(function(e){
    alert('Submit clicked');
});
*/
