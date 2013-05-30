<?php

class MallModule extends CWebModule {
	
	public $defaultController = "run";
		
	public function init() {
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'mall.models.*',
			'mall.components.*',
		));
	}
	
	private $_assetsUrl;
	public function getAssetsUrl() {
        if ($this->_assetsUrl === null)
            $this->_assetsUrl = Yii::app()->getAssetManager()->publish(
                Yii::getPathOfAlias('mall.assets')
                // Comment this out for production. With this in place, module assets will be published
                // and copied over at every request, instaed of only once
                #,false,-1,true
            );
        return $this->_assetsUrl;
    }
    
	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
