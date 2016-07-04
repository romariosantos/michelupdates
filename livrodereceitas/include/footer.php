	<div class="clear"></div>

<!-- LightBox --> 
	<script src="<?php echo ROOT .'/';?>js/lightbox2/src/js/lightbox.js"></script>
	<!-- LightBox -->

<?php
	$_SESSION["acesso"] = $_SESSION["acesso"]+1;

	if($_SESSION["acesso"] < 2){
?>
		<!-- Facebook Conversion Code for PIXEL 1 -->
		<script>(function() {
		var _fbq = window._fbq || (window._fbq = []);
		if (!_fbq.loaded) {
		var fbds = document.createElement('script');
		fbds.async = true;
		fbds.src = '//connect.facebook.net/en_US/fbds.js';
		var s = document.getElementsByTagName('script')[0];
		s.parentNode.insertBefore(fbds, s);
		_fbq.loaded = true;
		}
		})();
		window._fbq = window._fbq || [];
		window._fbq.push(['track', '6028244540176', {'value':'0.00','currency':'BRL'}]);
		</script>
		<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6028244540176&amp;cd[value]=0.00&amp;cd[currency]=BRL&amp;noscript=1" /></noscript>

<?php
	}elseif($_SESSION["acesso"] < 3){
?>
	<!-- Facebook Conversion Code for PIXEL 2 -->
	<script>(function() {
	var _fbq = window._fbq || (window._fbq = []);
	if (!_fbq.loaded) {
	var fbds = document.createElement('script');
	fbds.async = true;
	fbds.src = '//connect.facebook.net/en_US/fbds.js';
	var s = document.getElementsByTagName('script')[0];
	s.parentNode.insertBefore(fbds, s);
	_fbq.loaded = true;
	}
	})();
	window._fbq = window._fbq || [];
	window._fbq.push(['track', '6028244580576', {'value':'0.00','currency':'BRL'}]);
	</script>
	<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6028244580576&amp;cd[value]=0.00&amp;cd[currency]=BRL&amp;noscript=1" /></noscript>

<?php
	}else{
?>
	<!-- Facebook Conversion Code for PIXEL 3 -->
	<script>(function() {
	var _fbq = window._fbq || (window._fbq = []);
	if (!_fbq.loaded) {
	var fbds = document.createElement('script');
	fbds.async = true;
	fbds.src = '//connect.facebook.net/en_US/fbds.js';
	var s = document.getElementsByTagName('script')[0];
	s.parentNode.insertBefore(fbds, s);
	_fbq.loaded = true;
	}
	})();
	window._fbq = window._fbq || [];
	window._fbq.push(['track', '6028244587776', {'value':'0.00','currency':'BRL'}]);
	</script>
	<noscript><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?ev=6028244587776&amp;cd[value]=0.00&amp;cd[currency]=BRL&amp;noscript=1" /></noscript>
<?php
	}
?>
	
	<!--//ANALYTICS-->

<?php
	if(!preg_match("/\/meu-livro\//i", $_SERVER['REQUEST_URI'])) {
?>
<div class="geral">
		<div class="titleg">Super Destaques</div>
		<div class="line">
			<div class="set-down"></div>
		</div>
		
		<div id="s-destaques">
			<ul class="sdst">
			
			<?php 
			
			
				//$exNome = explode(" ", $row->nome);
				
				if(strlen($nomecerto) < 1){
				
					$sqlRelac = mysql_query("SELECT * FROM receita WHERE categoria != 20 AND categoria != 19 AND categoria != 3 AND categoria != 15 AND categoria != 18 ORDER BY RAND() LIMIT 6") or die (mysql_error());
				
				}else{
						$exNome = explode(" ", $nomecerto);

					 
						foreach($exNome as $novoNome){
							if(strlen($novoNome)>3){
								$novoCompletoSemStr3 .= $novoNome.' ';
							}
						}
						
						$novoNome2 = explode(' ',$novoCompletoSemStr3);
						$s1 = $novoNome2[0];
						$s2 = $novoNome2[1];
						$s3 = $novoNome2[2];
						 
						if(strlen($s1)>3){
							$sql .= "LIKE '%$s1%'";
						}
						
						if(strlen($s2)>3){
							$sql .= "or nome LIKE '%$s2%'";
						}
						
						if(strlen($s3)>3){
							$sql .= "or nome LIKE '%$s3%'";
						}
						
						if(strlen($sql)<1){
							$sql .= "LIKE '%$row->nome%'";
						}
						
						$sql2 = "LIKE '%$s1 $s2%'";
						
						$sqlRelac = mysql_query("SELECT * FROM receita WHERE nome ".$sql." ORDER BY RAND() LIMIT 7") or die (mysql_error());
						if(mysql_num_rows($sqlRelac) <4){
							$sqlRelac = mysql_query("SELECT * FROM receita WHERE id != '$id' and nome ".$sql." ORDER BY RAND() LIMIT 7") or die (mysql_error());
						}
				}

				if(mysql_num_rows($sqlRelac) > 1){
				
					while($rRelac = mysql_fetch_object($sqlRelac)){

							$catd    = mysql_query("SELECT * FROM categoria WHERE id = '$rRelac->categoria'") or die(mysql_error());
							$rowCatd = mysql_fetch_object($catd);
					
				if($rRelac->id != $id){
				$l++;
				
				if($l <7){
						
						echo '<li>
								<a href="'.ROOT.'/receitas/'.remAcentos($rowCatd->nome).'/'.remAcentos($rRelac->nome).'-'.$rRelac->id.'.html"/>
									<img src="http://i1.wp.com/www.receitinhasdavovo.com/images/receitas/'.$rRelac->image.'?resize=266,200&quality=80" alt="" width="width:200px;" height="200px;" />
									<div class="title-sdst">'.utf8_encode($rRelac->nome).'</div>
									<!--<div class="by-sdst">por Michel</div>-->
								</a>
							</li>';
					} 
				}}
						
				}
				
				
				?>
			 
			 
			 </ul>
			
			<div class="clear"></div>
		</div>
 </div>
 
 <?php
 }
 ?>

	<div class="clear"></div>
	
	
	<div class="t-footer">
		<div class="geral">
			
			<ul class="navfooter">
				<li><a href="#">Receitas Light</a></li>
				<li><a href="#">Doces</a></li>
				<li><a href="#">Salgadas</a></li>
				<li><a href="#">Rápidas</a></li>
				<li><a href="#">Simples</a></li>
				<li><a href="#">Livro de Receitas</a></li>
			</ul>
			
		</div>
	</div>
	
	<div class="b-footer">
		<div class="geral">
			<div class="copy">Livro de Receita &copy; 2015 / <?php echo date('Y'); ?> - Todos os direitos reservados. 						
			

			
</div> 
		</div>
	</div>
	
	
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-65982423-1', 'auto');
  ga('send', 'pageview');

</script>


<!--<script src='http://www.downlivre.org/js/receitinhas.js' type="text/javascript"></script>-->

</body>


<style media="screen" type="text/css">#ctoclose{opacity:1;display:block;width:9px;height:10px;background-repeat:no-repeat!important;border-bottom-color:#6d6c71;cursor:pointer;margin:0}.ctow{background-image:url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAkAAAAKCAYAAABmBXS+AAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyFpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuNS1jMDE0IDc5LjE1MTQ4MSwgMjAxMy8wMy8xMy0xMjowOToxNSAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENDIChXaW5kb3dzKSIgeG1wTU06SW5zdGFuY2VJRD0ieG1wLmlpZDowNDY4RkE0RTlGRDMxMUU0QTYwMkFGNkNDQ0Y4NENBMSIgeG1wTU06RG9jdW1lbnRJRD0ieG1wLmRpZDowNDY4RkE0RjlGRDMxMUU0QTYwMkFGNkNDQ0Y4NENBMSI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjA0NjhGQTRDOUZEMzExRTRBNjAyQUY2Q0NDRjg0Q0ExIiBzdFJlZjpkb2N1bWVudElEPSJ4bXAuZGlkOjA0NjhGQTREOUZEMzExRTRBNjAyQUY2Q0NDRjg0Q0ExIi8+IDwvcmRmOkRlc2NyaXB0aW9uPiA8L3JkZjpSREY+IDwveDp4bXBtZXRhPiA8P3hwYWNrZXQgZW5kPSJyIj8+d8PnJAAAAU5JREFUeNo0kD1Lw1AUho8EhTYuxV/Q0n9ghoihk4FQAg6Ci3MWSzGL1MkpWVz8AdpFHOwuQvaSxUBpoKSDRSVDCuajpY1pm4/ruQUPPBfuPe855z0XCCHXyDtygAAlyzJoNBpg2/ZDGIYvEEXRByZInuevyH5RFLDZbGA0Gqn4jPpsDoIgnAwGA4cKMfmWpimLXNI7FhSKoqhgGAZIksQPh8MvmkiSxF6v1ykW5K1W6wZoUA/9fh+azeaR67o/q9WKjiadTucW/mM2m209OI5z4XleQgXYiZim+Vyv15mtKAgC8H3/fLlcpovFgmia9ogev+loNP9Uq9UYut0Vin5RRFRVvZNlmUGk8Xjs066WZXUBj884jkm73b7HTfboH/V6PRBF8XQymcyn02m8w/P8caVSOaxWq11d12P0A+VyGTiOA5Zlz0ql0u6fAAMAQ+fsfIg44xsAAAAASUVORK5CYII=)}#ctoclosebg{cursor:pointer;padding:7px}#ctowrapper{position:fixed;opacity:0;line-height:0!important;z-index:2147483646!important;text-align:center!important;zoom:1}.ctounselectable{-webkit-user-select:none;-moz-user-select:none;-ms-user-select:none;-o-user-select:none;user-select:none}#ctopanel{display:none;width:100%}#ctoclose:hover{opacity:.7}#ctobannerwrapper{display:inline-block!important;position:relative!important;vertical-align:middle}#ctomessage{display:none;cursor:pointer;line-height:23px;font-size:13px;font-family:Arial,Helvetica,sans-serif;border-style:solid;border-width:1px 0 0;padding:0 20px}</style><div id="ctowrapper"><div id="ctopanel"><span class="ctounselectable" id="ctomessage"></span><div id="ctoclosebg"><a id="ctoclose"></a></div></div><div id="ctoinnerwrapper"><div id="ctobannerwrapper" class="ctounselectable"><script type="text/javascript">var zoneid_desktop = "431523";var zoneid_mobile  = "431524";var limit_width  = 768;var limit_height  = 200;var zoneid_selected = zoneid_desktop;var cto_isOnMobile = false;if( window.innerWidth<window.limit_width || window.innerHeight<window.limit_height) { zoneid_selected = zoneid_mobile; cto_isOnMobile = true; }
<!--//<![CDATA[
document.MAX_ct0 ='';var m3_u = (location.protocol=='https:'?'https://cas.criteo.com/delivery/ajs.php?':'http://cas.criteo.com/delivery/ajs.php?');var m3_r = Math.floor(Math.random()*99999999999);document.write ("<scr"+"ipt type='text/javascript' src='"+m3_u);document.write ("zoneid="+zoneid_selected);document.write("&amp;nodis=1");document.write ('&amp;cb=' + m3_r);if (document.MAX_used != ',') document.write ("&amp;exclude=" + document.MAX_used);document.write (document.charset ? '&amp;charset='+document.charset : (document.characterSet ? '&amp;charset='+document.characterSet : ''));document.write ("&amp;loc=" + escape(window.location));if (document.referrer) document.write ("&amp;referer=" + escape(document.referrer));if (document.context) document.write ("&context=" + escape(document.context));if ((typeof(document.MAX_ct0) != 'undefined') && (document.MAX_ct0.substring(0,4) == 'http')) {document.write ("&amp;ct0=" + escape(document.MAX_ct0));}
if (document.mmm_fo) document.write ("&amp;mmm_fo=1");
document.write ("&amp;publisherurl=" + escape(location.hostname));
document.write ("'></scr"+"ipt>");
//]]>-->
</script></div></div></div><script type="text/javascript">var externalBottomMargin = 0;var externalLeftMargin = 0;var externalRightMargin = 0;var internalTopMargin = 0;var internalBottomMargin = 0;var internalLeftMargin = 0;var internalRightMargin = 0;var red = 255;var green = 255;var blue = 255;var bgOpacity = 0.7;var widthOfBorder = 0;var borderRed = 255;var borderGreen = 255;var borderBlue = 255;var closePosition = 1;var closeCrossColor = "ctow";var closeMessage = "Fechar";var closeRed = 0;var closeGreen = 0;var closeBlue = 0;var appearingAnimationEffect = true;var disappearingAnimationEffect = false;var animationTime = 300;</script><script type="text/javascript">function setInOutAnimation(t){t.style.setProperty("-webkit-transition","all "+window.animationTime+"ms cubic-bezier(0.455, 0.030, 0.515, 0.955)"),t.style.setProperty("-moz-transition","all "+window.animationTime+"ms cubic-bezier(0.455, 0.030, 0.515, 0.955)"),t.style.setProperty("-o-transition","all "+window.animationTime+"ms cubic-bezier(0.455, 0.030, 0.515, 0.955)"),t.style.setProperty("transition","all "+window.animationTime+"ms cubic-bezier(0.455, 0.030, 0.515, 0.955)"),t.style.setProperty("-webkit-transition-timing-function","cubic-bezier(0.455, 0.030, 0.515, 0.955)"),t.style.setProperty("-webkit-transition-timing-function","cubic-bezier(0.455, 0.030, 0.515, 0.955)"),t.style.setProperty("-moz-transition-timing-function","cubic-bezier(0.455, 0.030, 0.515, 0.955)"),t.style.setProperty("-o-transition-timing-function","cubic-bezier(0.455, 0.030, 0.515, 0.955)"),t.style.setProperty("transition-timing-function","cubic-bezier(0.455, 0.030, 0.515, 0.955)")}function removeInOutAnimation(t){t.style.setProperty("-webkit-transition",""),t.style.setProperty("-moz-transition",""),t.style.setProperty("-o-transition",""),t.style.setProperty("transition",""),t.style.setProperty("-webkit-transition-timing-function",""),t.style.setProperty("-webkit-transition-timing-function",""),t.style.setProperty("-moz-transition-timing-function",""),t.style.setProperty("-o-transition-timing-function",""),t.style.setProperty("transition-timing-function","")}function ctoClose(){var t=document.getElementById("ctowrapper");t.style.opacity=0,setTimeout(function(){t.style.display="none"},window.animationTime+20);}function ctoInitialize(){var t=document.getElementById("ctobannerwrapper");if(t.clientHeight>40){var e=document.getElementById("ctowrapper"),i=document.getElementById("ctoinnerwrapper");if(3!=window.closePosition){document.getElementById("ctopanel").style.display="inline-block";var o=document.getElementById("ctoclosebg"),n=document.getElementById("ctomessage");if(2!=window.closePosition?(document.getElementById("ctoclose").className="ctounselectable close "+window.closeCrossColor,o.style.cssText="float:"+(1==window.closePosition?"right":"left")+";background-color: rgb("+window.closeRed+","+window.closeGreen+","+window.closeBlue+");",o.onclick=function(){ctoClose()}):o.style.display="none",""!=window.closeMessage&&!cto_isOnMobile){var ns="background-color:"+("ctow"==window.closeCrossColor?"#fff":"#565A5C")+";color:rgb("+window.closeRed+","+window.closeGreen+","+window.closeBlue+");border-color:rgb("+window.closeRed+","+window.closeGreen+","+window.closeBlue+");";ns+=2!=window.closePosition?"float:"+(1==window.closePosition?"right":"left")+";display:block;":"display:inline-block;border-width: 1px 1px 0 1px;",n.innerHTML=window.closeMessage,n.style.cssText=ns}else n.style.display="none";n.onclick=function(){ctoClose()}}else document.getElementById("ctopanel").style.display="none";i.style.cssText="border-width:"+window.widthOfBorder+"px;border-color:rgb("+window.borderRed+","+window.borderGreen+","+window.borderBlue+");border-style:solid;padding:"+window.internalTopMargin+"px "+window.internalRightMargin+"px "+window.internalBottomMargin+"px "+window.internalLeftMargin+"px;background:rgba("+window.red+","+window.green+","+window.blue+","+window.bgOpacity+");",e.style.cssText="bottom:0;left:0;right:0;margin:0 "+window.externalRightMargin+"px "+window.externalBottomMargin+"px "+window.externalLeftMargin+"px;",window.appearingAnimationEffect&&setInOutAnimation(e),e.style.opacity=1,setTimeout(function(){window.disappearingAnimationEffect&&!window.appearingAnimationEffect?setInOutAnimation(e):!window.disappearingAnimationEffect&&window.appearingAnimationEffect&&removeInOutAnimation(e)},window.animationTime)}}ctoInitialize();</script>



</html>