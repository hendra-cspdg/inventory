<?php

class Tanda_terimaModule extends CWebModule {

    public function init() {
        $this->layoutPath = Yii::getPathOfAlias('webroot.protected.views.layouts');
        $this->layout = 'main';
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        // import the module-level models and components
        $this->setImport(array(
            'tanda_terima.models.*',
            'tanda_terima.components.*',
        ));
    }

    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        } else
            return false;
    }

}
