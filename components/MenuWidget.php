<?php


namespace app\components;
use yii\base\Widget;
use app\models\Category;

class MenuWidget extends Widget
{
    public $tpl;
    public $data;
    public $tree;
    public $menuHtml;

    public function init(){

        parent::init();

        if($this->tpl === null){
            $this->tpl = 'menu';
        }

        $this->tpl .= '.php';
    }

    public function run(){

        $this->data = Category::find()->indexBy('id')->asArray()->all();
//        debug($this->data) ;


        $this->tree = $this->getTree();
//        debug($this->tree) ;
//        die();
        $this->menuHtml = $this->getMenuHtml($this->tree);
//        debug($this->tree);
//        debug($this->tpl);

        return $this->menuHtml;
    }

    protected function getTree(){

        $tree = [];

        foreach ($this->data as $id => &$node) {
            if(!$node['parent_id']){
                $tree[$id] = &$node;
            }
            else{
                $this->data[$node['parent_id']]['childs'][$node['id']] = &$node;
            }
        }

        return $tree;
    }

    protected function getMenuHtml($tree){

//                debug($tree) ;
//                die();

        $str = '';
        foreach ($tree as $category) {
            $str .= $this->catToTemplate($category);
        }

//        debug($str) ;
//                die();

        return $str;

    }

    protected function catToTemplate($category){

//        debug($category['name']) ;
//        debug($this->tpl) ;
        ob_start();


        include __DIR__ . '/menu_tpl/' . $this->tpl;
//        echo $this->menuHtml;
//        $r = ob_clean();
//        debug($r);
//        die();

        return ob_get_clean();
        return $r;
    }
}