$(function(){
	$('.modalbox').fancybox({
		padding:0,	
		closeBtn : false,

		helpers : {
			overlay : {
				css : {
					'background' : 'rgba(0,0,0,0)'
				}
			}
		}
	});
	
		
	$(".modalclosebtn").click(function(){
		$.fancybox.close()	
	});	
	
	$(".sidebar > a > .items").click(function(){
		$(".sidebar > a > .items").removeClass("active");
		$(this).addClass("active");
	});	
	
});

jQuery(document).ready(function($){
 		$('.pi-tree-view').piTreeView({
 			apiUrl:'api/ajax/filetree.php', //required 
  			apiKey:'123', //required if API check for key -- if not just set it as '' (i.e. blank string)
  			fileCallback:function(el){ // optional
  				console.log($(el).html());
 			},
  			folderClosedIcon:'<i class="fa fa-folder-o fa-2x"></i>', // optional any HTML or blank string to remove
 			folderOpenIcon:'<i class="fa fa-folder-open-o fa-2x"></i>', // optional any HTML or blank string to remove
 			fileIcon:'<i class="fa fa-file-o fa-2x"></i>' // optional any HTML or blank string to remove
  		});
                
                
  });

