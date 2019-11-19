<?php


namespace app\components;
use yii\base\Widget;
use app\models\Category;
use Yii;

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

        $menu = Yii::$app->cache->get('menu');

        if($menu) return $menu;

        $this->data = Category::find()->indexBy('id')->asArray()->all();
        $this->tree = $this->getTree();
        $this->menuHtml = $this->getMenuHtml($this->tree);

        $this->menuHtml = '<ul class="catalog category-products">' .
                        $this->menuHtml . '</ul>';

        Yii::$app->cache->set('menu', $this->menuHtml, 60);

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

//        $tree[] = [
//            'id' => 1000,
//            'parent_id' => 0,
//            'name' => 'ALL GOODS',
//            'keywords' => 'ALL GOODS keywords',
//            'description' => 'Description ALL GOODS'
//            ];
//        debugd($tree);
        return $tree;
    }

    protected function getMenuHtml($tree){

        $str = '';
        foreach ($tree as $category) {
            $str .= $this->catToTemplate($category);
        }

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