<?php

// namespace namespace Respect\Validation\Exceptions;

// use Respect\Validation\Validator;

class ValidDepartmentObject extends \Respect\Validation\Rules {

    public function validate($departmentObject) {
    	$departmentObject =json_decode($departmentObject);
    	$departmentId = $departmentObject->departmentId;
    	$categoryId = $departmentObject->categoryId;
    	$subCategoryId = $departmentObject->subCategoryId;

    	if (!is_null($departmentId) && is_numeric($departmentId)) {
    		$department = \Department::getDataStore($departmentId, 'id');
    		if($department->isNull()) throw new Exception(Error::INVALID_DEPARTMENT);
    		
    	} else{
    		throw new Exception(Error::INVALID_INVALID);
    	}

    	if (!is_null($categoryId) && is_numeric($categoryId)) {
    		$category = \Category::getDataStore($categoryId, 'id');
    		if($departmentId->isNull()) {
    			throw new Exception(Error::INVALID_DEPARTMENT. '_FOR_CATEGORY_'.$categoryId);
    		}
    		if($category->isNull()){
    			throw new Exception(Error::INVALID_CATEGORY);
    		}
    	} else{
    		throw new Exception(Error::INVALID_CATEGORY);
    	}

    	if (!is_null($subCategoryId) && is_numeric($subCategoryId)) {
    		$subCategory = \SubCategory::getDataStore($subCategoryId, 'id');

    		if($categoryId->isNull()){
    			throw new Exception(Error::INVALID_CATEGORY.'_ FOR_SUBCATEGORY'.$subCategoryId);
    		}

    		if($subCategory->isNull()){
    			throw new Exception(Error::INVALID_SUBCATEGORY);
    		}
    	} else{
    		throw new Exception(Error::INVALID_SUBCATEGORY);
    	}
   }
}
