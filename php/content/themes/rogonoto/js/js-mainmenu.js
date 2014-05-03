jQuery(function(){jQuery("<select />").appendTo("nav");
jQuery("<option />",{selected:"selected",value:"",text:"Main Menu"}).appendTo("nav select");
jQuery("nav a").each(function(){var a=jQuery(this);
jQuery("<option />",{value:a.attr("href"),text:a.text()}).appendTo("nav select")});
jQuery("nav select").change(function(){window.location=jQuery(this).find("option:selected").val()})});