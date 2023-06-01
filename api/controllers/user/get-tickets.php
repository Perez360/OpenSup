<?php
use Respect\Validation\Validator as DataValidator;

/**
 * @api {post} /user/get-tickets Get tickets
 * @apiVersion 4.11.0
 *
 * @apiName Get tickets
 *
 * @apiGroup Staff
 *
 * @apiDescription This path retrieves the tickets assigned to the current staff member.
 *
 * @apiPermission staff1
 *
 * @apiParam {Number} page The page number.
 * @apiParam {bool} closed Include closed tickets in the response.
 * @apiParam {Number} departmentId The id of the department searched
 * 
 * @apiUse NO_PERMISSION
 * @apiUse INVALID_PAGE
 *
 * @apiSuccess {Object} data Information about a tickets and quantity of pages.
 * @apiSuccess {[Ticket](#api-Data_Structures-ObjectTicket)[]} data.tickets Array of tickets assigned to the staff of the current page.
 * @apiSuccess {Number} data.page Number of current page.
 * @apiSuccess {Number} data.pages Quantity of pages.
 *
 */

class GetUserTicketController extends Controller {
    const PATH = '/get-tickets';
    const METHOD = 'POST';

    public function validations() {
        return [
            'permission' => 'user',
            'requestData' => [
                'page' => [
                    'validation' => DataValidator::numeric(),
                    'error' => ERRORS::INVALID_PAGE
                ]
            ]
        ];
    }

    public function handler() {
        $user = Controller::getLoggedUser();
        $closed = Controller::request('closed');
        $page = Controller::request('page');
        $departmentId = Controller::request('departmentId');
        $categoryId = Controller::request('categoryId');
        $subCategoryId = Controller::request('subCategoryId');
        $offset = ($page-1)*10;


        $condition = 'TRUE';
        $bindings = [];

        if(json_decode($departmentId)) {
            $condition .= ' AND department_id = ?';
            $bindings[] = $departmentId;
        }

         if(json_decode($categoryId)) {
            $condition .= ' AND category_id = ?';
            $bindings[] = $categoryId;
        }

         if(json_decode($subCategoryId)) {
            $condition .= ' AND subcategory_id = ?';
            $bindings[] = $subCategoryId;
        }

        if(!$closed) {
            $condition .= ' AND closed = ?';
            $bindings[] = '0';
        }

        $countTotal = $user->withCondition($condition, $bindings)->countShared('ticket');

        $condition .= ' LIMIT 10 OFFSET ?';
        $bindings[] = $offset;

        $tickets = $user->withCondition($condition, $bindings)->sharedTicketList->toArray(true);

        Response::respondSuccess([
            'tickets' => $tickets,
            'page' => $page,
            'pages' => ceil($countTotal / 10)
        ]);
    }
}
