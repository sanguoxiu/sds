<?php
class Page {
	private $total; // 数据表中总记录数
	private $listRows; // 每页显示行数
	private $limit;
	private $uri;
	private $pageNum; // 页数
	private $config = array (
			'header' => "套三国秀",
			"prev" => "上一页",
			"next" => "下一页",
			"first" => "首 页",
			"last" => "尾 页" 
	);
	private $listNum = 8;
	private $action;
	private $type;
    
	public function __construct($total, $listRows = 10, $action = '', $type = '', $pa = '') {
		$this->total = $total;
		$this->listRows = $listRows;
		$this->uri = $this->getUri ( $pa );
		$this->pageNum = ceil ( $this->total / $this->listRows );
		if (empty ( $_GET ['page'] )) {
			$getpage = 1;
		} else if ($_GET ['page'] < 1) {
			$getpage = 1;
		} else if ($_GET ['page'] > $this->pageNum) {
			$getpage = $this->pageNum;
		} else if (preg_match ( '/[^\d- ]/', $_GET ['page'] )) {
			$getpage = 1;
		} else {
			$getpage = $_GET ['page'];
		}
		$this->page = $getpage;
		$this->action = $action;
		$this->type = $type;
        $this->limit = $this->setLimit ();
	}
	private function setLimit() {
		return "Limit " . ($this->page - 1) * $this->listRows . ", {$this->listRows}";
	}
	private function getUri($pa) {
		$url = $_SERVER ["REQUEST_URI"] . (strpos ( $_SERVER ["REQUEST_URI"], '?' ) ? '' : "?") . $pa;
		$parse = parse_url ( $url );
		
		if (isset ( $parse ["query"] )) {
			parse_str ( $parse ['query'], $params );
			unset ( $params ["page"] );
			$url = $parse ['path'] . '?' . http_build_query ( $params );
		}
		
		return $url;
	}
	function __get($args) {
		if ($args == "limit")
			return $this->limit;
		else
			return null;
	}
	private function start() {
		if ($this->total == 0)
			return 0;
		else
			return ($this->page - 1) * $this->listRows + 1;
	}
	private function end() {
		return min ( $this->page * $this->listRows, $this->total );
	}
	private function first() {
		if ($this->page == 1)
			$html .= '';
		else
            $html .= "&nbsp;&nbsp;<a href=\"javascript:void(0);\" onclick=\"{$this->action}('{$this->type}', 1);\">{$this->config['first']}</a>&nbsp;&nbsp;";
		return $html;
	}
	private function prev() {
		if ($this->page == 1)
			$html .= '';
		else
            $html .= "&nbsp;&nbsp;<a href=\"javascript:void(0);\" onclick=\"{$this->action}('{$this->type}', " . ($this->page - 1) . ");\">{$this->config['prev']}</a>&nbsp;&nbsp;";
		return $html;
	}
	private function pageList() {
		$linkPage = "";
		
		$inum = floor ( $this->listNum / 2 );
		
		for($i = $inum; $i >= 1; $i --) {
			$page = $this->page - $i;
			
			if ($page < 1)
				continue;
            $linkPage .= "&nbsp;<a href=\"javascript:void(0);\" onclick=\"{$this->action}('{$this->type}', {$page});\">{$page}</a>&nbsp;";
		}
		
		$linkPage .= "&nbsp;{$this->page}&nbsp;";
		
		for($i = 1; $i <= $inum; $i ++) {
			$page = $this->page + $i;
			if ($page <= $this->pageNum)
                $linkPage .= "&nbsp;<a href=\"javascript:void(0);\" onclick=\"{$this->action}('{$this->type}', {$page});\">{$page}</a>&nbsp;";
			else
				break;
		}
		
		return $linkPage;
	}
	private function next() {
		if ($this->page == $this->pageNum)
			$html .= '';
		else
            $html .= "&nbsp;&nbsp;<a href=\"javascript:void(0);\" onclick=\"{$this->action}('{$this->type}', " . ($this->page + 1) . ");\">{$this->config['next']}</a>&nbsp;&nbsp;";
		return $html;
	}
	private function last() {
		if ($this->page == $this->pageNum)
			$html .= '';
		else
            $html .= "&nbsp;&nbsp;<a href=\"javascript:void(0);\" onclick=\"{$this->action}('{$this->type}', " . ($this->pageNum) . ");\">{$this->config['last']}</a>&nbsp;&nbsp;";
		return $html;
	}
	private function goPage() {
        return "&nbsp;&nbsp;<input type=\"text\" onclick=\"this.select();\" onkeydown=\"javascript:if(event.keyCode==13){var page=(this.value> {$this->pageNum} )?{$this->pageNum}:this.value;{$this->action}('{$this->type}', page)}\" value=\"{$this->page}\" style=\"width:25px\" />&nbsp;&nbsp;<input type=\"button\" class=\"input_submit\" value=\"跳转\" onclick=\"javascript:var page=(this.previousSibling.value>{$this->pageNum})?{$this->pageNum}:this.previousSibling.value;{$this->action}('{$this->type}', page)\">&nbsp;&nbsp;";
	}
	function fpage($display = array(0,1,2,3,4,5,6,7,8)) {
		$html [0] = "&nbsp;&nbsp;共有<b>{$this->total}</b>{$this->config["header"]}&nbsp;&nbsp;";
		$html [1] = "&nbsp;&nbsp;每页显示<b>" . ($this->end () - $this->start () + 1) . "</b>套，本页<b>{$this->start()}-{$this->end()}</b>套&nbsp;&nbsp;";
		$html [2] = "&nbsp;&nbsp;第<b>{$this->page}/{$this->pageNum}</b>页&nbsp;&nbsp;";
		
		$html [3] = $this->first ();
		$html [4] = $this->prev ();
		$html [5] = $this->pageList ();
		$html [6] = $this->next ();
		$html [7] = $this->last ();
		$html [8] = $this->goPage ();
		$fpage = '';
		foreach ( $display as $index ) {
			$fpage .= $html [$index];
		}
		return $fpage;
	}
}