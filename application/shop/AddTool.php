<?php
namespace app\shop;
abstract class ACartTool {
    /**
    * 向购物车中添加1个商品
    * @param $goods_id int 商品id
    * @param $goods_name String 商品名
    * @param $shop_price float 价格
    * @return boolean
    */
    abstract public function add($goods_id, $goods_name, $shop_price, $number);

    /**
    * 减少购物中1个商品的数量, 如果减至0, 则从购物车删除此商品
    * @param $goods_id int 商品id
    */
    abstract public function decr($goods_id) ;

    /**
    * 从购物车删除某商品
    * @param $goods_id 商品id
    */
    abstract public function del($goods_id) ;

    /**
    * 列出购物车所有的商品
    * @return Array
    */
    abstract public function items() ;

    /**
    * 返回购物车中有几种商品
    * @return int
    */
    abstract public function calcType() ;

    /**
    * 返回购物中商品的个数
    * @return int
    */
    abstract public function calcCnt() ;

    /**
    * 返回购物车中商品的总价格
    * @return float
    */

    abstract public function calcMoney() ;
    /**
    * 清空购物车
    * @return void
    */
    abstract public function clear() ;
}


class AddTool extends ACartTool {
    public $item = array();
    public static $ins = null;

    public static function getIns(){
        if(self::$ins == null){
            self::$ins = new self();
        }
        return self::$ins;
    }
    final protected function __construct(){
        $this->item = session('?shopcar')?session('shopcar'):array();
    }
    /**
    * 向购物车中添加1个商品
    * @param $goods_id int 商品id
    * @param $goods_name String 商品名
    * @param $shop_price float 价格
    * @return boolean
    */

    public function add($item_id, $item_title, $sell_price, $number){
        if(array_key_exists($item_id, $this->item)){
            if($this->item[$item_id]['sell_price'] == $sell_price){
                $this->item[$item_id]['number'] += $number;      
            } else {
                return false;
            }
        }else {
            $goods['item_title'] = $item_title;
            $goods['sell_price'] = $sell_price;
            $goods['number'] = $number;
            $this->item[$item_id] = $goods;
        }
        return true;
    }

    /**
    * 减少购物中1个商品的数量
    * @param $goods_id int 商品id
    */
    public function decr($item_id){
        if($this->item[$item_id]){
            $this->item[$item_id]['number'] -= 1;
        } else{
            return false;
        }
        if($this->item[$item_id]['number'] <=0){
            $this->item[$item_id]['number'] = 1;
        }
        return true;
    }

    /**
    * 增加购物中1个商品的数量
    * @param $goods_id int 商品id
    */
    public function addOne($item_id){
        if($this->item[$item_id]){
            $this->item[$item_id]['number'] += 1;
        }else {
            return false;
        }
        return true;
    }

    /**
    * 从购物车删除某商品
    * @param $goods_id 商品id
    */
    public function del($item_id){
        unset($this->item[$item_id]);
    }

    /**
    * 列出购物车所有的商品
    * @return Array
    */
    public function items(){
        return $this->item;
    }

    /**
    * 返回购物车中有几种商品
    * @return int
    */
    public function calcType(){
        return count($this->item);
    }

    /**
    * 返回购物中商品的个数
    * @return int
    */
    public function calcCnt(){
        $n = 0;
        foreach ($this->item as $k => $v) {
            $n +=$v['number'];
        }
        return $n;
    }

    /**
    * 返回购物车中商品的总价格
    * @return float
    */

    public function calcMoney(){
        $n = 0;
        foreach ($this->item as $k => $v) {
            $n+=$v['number'] * $v['sell_price'];
        }
        return $n;
    }
    /**
    * 清空购物车
    * @return void
    */
    public function clear(){
        $this->item = array();
    }

    public function __destruct(){
        session('shopcar',$this->item);
    }
}
