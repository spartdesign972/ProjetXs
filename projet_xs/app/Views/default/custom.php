<?php
//A implementer:
//effacer l'image importer
//Limiter le nbre d'image importée


$this->layout('layout',['title'=>'Personnaliser votre Tshirt']);


//Ajouter du contenu dans la balise head
$this->start('link');

?>

<!-- Les scripts js -->
<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <!--[if IE]><script type="text/javascript" src="js/excanvas.js"></script><![endif]-->
<!--    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>	-->

    <script type="text/javascript" src="<?= $this->assetUrl('js/jquery.min.js') ?>"></script>
	<script type="text/javascript" src="<?= $this->assetUrl('js/fabric.js') ?>"></script>
	<script type="text/javascript" src="<?= $this->assetUrl('js/tshirtEditor.js') ?>"></script>
	<script type="text/javascript" src="<?= $this->assetUrl('js/jquery.miniColors.min.js') ?>"></script>
<!--
	<script type="text/javascript" src="<?//= $this->assetUrl('js/FileSaver.js') ?>"></script>
	<script type="text/javascript" src="<?//= $this->assetUrl('js/canvas-toBlob.js') ?>"></script>
-->
	<script type="text/javascript" src="<?= $this->assetUrl('js/html2canvas.js') ?>"></script>
	
	
	
<!-- Les styles -->
    <link type="text/css" rel="stylesheet" href="<?= $this->assetUrl('css/jquery.miniColors.css') ?>" />
<!--    <link href="<?//= $this->assetUrl('css/tc_bootstrap.min.css') ?>" rel="stylesheet">-->
    <link href="<?= $this->assetUrl('css/bootstrap-responsive.min.css') ?>" rel="stylesheet">
	 <script type="text/javascript">
	 </script>
	 <style type="text/css">
         
         .container p {
             text-align:center;
             color:#961b25;
         }
         
         .container > p > a{
            margin:15px;
            padding:10px;
            border-radius:5px;
            background: rgba(228, 112, 3, 1.0);
            color: whitesmoke;
         }
         
         input{
             width: 100%;
             margin-top:15px;
             padding: 5px 0;
         }
         
         input[type="submit"],
         input[type="button"]{
             background: rgba(228, 112, 3, 1.0);
             border:none;
             border-radius:5px;
             color: whitesmoke;
         }
         
         .lightbox{
             position:absolute;
             z-index: 9999;
             width:100%;
             height:100%;
             background:rgba(255,255,255,0.6);
         }
         
         .lightbox > div {
             display:block;
             margin:auto;
             background:rgb(255,255,255);
             width:80%;
         }
         
         .lightbox > div > p {
             color : rgba(228, 112, 3, 1.0);
         }
         
         .lightbox > div > img {
             display:block;
             margin:auto;
             height:80%;
         }
         
         .lightbox > div {
             text-align: center;
         }
         
         .lightbox > div > a {
             display: inline-block;
             margin: 10px;
             margin: 10px;
             padding:15px;
             background: rgba(228, 112, 3, 1.0);
             border:none;
             border-radius:5px;
             color: whitesmoke;
         }
         
         
         #target{
             display:none;
         }
         
		 .footer {
			padding: 70px 0;
			margin-top: 70px;
			border-top: 1px solid #E5E5E5;
			background-color: whiteSmoke;
			}			
/*
	      body {
	        padding-top: 60px;	        
	      }
*/
         
         .model-preview,
         .size{
            border: 3px solid #CCC;
            border-radius: 2px;
	      	margin: 2px;
            padding:5px;
            background:#fff;
	      	zoom: 1;
             text-align:center;
	      	vertical-align: top;
	      	display: inline-block !important;
	      	cursor: pointer;
	      	overflow: hidden;    
         }
         

         .size{
             width:36px;
         }

         
	      .color-preview {
	      	border: 3px solid #CCC;
            border-radius:2px;
	      	margin: 2px;
	      	zoom: 1;
	      	vertical-align: top;
	      	display: inline-block !important;
	      	cursor: pointer;
	      	overflow: hidden;
	      	width: 20px;
	      	height: 20px;
	      }
/*
	      .rotate {  
		    -webkit-transform:rotate(90deg);
		    -moz-transform:rotate(90deg);
		    -o-transform:rotate(90deg);
		     filter:progid:DXImageTransform.Microsoft.BasicImage(rotation=1.5); 
		    -ms-transform:rotate(90deg);		   
		}		
		.Arial{font-family:"Arial";}
		.Helvetica{font-family:"Helvetica";}
		.MyriadPro{font-family:"Myriad Pro";}
		.Delicious{font-family:"Delicious";}
		.Verdana{font-family:"Verdana";}
		.Georgia{font-family:"Georgia";}
		.Courier{font-family:"Courier";}
		.ComicSansMS{font-family:"Comic Sans MS";}
		.Impact{font-family:"Impact";}
		.Monaco{font-family:"Monaco";}
		.Optima{font-family:"Optima";}
		.HoeflerText{font-family:"Hoefler Text";}
		.Plaster{font-family:"Plaster";}
		.Engagement{font-family:"Engagement";}
*/
         

	 </style>
	
		<link href="<?= $this->assetUrl('css/styleCustom.css') ?>" rel="stylesheet">
<?php $this->stop('link') ?>
<!-- Fin de la balise head -->



<!-- Ajouter du contenu dans la balise main-->
<?php $this->start('main_content') ?>

<div class="container">

<?php
  
    if(empty($_SESSION['user'])){
        
        echo'
        <p>Pour enregistrer, télécharger, et commander un article personnalisé, vous devez être inscrit et connecté </p>
        <p><a href="'.$this->url('default_subscribe').'">S\'inscrire</a><a href="'.$this->url('login').'">Se connecter</a></p>
        <p>Les personnalisations réalisées ne seront pas enregistrées quand vous quitterez la page</p>
        '
        ;
        
    }
    
?>

<div class="colored">
    
<!--  Colonne de gauche -> Choisir le modèle, la taille la couleur du TShirt   -->
    <div class="col-sm-12 col-md-3">
        
                <!--	En-tête des onglets 	-->
		    	<div class="tabbable"> <!-- Only required for left/right tabs -->
				  <ul class="nav <!--nav-tabs-->">
				  	<li class="active"><a href="#tab1" data-toggle="tab">T-Shirt Options</a></li>				    
<!--				    <li><a href="#tab2" data-toggle="tab">Gravatar</a></li>-->
				  </ul>
				  <div class="tab-content">
				  
<!--                 Onglet 1 : TShirt option -->
				     <div class="tab-pane active" id="tab1">
				     	
					      
<!--					  Remplacer le texte par des aperçus    -->
					      <div class="well">
					          
					          <ul class="nav options">
<?php
  
    foreach($list as $value){
        echo '<li class="model-preview" title="" data-id="model" data-info="'.$value['category_reference'].'" data-name="'.$value['name'].'" data-price="'.$value['price'].'" data-view="'.$value['view'].'">'.$value['name'].'</li>';
    }
                                  
?>
<!--
					              <li class="model-preview" title="" data-id="model" data-info="BC-TU004" data-name="T-Shirt Manches Courtes" data-price="9.99">T-Shirt Manches Courtes</li>
					              <li class="model-preview" title="" data-id="model" data-info="BC-TU005" data-name="T-Shirt Manches Longues" data-price="12.99">T-Shirt Manches Longues</li>
					              <li class="model-preview" title="" data-id="model" data-info="">Débardeur</li>
					              <li class="model-preview" title="" data-id="model" data-info="">Sweat Shirt</li>
					              
-->
					          </ul>
					          
					      </div>
					      
<!--					  Taille de T-shirt -->      
					      <div class="well">
					          
					       <!-- Liste des tailles  -->
					          <ul class="nav options">
					              
					              <li class="size" title="taille S" data-id="size" data-info="S">S</li>
					              <li class="size" title="taille M" data-id="size" data-info="M">M</li>
					              <li class="size" title="taille L" data-id="size" data-info="L">L</li>
					              <li class="size" title="taille XL" data-id="size" data-info="XL">XL</li>
					              <li class="size" title="taille XXL" data-id="size" data-info="XXL">XXL</li>
					              
					          </ul>
					          
					      </div><!-- Fin de Taille TShirt -->
					      
<!--					  Couleur du T-Shirt -->
                           <div class="well">
                            
                            <!-- Liste des couleurs-->
                                <ul class="nav options">
                                    <li class="color-preview" title="White" style="background-color:#ffffff;" data-id="color" data-info="00"></li>

                                    <li class="color-preview" title="Black" style="background-color:#222222;" data-id="color" data-info="01"></li>

                                    <li class="color-preview" title="Irish Green" style="background-color:#1f6522;" data-id="color" data-info="04"></li>

                                    <li class="color-preview" title="Heather Navy" style="background-color:#3469b7;" data-id="color" data-info="02"></li>

                                    <li class="color-preview" title="Cherry Red" style="background-color:#c50404;" data-id="color" data-info="03"></li>
                                </ul>
                            </div>
                 			      
				     </div>	
				     
<!--				Onglet 2 : Gravatar			   -->
<!--
				    <div class="tab-pane" id="tab2">
				    	
				    	<div class="well">
-->
                            <!--  Ajout de texte  -->
<!--
				    		<div class="input-append">
							  <input class="span2" id="text-string" type="text" placeholder="add text here..."><button id="add-text" class="btn" title="Add text"><i class="icon-share-alt"></i></button>
							  <hr>
							</div>
-->
							
                            <!--	Ajout d'images proposées	-->
<!--
							<div id="avatarlist">
								<img style="cursor:pointer;" class="img-polaroid" src="img/invisibleman.jpg">
							</div>
-->
                            <!-- Fin images proposées   -->
                    				    		
<!--
				    	</div>
				    				      
				    </div>
-->
                    <!--  Fin de tab2  -->
				    
				  </div><!-- Fin de tab-content -->
				  
				</div><!-- Fin de tabbable -->
        				

       
            <div class="well upload">
                
                <form id="uploadImage" method="post" action="<?=$this->url('default_custom')?>"  enctype="multipart/form-data">
                     <input type="hidden" name="MAX_FILE_SIZE" value="2097152" /> 
                    <input type="file" name="picture" placeholder="Choisir">
                    <input type="submit" value="Charger l'image">                 
                </form>
<?php
  
    if(!empty($_SESSION['user'])){
        
        echo'
        <input id="reset" type="button" value="Effacer l\'image">
        '
        ;
        
    }
    
?>
                
            </div>
        
    </div>
    
    
    
    
    <div class="col-sm-12 col-md-6">
									  		
<!--                Editeur de Tshirt Personnalisé    -->					
					<div id="shirtDiv" class="page" style="width: 530px; height: 630px; position: relative; background-color: rgb(255, 255, 255);margin:0 auto;">
						
                    <!--  T-Shirt Vierge	-->
						<img id="tshirtFacing" src="<?= $this->assetUrl('img/custom/'.$list[0]['view']) ?>">
						
						<div id="drawingArea" style="position: absolute;top: 100px;left: 160px;z-index: 10;width: 200px;height: 400px;">					
							
                            <!--	Image de personnalisation		-->
							<canvas id="tcanvas" width=200 height="400" class="hover" style="-webkit-user-select: none;"></canvas>
							
				        </div>
                    <!--                        Image editor-->
<!--
							<div class="pull-right" align="" id="imageeditor" style="display:none">
							  <div class="btn-group">										      
							      <button class="btn" id="bring-to-front" title="Bring to Front"><i class="icon-fast-backward rotate" style="height:19px;"></i></button>
							      <button class="btn" id="send-to-back" title="Send to Back"><i class="icon-fast-forward rotate" style="height:19px;"></i></button>
							      <button id="flip" type="button" class="btn" title="Show Back View"><i class="icon-retweet" style="height:19px;"></i></button>
							      <button id="remove-selected" class="btn" title="Delete selected item"><i class="icon-trash" style="height:19px;"></i></button>
							  </div>

							</div>
								

<?php
//  
//    if(!empty($_SESSION['user'])){
//        
//        echo'
//        <form id="label">
//        <label>Nom du Design : </label><input id="designLabel" type="text" name="design_label" placeholder="Nom Design" required>
//        <input id="enregistrer" type="button" value="Enregistrer votre création" data-user="'.$_SESSION['user']['id'].'">
//        <input id="telecharger" type="button" value="Télécharger votre création">
//        <input id="reset" type="button" value="Effacer l\'image">
//        </form>
//        '
//        ;
//        
//    }
//    
?>	

                        </div>
-->

					             

                    </div>
<!--                    Fin de l'éditeur     -->
								
				

           
    </div>
    
    
    
    
    <div class="col-sm-12 col-md-3">
        
        		  
		      <div class="well">
		      	<h3>Total </h3>
			      <p>
			      	<table class="table">
			      		<tr>
			      			<td id="modelName"><?=$list[0]['name']?></td>
			      			<td id="modelPrice" align="right"><?=$list[0]['price']?></td>
			      		</tr>
			      		<tr>
			      			<td>Design Avant</td>
			      			<td align="right">€4.99</td>
			      		</tr>
<!--
			      		<tr>
			      			<td>Design Arrière</td>
			      			<td align="right">€4.99</td>
			      		</tr>
-->
			      		<tr>
			      			<td><strong>Total</strong></td>
			      			<td id="total" align="right"><strong><?=$list[0]['price']+4.99?></strong></td>
			      		</tr>
			      	</table>			
			      </p>
<!--					<button type="button" class="btn btn-large btn-block btn-success" name="addToTheBag" id="addToTheBag">Commander</button>-->
<?php
  
    if(!empty($_SESSION['user'])){
        
        echo'
        <form id="label">
        <label>Nom du Design : </label><input id="designLabel" type="text" name="design_label" placeholder="Nom Design">
        <input id="enregistrer" type="button" value="Enregistrer votre création" data-user="'.$_SESSION['user']['id'].'">
        </form>
        '
        ;
        
    }
    
?>	
          
		      </div>		      		       		   
		   
        
    </div>
    
<div id="result"></div>
<div class="clearfix"></div>
</div>

</div><!--  Fin de container  -->
<?php $this->stop('main_content') ?>
<!-- Fin de la balise main-->




<!--Ajout de script en fin de document-->
<?php $this->start('script') ?>

<!------------------------------------------------------------------------------------------------------------------ 

Le javascript

------------------------------------------------------------------------------------------------------------------->
    <!-- Placed at the end of the document so the pages load faster -->    
<script>

    $(function() {
        
        var reference = {model:'BC-TU004', size:'XL', color:'00'};
        
  // Pour l'ajout d'une image
      $('#uploadImage').on('submit', function(el) {
        el.preventDefault(); // On bloque l'action par défaut
        var $form = $(this);
        var formdata = (window.FormData) ? new FormData($form[0]) : null;
        var data = (formdata !== null) ? formdata : $form.serialize();
        $.ajax({
          url: $form.attr('action'),
          type: $form.attr('method'),
          contentType: false, // obligatoire pour de l'upload
          processData: false, // obligatoire pour de l'upload
          // dataType: 'json', // selon le retour attendu
          data: data,
          success: function(resultat) {
            $('#result').html(resultat);
            $('#uploadImage').hide();
          }
        });
      });
        
//Pour l'enregistrement des données dans la bdd (la référence du t-shirt, l'image à utiliser pour la personnalisation)
//Pour la visibilité des options choisies
    $('.options>li').click(function(e){
        $(this).siblings().css('border','solid #ccc 3px');
        $(this).css('border','solid #000 3px');
        
        var key     = $(this).data('id');
        var value   = $(this).data('info');
        var txt     = $(this).data('name');
        var price   = $(this).data('price');
        var view    = $(this).data('view');
        
        if(key == 'model'){
            
            var total = price+4.99;
            
            $('#modelName').html(txt);
            $('#modelPrice').html(price);
            $('#total').html(total);
            $('#tshirtFacing').attr('src','/projetXs/projet_xs/public/assets/img/custom/'+view);
        }
        
        reference[key] = value;
        
    });
        
        
<?php
  
    if(!empty($_SESSION['user'])){
?>
        
//Pour l'enregistrement de l'image sur le serveur        
        $('#enregistrer').click(function(){
        //Ajouter une vérification : l'existence des 3 entrées de reference
    
         var design = $('#shirtDiv');

            html2canvas(design,{
              onrendered: function(canvas){
              
                var dataURL = canvas.toDataURL();
                  
                $.ajax({
                  type: 'post',
                  url: '<?=$this->url('default_custom')?>',
                  data: { 
                      img       : dataURL,
                      ref1      : reference['model'],
                      ref2      : reference['color'],
                      ref3      : reference['size'],
                      label     : $('#designLabel').val(),
                      price     : $('#total').text(),
                  }
                }).done(function(o) {
                    $('body').prepend(o);
                    $('#box').attr('class','lightbox');
                    $('#new').attr('href','<?= $this->url('default_custom') ?>');
                    $('#viewAll').attr('href','<?= $this->url('user_listDesigns') ?>');
                });
              
              }//Fin de rendered
            
            });//Fin de html2canvas
        

            
    });//Fin de $(#enregistrer).click
        
 
//Pour le téléchargement de l'image 
//    $('#telecharger').click(function(){
//        
////        $("#tcanvas").get(0).toBlob(function(blob){
////           console.log(blob);
////            saveAs(blob, "myIMG.png");
////        });
//        
//    });
    
        
//POur effacer l'image
    $('#reset').on('click',function(){
        
        $.ajax({
            type: 'post',
            url: '<?=$this->url('default_custom')?>',
            data: {
                clear : '<?php if(!empty($_SESSION['picture'])){echo $_SESSION['picture']['source'];} ?>'
                  },
            success:function(){
                canvas.clear();
                $('#uploadImage').show();
            }
        })
        
    });
        
        
<?php
        
    }
    
?>	

 });//Fin de $(function)
     


</script>

<?php
                         
$this->stop('script'); 

?>
