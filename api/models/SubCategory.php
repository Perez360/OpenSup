<?php
use RedBeanPHP\Facade as RedBean;

/**
 * @api {OBJECT} Subcategory Subcategory
 * @apiVersion 4.11.0
 * @apiGroup Data Structures
 * @apiParam {Number} id Id of the subcategory.
 * @apiParam {String} name Name of the subcategory.
 * @apiParam {Date} created_at when subcategory was created 
 */


class SubCategory extends DataStore {
    const TABLE = 'subcategory';

    public static function getProps() {
        return [
            'id',
            'name',
            'category_id',
            'date'
        ];
    }

    public static function getAllByCategoryId($categoryId) {
        $allSubCategories = RedBean::findAll(SubCategory::TABLE);
        $subCategoryList = [];

        foreach($allSubCategories as $subCategory) {
            if ($subCategory->category_id==$categoryId) {
                $subCategoryList[] = [
                    'id' => $subCategory->id,
                    'name' => $subCategory->name,
                    'date' => $subCategory->date
                ];
            }
        }
        return $subCategoryList;
    }

    public function toArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'categoryId' => $this->category_id,
            'date' => $this->date
        ];
    }
}
