<?php
use RedBeanPHP\Facade as RedBean;
require_once 'SubCategory.php';
/**
 * @api {OBJECT} Category Category
 * @apiVersion 4.11.0
 * @apiGroup Data Structures
 * @apiParam {Number} id Id of the category.
 * @apiParam {String} name Name of the category.
 * @apiParam {Date} created_at date when created
 */

class Category extends DataStore {
    const TABLE = 'category';

    public static function getProps() {
        return [
            'id',
            'name',
            'department_id',
            'date'
        ];
    }

    public static function getAllByDepartmentId($departmentId) {
        $allCategoryList = RedBean::findAll(Category::TABLE);
        $categoryList = [];

        foreach($allCategoryList as $category) {
            if ($category->department_id==$departmentId) {
               $categoryList[] = [
                    'id' => $category->id,
                    'name' => $category->name,
                    'subCategories' => Subcategory::getAllByCategoryId($category->id),
                    'date' => $category->date
                ];
            }
        }

        return $categoryList;
    }

    public function toArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'department_id' =>$this->department_id,
            'subCategories' => SubCategory::getAllByCategoryId($this->id),
            'date' => $this->date
        ];
    }
}
