<?php
class TaxonomyBehavior extends ModelBehavior{

	protected $_defaults = array(
		'fixed' =>array('category'),
		'dynamic' =>array('tag','type_projet')
	

		);

	public function getFixedTerms($model)
	{
		return $model->Term->find('list',array(
			'fields'=>array('Term.id','Term.name','Term.type'),
			'conditions'=>array('Term.type'=>$this->settings['fixed'])
			)
		);

	}

	public function setup(Model $model, $config = array()){

		$model->hasAndBelongsToMany['Term'] = array(
			'className' => 'Taxonomy.Term',
			'associationForeignKey'=>'term_id',
			'with'=>'Taxonomy.TermR',
			'foreignKey' =>'ref_id',
			'joinTable' =>'term_relationships',
			'conditions'=>' ref = "Project"'
			);
		$this->settings = array_merge($this->_defaults,$config);
		
	}


	public function afterSave(Model $model, $created, $options = array()){

		if(isset($model->data[$model->name]['terms']))
		{
			$model->deleteTerms();
			$terms = $model->data[$model->name]['terms'];
			foreach ($terms as $term_id) {
				$model->Term->TermR->create();
				$model->Term->TermR->save(array(
					'term_id'=> $term_id,
					'ref' => $model->name,
					'ref_id' => $model->id
					));
			}
		}

	}

	public function afterFind(Model $model, $results, $primary = false)
	{
		foreach ($results as $k => $v) {
			if(!empty($v['Term'])):
			$results[$k][$model->name]['terms'] = Set::combine($v['Term'],'{n}.id','{n}.id');
			$results[$k]['Tags'] = Set::combine($v['Term'],'{n}.id','{n}','{n}.type');
			endif;
		}

		return $results;
	}

	public function deleteTerms($model)
	{
		$terms = $model->Term->find('list',array('fields'=>array('id','id'),'conditions'=>
			array('Term.type'=>$this->settings['fixed'])));
		$model->Term->TermR->deleteAll(array(
			'ref'=> $model ->name,
			'ref_id'=> $model->id,
			'term_id'=>$terms
		));
	}
	

	



}
?>