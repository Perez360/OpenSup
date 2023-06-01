<?php
use RedBeanPHP\Facade as RedBean;
require_once 'Category.php';
/**
 * @api {OBJECT} Department Department
 * @apiVersion 4.11.0
 * @apiGroup Data Structures
 * @apiParam {Number} id Id of the department.
 * @apiParam {String} name Name of the department.
 * @apiParam {[Staff](#api-Data_Structures-ObjectStaff)[]} owners List of owners of the department.
 * @apiParam {Boolean} private Indicates if the departmetn is not shown to users.
 */

class Department extends DataStore {
    const TABLE = 'department';

    public static function getProps() {
        return [
            'id',
            'name',
            'sharedTicketList',
            'owners',
            'private'
        ];
    }

    public function getDefaultProps() {
        return [
            'owners' => 0
        ];
    }

    public static function getAllDepartmentNames() {
        $departmentsList = RedBean::findAll(Department::TABLE);
        $departmentsNameList = [];

        foreach($departmentsList as $department) {
            $departmentsNameList[] = [
                'id' => $department->id,
                'name' => $department->name,
                'owners' => $department->owners,
                'private' => $department->private,
                'categories' => Category::getAllByDepartmentId($department->id)
            ];
        }

        return $departmentsNameList;
    }

    public static function getPublicDepartmentNames() {
        $departmentsList = RedBean::findAll(Department::TABLE);
        $departmentsNameList = [];

        foreach($departmentsList as $department) {
            if(!$department->private) {
                $departmentsNameList[] = [
                    'id' => $department->id,
                    'name' => $department->name,
                    'owners' => $department->owners,
                    'private' => $department->private,
                    'categories' => Category::getAllByDepartmentId($department->id)
                ];
            }
        }

        return $departmentsNameList;
    }

    public function toArray() {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'owners' => $this->owners,
            'categories' => Category::getAllByDepartmentId($this->id)
        ];
    }
}
