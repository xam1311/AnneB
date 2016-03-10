<?php
class TaxonomyHelper extends AppHelper
{
	var $helpers = array('Form','Html');

	public function input($type,$options = array())
	{
		$data = $this->data;
		if(empty($data)):
			return false;
		else:
			$ref = key($data);
			$this->javascript($ref,$data[$ref]['id'],$type);
			$html ='';
			if(!empty($data['Tags'][$type])):

				foreach ($data['Tags'][$type] as $v):
					$url =Router::url(array('controller'=>'Terms','action'=>'delete','plugin'=>'taxonomy','admin'=>true,$v['TermR']['id']));
					$html .= '<button class="btn btn-primary" type="button"><span>'.$v['name'].'<a href="'.$url.'" class="delTaxo"><span class="glyphicon glyphicon-remove-sign"></span></a></span></button>';
			    endforeach;
			endif;
		endif;
		$options['id'] = $type;
		$options['class']='addTaxo form-control';
		$options['value'] = '';
		return $this->Form->input('Taxonomy.'.$type,$options).$html;
	}

	private function javascript($ref,$ref_id,$type)
	{
		if($this->javascript){ return false; }
		$this->javascript = true;
		$url =Router::url(array('controller'=>'Terms','action'=>'add','plugin'=>'taxonomy','admin'=>true,$ref,$ref_id,$type));
		$urlList = Router::url(array('controller'=>'Terms','action'=>'search','plugin'=>'taxonomy','admin'=>true));
		$this->Html->scriptStart(array('inline'=>false));?>
			jQuery(function($){
			$('.delTaxo').on('click',function()
			{
					var a =($this);
					$.get(a.attr('href'));
					a.parent().fadeOut();
					return false;
			});
			$('.addTaxo').each(function(){
				var input = $(this);
				var cache = {},lastXhr;
				var type = input.attr('id');

					input.autocomplete({
					minLength:2,
					source: function( request, response ) {
						request.type = input.attr('id');
						var term = request.term;
						if ( term in cache ) {
							response( cache[ term ] );
							return;
						}

						lastXhr = $.getJSON( "<?php echo $urlList; ?>",
						request, function( data, status, xhr ) {
							cache[ term ] = data;
							if ( xhr === lastXhr ) {
								response( data );
							}
						});
					},
					select : function(event, ui){
						$.get('<?php echo $url; ?>',{id:ui.item.id,name:ui.item.label,type:type},function(data){
							input.parent().after(data);
							input.val('');
						});
					}
				});
					$('.addTaxo').keypress(function(e){
						if( e.keyCode == 13)
						{

							var val= input.val();
							input.val('');
							$.get("<?php echo $url; ?>",{name:val},function(data)
							{
								input.parent().after(data);
							});
							return false;
						}

					});

			});

			});



		<?php $this->Html->scriptEnd();
	}

}
 ?>
