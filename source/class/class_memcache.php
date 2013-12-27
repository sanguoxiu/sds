<?php
if (! defined ( 'IN_SGS' ))
	exit ( 'Access Denied' );
class MCACHE{
	public function enable(){
		$object = MCACHE::object();
		if(!$object) return false;
		if($object->get('test')) return true;
		$object->set('test', '1');
		return $object->get('test');
	}
    public function isAvailable($k){
		$object = MCACHE::object($k);
		if(!$object) return false;
		if($object->get($k)) return true;
        return $object->get($k);
	}
	public function object(){
		static $obj;
		if(defined('MEMCACHE_INITED')) return $obj;
		$obj = memcache_init();
		define('MEMCACHE_INITED', 'true');
		return $obj;
	}
	function clear(){
		$obj = MCACHE::object();
		if(!$obj) return;
		return $obj->clear();
	}
	function get($key){
		$obj = MCACHE::object();
		if(!$obj) return;
		return $obj->get($key);
	}
	function save($key, $value, $exp = 0){
		$obj = MCACHE::object();
		if(!$obj) return;
		return $obj->set($key, $value, $exp);
	}
	function delete($key){
		$obj = MCACHE::object();
		if(!$obj) return;
		return $obj->delete($key);
	}
}