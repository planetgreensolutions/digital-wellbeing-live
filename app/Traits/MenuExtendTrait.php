<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use Nestable\Services\NestableService;
use Closure;
use Nestable\NestableTrait;

trait MenuExtendTrait
{

	
	public function liAttr($attr, $value = ''){
		
		if (func_num_args() > 1) {
			$this->optionLiAttr[$attr] = $value;
		} elseif (is_array($attr)) {
			$this->optionLiAttr = $attr;
		}else if (is_callable($attr)) {
			$this->optionLiAttr['callback'] = $attr;
		}
		
		return $this;
	}
	
	public function firstUlAttr($attr, $value = '') {
        if (func_num_args() > 1) {
            $this->firstUlAttrs[$attr] = $value;
        } elseif (is_array($attr)) {
            $this->firstUlAttrs = $attr;
        }

        return $this;
    }

}