$('#search-open').click(function () {
    $('body').removeClass('menu-open');
    $('body').addClass('search-open');
    setTimeout(function () {
        $('.header-right-section .globalSearchInput .search-container .form-control').focus();
    }, 50);
});
function gettabactive(name)
{
   if(name == 'product')
   {
       $('#product-tab').css('display','block');
       $('#service-tab').css('display','none');
       $('#inventory-tab').css('display','none');
       $('#websitesetting-tab').css('display','none');
       $('#crm-tab').css('display','none');
       $('#access_module-tab').css('display','none');
   }else if(name == 'service')
   {
        $('#product-tab').css('display','none');
        $('#service-tab').css('display','block');
        $('#inventory-tab').css('display','none');
        $('#websitesetting-tab').css('display','none');
        $('#crm-tab').css('display','none');
        $('#access_module-tab').css('display','none');
   }else if(name == 'inventory')
   {
       
        $('#product-tab').css('display','none');
        $('#service-tab').css('display','none');
        $('#inventory-tab').css('display','block');
        $('#websitesetting-tab').css('display','none');
        $('#crm-tab').css('display','none');
        $('#access_module-tab').css('display','none');
   }
   else if(name == 'websitesetting')
   {
        $('#product-tab').css('display','none');
        $('#service-tab').css('display','none');
        $('#inventory-tab').css('display','none');
        $('#websitesetting-tab').css('display','block');
        $('#crm-tab').css('display','none');
        $('#access_module-tab').css('display','none');
   }
    else if(name == 'crm')
   {
        $('#product-tab').css('display','none');
        $('#service-tab').css('display','none');
        $('#inventory-tab').css('display','none');
        $('#websitesetting-tab').css('display','none');
        $('#crm-tab').css('display','block');
        $('#access_module-tab').css('display','none');
   }
    else if(name == 'access_module')
   {
       alert(name);
        $('#product-tab').css('display','none');
        $('#service-tab').css('display','none');
        $('#inventory-tab').css('display','none');
        $('#websitesetting-tab').css('display','none');
        $('#crm-tab').css('display','none');
        $('#access_module-tab').css('display','block');
         
   }
   
}

$('.searchCloseIcon').click(function () {
    $('body').removeClass('search-open');
});
 
 function gettoggle()
 {
    $('body').removeClass('search-open');
    $('body').toggleClass('menu-open');
 }


$("#ul-menu-list li").click(function () {
    $('.box').hide().eq($(this).index()).show();
});
$('.cm-menu-close-icon').click(function () {
    $('body').removeClass('menu-open');
});

$('.custom-dropdown-menu').click(function (e) {
    e.stopPropagation();
});

$('.listFilterContainer-inner #listFilter').click(function () {
    $(this).toggleClass('active');
});

//popup open
$('#Contacts_listView_addRecord').click(function (e) {
    e.stopPropagation();
    $('body').toggleClass('show-popup');
});

$('body, .modal-header .close').click(function () {
    $('body').removeClass('show-popup');
});

$('.modal-content').click(function (e) {
    e.stopPropagation();
});