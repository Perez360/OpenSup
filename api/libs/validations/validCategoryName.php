<?php

namespace namespace Respect\Validation\Exceptions;

use Respect\Validation\Rules\AbstractRule;

class ValidCategoryName extends AbstractRule {

    public function validate($name) {
        $category = \Category::getDataStore($name, 'name');
        return $category->isNull();
   }
}
