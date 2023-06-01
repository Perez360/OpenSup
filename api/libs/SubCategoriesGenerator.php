<?php

class SubCategoriesGenerator  {

    public static function generateSubCategories ($departmentObject){
        $departmentObject =json_decode($departmentObject);
        $departmentId = $departmentObject->departmentId;
        $categoryId = $departmentObject->categoryId;
        $subCategoryId = $departmentObject->subCategoryId;

        $subCategories=[]

        if(!is_null($departmentId) && is_null($categoryId) && is_null($subCategoryId){
            $categories = \Categories::getAllByDepartmentId($departmentId);
            foreach ($categories as  $category) {
                $listOfSubCategories=[]
                foreach ($category->subCategories as $subCategory) {
                    array_push($subCategories, $subCategory->id);
                }
            }

        } elseif (!is_null($departmentId) && !is_null($categoryId) && is_null($subCategoryId)) {
            $subCategories = \SubCategory::getAllByCategoryId($categoryId);
            foreach ($subCategories as $subCategory) {
                array_push($subCategories, $subCategory->id);
            }
        } elseif (!is_null($departmentId) && !is_null($categoryId) && !is_null($subCategoryId)){
            $subCategories[$subCategoryId];
        } else {
            $subCategories[];
        }

        echo json_encode($subCategories);

        return $subCategories;
    }
}
