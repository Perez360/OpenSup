<?php

namespace CustomValidations;

use Respect\Validation\Rules\AbstractRule;

class ValidSubCategoryName extends AbstractRule {

    public function validate($name) {
        $subCategory = \SubCategory::getDataStore($name, 'name');
        return $subCategory->isNull();
   }
}
