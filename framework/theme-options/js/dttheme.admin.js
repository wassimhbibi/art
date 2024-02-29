jQuery.noConflict();
var dtthemeAdmin = {
  init : function(){
    
    "use strict";
    dtthemeAdmin.adminPanelTab();
    
    dtthemeAdmin.adminPanelTooltipHelp();
    
    dtthemeAdmin.mediaUpload(); //upload logo ,favicon ...
    
    dtthemeAdmin.layoutSelect();
	
    dtthemeAdmin.postLayoutSelect();

	dtthemeAdmin.dtLayoutSelect();

    dtthemeAdmin.widgetAdd();
	
    dtthemeAdmin.menuAdd();
    
    dtthemeAdmin.menuRemove();
    
    dtthemeAdmin.menuCancel();
    
    dtthemeAdmin.menuEdit();
	
	dtthemeAdmin.menuSort();
	
    dtthemeAdmin.adminOptionSave(); // when clicking the submit button in the options page , adminOptionSave() will be triggred and it will calls the adminOptionFormSubmit()
    
    dtthemeAdmin.adminOptionFormSubmit();
    
    dtthemeAdmin.resetConfirm(); //To reset the admin panel saved options
    
    dtthemeAdmin.colorPicker();
    
    dtthemeAdmin.themeLayoutChooser();
    
    dtthemeAdmin.customSwitch();
    
    dtthemeAdmin.customUISlider();
    
    dtthemeAdmin.backgroundPicker(); // Used in appearance tab at layout section in choosing Background type combo
	
	dtthemeAdmin.customSkinColor();
    
    dtthemeAdmin.sliderTypePicker(); // Used in Every post page
    
    dtthemeAdmin.pageTemplateChooser();
	
    dtthemeAdmin.postFormatChooser();

    dtthemeAdmin.galleryPostFormatUploadImage();

    dtthemeAdmin.addItem();
    dtthemeAdmin.removeItem();

	//For Backup Tab in admin Panel
	dtthemeAdmin.backupOption();
	dtthemeAdmin.restoreOption();
		
  },// init() End
  
  adminPanelTab : function(){
    "use strict";
   var  $tab = jQuery('#bpanel,#bpanel div.bpanel-content');
    if($tab.length) {
		$tab.tabs({ show:500  });
    }
  },//adminPanelTab 

  adminPanelTooltipHelp: function(){
    "use strict";
    var $item = jQuery("div.bpanel-option-help a");	
    $item.on('click',function(e){ e.preventDefault(); });
    
    $item.each(function(){
      jQuery(this).on('mouseover', function(){
        var $x1 = -4, $y1 = -138;
        if(jQuery(this).hasClass('a_image_preivew')){
          $x1 = -25,
          $y1 = -150;
        }
        
        jQuery(this).tooltip({
          predelay:0,
          opacity: 0.9,
          effect:'slide',
          direction:'right',
          relative:true,
          tipClass:'bpanel-option-help-tooltip',
          delay: 500,
          offset: [$x1,$y1]
         });
        jQuery(this).tooltip().show();
      });
    });
  },//adminPanelTooltipHelp  
  
  mediaUpload: function(){
    "use strict";

	jQuery( ".upload_image_button" ).on('click', function( event ) {
		event.preventDefault();

		var custom_file_frame = null;
		var item_clicked = jQuery(this);

		// Create the media frame.
		custom_file_frame = wp.media.frames.customHeader = wp.media({
			title: jQuery(this).data( "choose" ),
			button: {
				text: jQuery(this).data( "update" )
			}
		});

		custom_file_frame.on( "select", function() {
			var attachment = custom_file_frame.state().get( "selection" ).first();
			item_clicked.parent().find('.uploadfield').val(attachment.attributes.url).trigger('change');
			item_clicked.parent().find('img:last').attr('src', attachment.attributes.url);
		});

		custom_file_frame.open();
	});

	jQuery( ".upload_image_reset" ).on('click', function( event ) {
		event.preventDefault();
		
		var item_clicked = jQuery(this);
		item_clicked.parent().find('.uploadfield').val('');
		var $temp = item_clicked.parent().find('img:last').attr('data-default');
		item_clicked.parent().find('img:last').attr('src', $temp);
	});
  },//mediaUpload

  layoutSelect : function(){
    jQuery("#page-layout").find("a").on('click',function(e){
      var $parent = jQuery(this).parents(".bpanel-layout-set"),
      $input = $parent.next(":input");

      if( !jQuery(this).hasClass("selected") ) {
          $parent.find("a.selected").removeClass("selected");
          $input.val(jQuery(this).attr("rel"));
          jQuery("#page-layout").find("a.selected").removeClass("selected");
          jQuery(this).addClass("selected");
      }
	  
      var $container = jQuery(".sidebar-section");
	  var $section = jQuery("#widget-area-options");
	  var $sidebar_primary = jQuery(".page-left-sidebar");
	  var $sidebar_secondary = jQuery(".page-right-sidebar");
	  var $sidebar_pages = jQuery(".page-widgetareas"); 

      if( $container.length ) {
		 $section.attr('style','');
        if( jQuery(this).attr("rel") == "content-full-width" || jQuery(this).attr("rel") == "fullwidth-container" ) {
		  $sidebar_primary.slideUp();
		  $sidebar_secondary.slideUp();
		  $sidebar_pages.slideUp();
		} else if( jQuery(this).attr("rel") == "with-left-sidebar") {
		  $sidebar_primary.slideDown();
		  $sidebar_secondary.slideUp();
		  $sidebar_pages.slideDown();
		} else if( jQuery(this).attr("rel") == "with-right-sidebar") {
		  $sidebar_primary.slideUp();
		  $sidebar_secondary.slideDown();
		  $sidebar_pages.slideDown();
        }else{
		  $sidebar_primary.slideDown();
		  $sidebar_secondary.slideDown();
		  $sidebar_pages.slideDown();
        }
      }
      e.preventDefault();
    });
  },
  
  postLayoutSelect: function(){
   jQuery(".bpanel-post-layout").each(function(){
	   
      jQuery(this).find("a").on('click',function(e){
        var $parent = jQuery(this).parents(".bpanel-layout-set"),
            $input = $parent.next(":input"),
			$item = $parent.attr("id");
        if( !jQuery(this).hasClass("selected") ) {
          $parent.find("a.selected").removeClass("selected");
          $input.val(jQuery(this).attr("rel"));
          jQuery(this).addClass("selected");
        }

      var $container = jQuery("." + $item + " .bpanel-sidebar-section");
	  var $sidebar_primary = jQuery("." +$item + " .bpanel-page-left-sidebar");
	  var $sidebar_secondary = jQuery("." +$item + " .bpanel-page-right-sidebar");
	  var $sidebar_pages = jQuery("." +$item + " .bpanel-page-widgetareas"); 

      if( $container.length ) {
		jQuery("div."+$item).attr('style','');
        if( jQuery(this).attr("rel") == "content-full-width") {
		  $sidebar_primary.slideUp();
		  $sidebar_secondary.slideUp();
		  $sidebar_pages.slideUp();
		} else if( jQuery(this).attr("rel") == "with-left-sidebar") {
		  $sidebar_primary.slideDown();
		  $sidebar_secondary.slideUp();
		  $sidebar_pages.slideDown();
		} else if( jQuery(this).attr("rel") == "with-right-sidebar") {
		  $sidebar_primary.slideUp();
		  $sidebar_secondary.slideDown();
		  $sidebar_pages.slideDown();
        }else{
		  $sidebar_primary.slideDown();
		  $sidebar_secondary.slideDown();
		  $sidebar_pages.slideDown();
        }
	  }
        e.preventDefault();
		
      });
	  
    });
  },

  dtLayoutSelect : function() {
	  jQuery(".dt-bpanel-layout-set").each(function() {
		  jQuery(this).find("a").on('click',function(e) {

			  var $parent = jQuery(this).parents(".dt-bpanel-layout-set");
			  var $input = $parent.next(":input");

			  if (jQuery(this).hasClass("selected")) {
				  jQuery(this).removeClass("selected");
				  $input.val("");
			  } else {
				  $parent.find("a.selected").removeClass("selected");
				  $input.val(jQuery(this).attr("rel"));
				  jQuery(this).addClass("selected");
			  }

			  e.preventDefault();
		  });
	  });
  },

  widgetAdd: function(){
   jQuery('.dttheme_add_widgetarea').on('click',function(e){
     var $this = jQuery(this).parent().next(),
     $widgetfor = jQuery(this).data('for'),
     $appendTo = $this.find('.added-menu'),
     $itemToClone = $this.find('.sample-to-edit li'),
     $item = $appendTo.find('li'),
     $itemsCount = $item.length,
     $allIds = []; //$allIds = new Array();
     
     $item.each(function(){
       if(jQuery(this).attr('id')){
         var $itemId = jQuery(this).attr('id').match(/\d+/g);
         if($itemId){
           $allIds.push(parseInt($itemId,10));
         }
       }
     }); //end each
  
        var $newID = (jQuery($appendTo).css('display') === 'none' )? $itemsCount : $itemsCount+1;
        while (jQuery.inArray($newID, $allIds) !== -1 ) {
          $newID++;
        }
      
      var $newClone = $itemToClone.clone().attr('id',"widgetarea-"+$newID);
        $newClone.find(".social-link").attr('name',"dttheme[widgetarea]["+$widgetfor+"][]");
        $newClone.find(".item-title").text("Widget Area "+ $newID);
      
      var $newAppend = jQuery($appendTo).append(function(index,html){
        return $newClone;
      });
      e.preventDefault();
     
   });
  }, //widgetAdd
  
  menuAdd : function(){
    "use strict";
    jQuery('.dttheme_add_item').on('click',function(e){
      var $this = jQuery(this).parent().next(),
          $appendTo = $this.find('.menu-to-edit'),
          $itemToClone = $this.find('.sample-to-edit li'),
          $item = $appendTo.find('li'),
          $itemsCount = $item.length,
          $allIds = []; //$allIds = new Array();
      
      $item.each(function(){
        if(jQuery(this).attr('id')){
          var $itemId = jQuery(this).attr('id').match(/\d+/g);
          if($itemId){
            $allIds.push(parseInt($itemId,10));
          }
        }
      }); //end each
      
      var $newID = (jQuery($appendTo).css('display') === 'none' )? $itemsCount : $itemsCount+1;
      while (jQuery.inArray($newID, $allIds) !== -1 ) {
        $newID++;
      }
      
      var $newClone = $itemToClone.clone().attr('id',"social-"+$newID);
      $newClone.find(".social-select").attr('name',"dttheme[social][social-"+$newID+"][icon]");
      $newClone.find(".upload_image_button").attr('name',"dttheme[social][social-"+$newID+"][custom-image]");
      $newClone.find(".social-link").attr('name',"dttheme[social][social-"+$newID+"][link]");
      $newClone.find(".item-title").text("Sociable "+ $newID);
      
      var $newAppend = jQuery($appendTo).append(function(index,html){
        return $newClone;
      });
      e.preventDefault();
    });
  jQuery('.dttheme_add_group_item').on('click',function(e){
      var $this = jQuery(this).parent().next(),
          $appendTo = $this.find('.menu-to-edit'),
          $itemToClone = $this.find('.sample-to-edit li'),
          $item = $appendTo.find('li'),
          $itemsCount = $item.length,
          $allIds = []; //$allIds = new Array();
      
      $item.each(function(){
        if(jQuery(this).attr('id')){
          var $itemId = jQuery(this).attr('id').match(/\d+/g);
          if($itemId){
            $allIds.push(parseInt($itemId,10));
          }
        }
      }); //end each

      var $newID = (jQuery($appendTo).css('display') === 'none' )? $itemsCount : $itemsCount+1;
      while (jQuery.inArray($newID, $allIds) !== -1 ) {
        $newID++;
      }

      var $newClone = $itemToClone.clone().attr('id',"button-"+$newID);
      $newClone.find(".button-label").attr('name',"dttheme[privacy-bar][button-"+$newID+"][label]");
      $newClone.find(".button-select").attr('name',"dttheme[privacy-bar][button-"+$newID+"][action]");
    $newClone.find(".button-link").attr('name',"dttheme[privacy-bar][button-"+$newID+"][link]");
      $newClone.find(".item-title").text("Button "+ $newID);

      var $newAppend = jQuery($appendTo).append(function(index,html){
        return $newClone;
      });
      e.preventDefault();
    });

    jQuery('.dttheme_add_tab_item').on('click',function(e){
      var $this = jQuery(this).parent().next(),
          $appendTo = $this.find('.menu-to-edit'),
          $itemToClone = $this.find('.sample-to-edit li'),
          $item = $appendTo.find('li'),
          $itemsCount = $item.length,
          $allIds = []; //$allIds = new Array();
      
      $item.each(function(){
        if(jQuery(this).attr('id')){
          var $itemId = jQuery(this).attr('id').match(/\d+/g);
          if($itemId){
            $allIds.push(parseInt($itemId,10));
          }
        }
      }); //end each

      var $newID = (jQuery($appendTo).css('display') === 'none' )? $itemsCount : $itemsCount+1;
      while (jQuery.inArray($newID, $allIds) !== -1 ) {
        $newID++;
      }

      var $newClone = $itemToClone.clone().attr('id',"tab-"+$newID);
      $newClone.find(".tab-label").attr('name',"dttheme[privacy-model][tab-"+$newID+"][label]");
    $newClone.find(".tab-content").attr('name',"dttheme[privacy-model][tab-"+$newID+"][content]");
      $newClone.find(".item-title").text("Tab "+ $newID);

      var $newAppend = jQuery($appendTo).append(function(index,html){
        return $newClone;
      });
      e.preventDefault();
    });
  },//menuAdd  

  menuRemove: function(){
    "use strict";
    jQuery(document).on('click', '.remove-item', function(e){
      var $this = jQuery(this).parent().parent().parent();
      $this.addClass('deleting').animate({opacity : 0,height: 0},350,function(){ $this.remove();});
      e.preventDefault();
    });
  },//menuRemove

  menuCancel: function(){
    "use strict";
    jQuery(document).on('click', '.cancel-item', function(e){
      jQuery(this).parents('.item-content').slideToggle('fast');
      e.preventDefault();
    });
  }, //menuCancel
  
  menuEdit: function(){
    "use strict";
    jQuery(document).on('click', '.item-edit', function(e){
      jQuery(this).parents('.item-bar').next(".item-content").slideToggle('fast');
      e.preventDefault();
    });
  },//menuEdit

  menuSort: function(){
    "use strict";
    jQuery(".menu-to-edit, .menu-to-edit-team").sortable({placeholder: 'sortable-placeholder'});
  },//menuSort
  
  adminOptionSave: function(){
    "use strict";
    jQuery('.dttheme-footer-submit').on('click',function(e){
	  try {
		  if( tinymce.get('notfound_content') ){
			  jQuery('#notfound_content').html( tinymce.get('notfound_content').getContent() );
		  } else {
			  jQuery('#notfound_content').html( jQuery('#notfound_content').val() );
		  }
		  if( tinymce.get('comingsoon_top_content') ){
			  jQuery('#comingsoon_top_content').html( tinymce.get('comingsoon_top_content').getContent() );
		  } else {
			  jQuery('#comingsoon_top_content').html( jQuery('#comingsoon_top_content').val() );
		  }
	  } catch (err) {
		  // console.log(err);
	  }
	  jQuery('form#dttheme_options_form').submit();
      e.preventDefault();
    });
  },//adminOptionSave

  adminOptionFormSubmit: function(){
    "use strict";
    jQuery('form#dttheme_options_form').submit(function(e){
    	
    	jQuery(".dttheme-footer-submit").val(objectL10n.saving).addClass("dttheme-footer-saving");
    	if(jQuery('#dttheme-full-submit').val() === '1'){
    		return true;
    	} else {
    		var formData = jQuery(this),
    			optionSave = jQuery("<input>", { type: "text", name:"dttheme-option-save", val: true }),
    			postData = formData.add(optionSave).serialize();
    		
    	        dtthemeAdmin.ajaxSubmit(postData);
    	}
    	e.preventDefault();
    });
  },//adminOptionFormSubmit

  ajaxSubmit: function(postData){
    "use strict";
    jQuery.ajax({
      type: 'POST',
      dataType: 'json',
      data: postData,
      beforeSend: function(x) {
        if(x && x.overrideMimeType) { x.overrideMimeType('application/json;charset=UTF-8'); }
      },
      success: function(data) {
        dtthemeAdmin.processJSON(data);
      }
    });
  },//ajaxSubmit
  
  processJSON: function(data){
    "use strict";
    var popup = jQuery('#bpanel-message');
	popup.empty().removeClass("warning").addClass("success");
	popup.append(data.message);
	  
	popup.fadeIn();
	
	window.setTimeout(function(){ 
		popup.fadeOut('slow');
		jQuery(".dttheme-footer-submit").val(objectL10n.saveall).removeClass("dttheme-footer-saving");
	}, 2000);
    
  }, //processJSON
  
  colorPicker: function(){
    "use strict";
	jQuery('.dt-color-field').each(function(){
		jQuery(this).wpColorPicker();
	});
  }, //colorPicker
  
  resetConfirm : function (){
    "use strict";
    jQuery('.dttheme-reset-button').on('click',function(e){
    	e.preventDefault();
      if(confirm(objectL10n.resetConfirm)){
    	  
    	  var data =  { action : 'redart_backup_and_restore_action', type:'reset_options'};
    	  jQuery.post(ajaxurl, data,function(response){
            var response = response.trim();
    		  if( response === "1" ) {
    			  window.location.reload();
    		  }
    	  });
    	  
      }
    });
  }, //resetConfirm
 
  themeLayoutChooser:function(){
    "use strict";
    jQuery("li.themelayout").each(function(){
      jQuery(this).find("a").on('click',function(e){
        var $layout = jQuery(this).attr("rel");
        if($layout === "boxed"){
          jQuery("div#"+$layout).css({'display':'block'});
        }else{
          jQuery("div#boxed").css({'display':'none'});
        }
        e.preventDefault();
      });
    });
  },//themeLayoutChooser

  customSwitch: function(){
    "use strict";
    jQuery("div.checkbox-switch").each(function(){
      jQuery(this).on('click',function(){
        var $ele = '#'+jQuery(this).attr("data-for");
        jQuery(this).toggleClass('checkbox-switch-off checkbox-switch-on');
        if(jQuery(this).hasClass('checkbox-switch-on')){
          jQuery($ele).prop("checked",true);
        }else{
          jQuery($ele).removeAttr("checked");
        }
      });//click end
    }); //switch end
  },//customSwitch

  customUISlider: function(){
    "use strict";
    jQuery("div.dttheme-slider").each(function(){
		
      var bar_id = jQuery(this).attr('id'),
          px = jQuery(this).attr('data-for'),
          min_val = 0,
          max_val = 1,
          val = 0.1;
      
      if(px === "px"){
        min_val = 0;
        max_val = 100;
        val = 1;
      }
      
      var init_val = jQuery(this).siblings('input[name="' + bar_id + '"]').attr('value');
      
      jQuery(this).slider({
        min:min_val,
        max:max_val,
        step:val,
        value: init_val,
        slide: function(event, ui){
          jQuery(this).siblings('input[name="' + bar_id + '"]').attr('value',ui.value);
          jQuery(this).siblings('.dttheme-slider-txt').html(ui.value+px);
        }
      });//SLider End
      
    }); // dttheme-slider end
  }, //customUISlider
  
  backgroundPicker: function(){
    "use strict";
    jQuery("select.bg-type").change(function(){
      if(jQuery(this).val() === "bg-patterns"){
        jQuery(this).parents('div.bpanel-option-set').siblings(".bg-pattern").slideDown();
        jQuery(this).parents('div.bpanel-option-set').siblings(".bg-custom").slideUp();
      }else if(jQuery(this).val() === "bg-custom"){
        jQuery(this).parents('div.bpanel-option-set').siblings(".bg-pattern").slideUp();
        jQuery(this).parents('div.bpanel-option-set').siblings(".bg-custom").slideDown();
      }else{
        jQuery(this).parents('div.bpanel-option-set').siblings(".bg-custom").slideUp();
        jQuery(this).parents('div.bpanel-option-set').siblings(".bg-pattern").slideUp();
      }
    });//change End
  }, //backgroundPicker

  customSkinColor: function(){
    "use strict";
    jQuery("select.skin-types").change(function(){
      if(jQuery(this).val() === "custom"){
        jQuery(this).parents('div.box-content').find(".custom-skin-panel").slideDown();
      }else{
        jQuery(this).parents('div.box-content').find(".custom-skin-panel").slideUp();
		 jQuery('.custom-skin-panel').find('input.wp-color-picker').val('');
      }
    });//change End
  }, //customSkinColor

  sliderTypePicker: function(){
    "use strict";
    jQuery("select.slider-type").change(function(){
      var $val  = jQuery(this).val(),
          //$parent = jQuery(this).parents("div.inside").find("div#slider-conainer");
		  $parent = jQuery("div#slider-conainer");
      
      switch ($val){
          case 'layerslider':
          case 'revolutionslider':
		  case 'customslider':
          jQuery($parent).find("> div:not(#"+$val+")").slideUp();
          $parent.find("#"+$val).slideDown();
          break;
            
          default:
          jQuery($parent).find("> div").slideUp();
          break;
          
      }//End Switch
      
    });//Change End
  }, //sliderTypePicker

  pageTemplateChooser: function(){
    "use strict";
    var $ptemplate_select = jQuery('select#page_template'),
        $ptemplate_box = jQuery('#page-template-meta-container');

    if( !$ptemplate_select.length ) {
      if(jQuery("body").hasClass("post-type-page")){
        new PageTemplateSwitcher().init();
      }
    }
    if( $ptemplate_select.length ) {
    jQuery('select#page_template').change(function(){
			var $val = jQuery(this).val();
			$ptemplate_box.find('.j-pagetemplate-container > div').slideUp();
			
			switch($val){
				case 'tpl-blog.php':
					$ptemplate_box.find('h2').text('Blog Options');
					$ptemplate_box.slideDown();
					$ptemplate_box.find('#tpl-common-settings').slideDown();
					$ptemplate_box.find('#tpl-blog').slideDown();
          			$ptemplate_box.find("#page-commom-sidebar").slideDown();
			        $ptemplate_box.find("#page-layout").slideDown();
					
					jQuery("#page-template-slider-meta-container").slideUp();
				break;
				
				case 'tpl-portfolio.php':
					$ptemplate_box.find('h2').text('Portfolio Options');
			        $ptemplate_box.slideDown();					
					$ptemplate_box.find('#tpl-common-settings').slideDown();
					$ptemplate_box.find('#tpl-portfolio').slideDown();
          			$ptemplate_box.find("#page-commom-sidebar").slideDown();
					$ptemplate_box.find("#page-layout").slideDown();

					jQuery("#page-template-slider-meta-container").slideUp();
				break;

				case 'tpl-fullwidth.php':
					$ptemplate_box.find('h2').text('Full Width page Options');
					$ptemplate_box.slideDown();
					$ptemplate_box.find('#tpl-common-settings').slideDown();
					jQuery("#page-template-slider-meta-container").slideDown();
		  
					$ptemplate_box.find("#page-commom-sidebar").slideUp();
					$ptemplate_box.find("#page-layout").slideUp();
				break;

				case 'tpl-onepage.php':
					$ptemplate_box.find('h2').text('One page Options');
					$ptemplate_box.slideDown();
					$ptemplate_box.find('#tpl-common-settings').slideDown();
					$ptemplate_box.find('#tpl-onepage-settings').slideDown();
					jQuery("#page-template-slider-meta-container").slideDown();

					$ptemplate_box.find("#page-commom-sidebar").slideUp();
					$ptemplate_box.find("#page-layout").slideUp();
				break;

				case 'tpl-home.php':
					$ptemplate_box.find('h2').text('Extra Home page Options');
					$ptemplate_box.slideDown();
					$ptemplate_box.find('#tpl-common-settings').slideDown();
					jQuery("#page-template-slider-meta-container").slideDown();
		  
					$ptemplate_box.find("#page-commom-sidebar").slideUp();
					$ptemplate_box.find("#page-layout").slideUp();
					
				break;

				default:
					$ptemplate_box.find('h2').text('Default page Options');
					$ptemplate_box.find('#tpl-common-settings').slideDown();
          			$ptemplate_box.find("#page-commom-sidebar").slideDown();
					$ptemplate_box.find("#page-layout").slideDown();

					jQuery("#page-template-slider-meta-container").slideDown();
				break;
			}//End Switch
		});//change end
		$ptemplate_select.trigger('change');
	} else {
		$ptemplate_box.find('.j-pagetemplate-container > div').slideUp();
		$ptemplate_box.find('h2').text('Posts Page Options');
		$ptemplate_box.find('#tpl-common-settings').slideDown();
		$ptemplate_box.find("#page-commom-sidebar").slideDown();
		$ptemplate_box.find("#page-layout").slideDown();

		jQuery("#page-template-slider-meta-container").slideDown();
	}
  }, //pageTemplateChooser

  postFormatChooser: function(){
    $ptemplate_box = jQuery('#post-format-meta-container');
    $ptemplate_box.hide();

    jQuery("input[name='post_format']").change(function() {
      var selectedElt = jQuery("input[name='post_format']:checked").val();
      switch( selectedElt ){
        case 'gallery':
          $ptemplate_box.show();
          $ptemplate_box.find("#dt-post-format-gallery").slideDown();
          $ptemplate_box.find("#dt-post-format-video-audio").slideUp();
        break;

        case 'video':
        case 'audio':
          $ptemplate_box.show();
          $ptemplate_box.find("#dt-post-format-gallery").slideUp();
          $ptemplate_box.find("#dt-post-format-video-audio").slideDown();
        break;
        
        default:
          $ptemplate_box.hide();
        break;

      }
    });
   jQuery("input[name='post_format']").trigger('change');
  },

  galleryPostFormatUploadImage: function(){
    var file_frame = "";
    jQuery(document).on('click', '.dt-open-media-for-gallery-post', function(e){
      e.preventDefault();

      // If the media frame already exists, reopen it.
        if ( file_frame ) {
          file_frame.open();
          return;
        }

        file_frame = wp.media.frames.file_frame = wp.media({
          multiple: true,
          title : "Upload / Select Media",
          button :{ text : "Insert Image" }
        });

        file_frame.on( 'select', function() {
          var attachments = file_frame.state().get('selection').toJSON();
          var holder = "";

          jQuery.each( attachments,function(key,value){
            var full = value.sizes.full.url,
            thumbnail =  value.sizes.thumbnail.url,
            name = value.name;

            holder += "<li>" +
            "<img src='"+thumbnail+"'/>" +
            "<span class='dt-image-name' >"+name+"</span>" +
            "<input type='hidden' class='dt-image-name' name='items_name[]' value='"+name+"' />" +
            "<input type='hidden' name='items[]' value='"+full+"' />" +
            "<input type='hidden' name='items_thumbnail[]' value='"+thumbnail+"' />" +
            "<span class='my_delete'></span>" +
            "</li>";
          });
          jQuery("ul.dt-items-holder").append(holder);
        });

        file_frame.open();

    });

    jQuery('ul.dt-items-holder').sortable({
      placeholder: 'sortable-placeholder',
      forcePlaceholderSize: true,
      cancel: '.my_delete, input, textarea, label'
    });

    jQuery('body').delegate('span.my_delete','click', function(){
      jQuery(this).parent('li').remove();
    });
  },
  
  backupOption: function(){
	  jQuery("a#dttheme_backup_button").on('click',function(e){
		  var ans = confirm(objectL10n.backupMsg);
		  if( ans ){
			  
			 var data =  { action : 'redart_backup_and_restore_action', type:'backup_options'};
			 jQuery('#ajax-feedback').css({display:'block'});
			 
			 jQuery.post(ajaxurl, data,
			  function(response) {
				  var response = response.trim();

				  var text = objectL10n.backupSuccess;
					  if( response === "1" ) {
					 	jQuery('#bpanel-message').empty().removeAttr('class').addClass('success');	
				 	  } else {
					 	jQuery('#bpanel-message').empty().removeAttr('class').addClass('error-msg');
					 	text = objectL10n.backupFailure;
				 	  }
					  
					  var popup = jQuery('#bpanel-message');
					  popup.append(text);
					  
					  popup.fadeIn();
					  window.setTimeout(function(){ 
						popup.fadeOut("slow",function(){
							jQuery('#ajax-feedback').fadeOut();
							location.reload();	
						});
					  }, 2000);

			 });
		  }
		 e.preventDefault(); 
	  });
  },//backupOption
  
  restoreOption : function(){
	  jQuery("a#dttheme_restore_button").on('click',function(e){
		  var ans = confirm(objectL10n.restoreMsg);
		  if( ans ){
			  var data =  { action : 'redart_backup_and_restore_action', type:'restore_options'};

			 jQuery.post(ajaxurl, data,
			  function(response) {
				  var text = objectL10n.restoreSuccess,
            response = response.trim(),
				  	  bodyelem;
					  if( response === "1" ) {
					 	jQuery('#bpanel-message').empty().removeAttr('class').addClass('success');	
				 	  } else {
					 	jQuery('#bpanel-message').empty().removeAttr('class').addClass('error-msg');
					 	text = objectL10n.restoreFailure;
				 	  }
					  
					  var popup = jQuery('#bpanel-message');
					  popup.append(text);
					  
					  popup.fadeIn();
					  window.setTimeout(function(){ 
						popup.fadeOut("slow",function(){
							location.reload();	
						});
					  }, 2000);
					  
					  
			 });
			  
		  }//END IF()
		  e.preventDefault();
	  });
  }, //restoreOption
  
  addItem : function() {
    jQuery(".add-custom-field").on('click',function(event) {
      $parent = jQuery(this).parents(".portfolio-custom-fields");
      $clone = jQuery(this).siblings(".clone").find(".custom-field-container").clone();
      $clone.appendTo($parent);
      event.preventDefault();
    });

  }, //AddItem

  removeItem : function(){
    jQuery("body").delegate(".remove-custom-field","click",function(event){
      jQuery(this).parents(".custom-field-container").remove();
      event.preventDefault();
    });
  } //RemoveItem
  
}; // dtthemeAdmin End

jQuery(document).ready(function($){
	
  "use strict";
  $.fn.center = function () {
	  this.animate({"top":( $(window).height() - this.height() - 200 ) / 2+$(window).scrollTop() + "px"},100);
	  this.css("left", 250 );
	  return this;
  };
  
  $(window).scroll(function() {
	  $("div#bpanel-message").center();
  });
  
  dtthemeAdmin.init();
  
  jQuery("#add-video").on('click',function(){
    var url = prompt("Please enter video url","https://vimeo.com/46926279");
    if(url!== null){
      var $no_sliders_container = jQuery('#j-no-images-container'),
      $slider_container = jQuery("#j-used-sliders-containers");
      if ( $no_sliders_container.is(':visible') ) {
        $no_sliders_container.hide();
      }
      $slider_container.append($("span#clone_me").html()).append('<input type="hidden" name="sliders[]" value="' + url + '" />');
    }
  });
	
  //Chosen Selection box...
  jQuery(".dt-chosen-select").each(function(){
	  $(this).chosen({
		  no_results_text: objectL10n.noResult,
		  width: '210px'
	  });
  });

  //Online Demo...
  jQuery(".dttheme-import select[name='demo']").change(function(){
	  var $lnk = jQuery(this).find('option:selected').attr('data-link');
	  jQuery('.dttheme-import .lnk-onlinedemo').attr('href', $lnk);
  });
});


const { select, subscribe } = wp.data;

class PageTemplateSwitcher {

  constructor() {
    this.template = null;
  }

  init() {

    subscribe( () => {

      const newTemplate = select( 'core/editor' ).getEditedPostAttribute( 'template' );

      if ( newTemplate !== this.template ) {
        this.template = newTemplate;
        this.changeTemplate();
      }

    });
  }

  changeTemplate() {

    var $val = this.template;
    var $ptemplate_box = jQuery('#page-template-meta-container');
    
    switch($val){
      case 'tpl-blog.php':
        $ptemplate_box.find('h2').text('Blog Options');
        $ptemplate_box.slideDown();
        $ptemplate_box.find('#tpl-common-settings').slideDown();
        $ptemplate_box.find('#tpl-blog').slideDown();
        $ptemplate_box.find('#tpl-portfolio').slideUp();
        $ptemplate_box.find("#page-commom-sidebar").slideDown();
        $ptemplate_box.find("#page-layout").slideDown();
        $ptemplate_box.find('#tpl-onepage-settings').slideUp();
        jQuery("#page-template-slider-meta-container").slideUp();
      break;
      
      case 'tpl-portfolio.php':
        $ptemplate_box.find('h2').text('Portfolio Options');
            $ptemplate_box.slideDown();					
        $ptemplate_box.find('#tpl-common-settings').slideDown();
        $ptemplate_box.find('#tpl-portfolio').slideDown();
        $ptemplate_box.find('#tpl-blog').slideUp();
        $ptemplate_box.find("#page-commom-sidebar").slideDown();
        $ptemplate_box.find("#page-layout").slideDown();
        $ptemplate_box.find('#tpl-onepage-settings').slideUp();
        jQuery("#page-template-slider-meta-container").slideUp();
      break;

      case 'tpl-onepage.php':
        $ptemplate_box.find('h2').text('One page Options');
        $ptemplate_box.slideDown();
        $ptemplate_box.find('#tpl-common-settings').slideDown();
        $ptemplate_box.find('#tpl-onepage-settings').slideDown();
        jQuery("#page-template-slider-meta-container").slideDown();
        $ptemplate_box.find('#tpl-blog').slideUp();
        $ptemplate_box.find('#tpl-portfolio').slideUp();
        $ptemplate_box.find("#page-commom-sidebar").slideUp();
        $ptemplate_box.find("#page-layout").slideUp();
      break;

      default:
      case 'default':
         $ptemplate_box.find('h2').text('Default page Options');
         $ptemplate_box.find('#tpl-common-settings').slideDown();
         $ptemplate_box.find("#page-commom-sidebar").slideDown();
         $ptemplate_box.find("#page-layout").slideDown();
         $ptemplate_box.find('#tpl-blog').slideUp();
         $ptemplate_box.find('#tpl-portfolio').slideUp();
         $ptemplate_box.find('#tpl-onepage-settings').slideUp();
         jQuery("#page-template-slider-meta-container").slideDown();
      break;
    }//End Switch

  }
}