<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Validation\ValidationException;
use LumenRequestParser\Traits\RequestParserTrait;
use LumenRequestParser\Traits\RequestBuilderApplierTrait;

class TeamController extends Controller
{
    use RequestParserTrait;
    use RequestBuilderApplierTrait;

    private $partialPath = '/teams';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index2(Request $request)
    {
        $this->validate($request, [
            'page' => 'nullable|integer|min:1',
            'limit' => 'nullable|integer|min:1|max:100',
            'filter' => [
                'nullable',
                'regex:/^((id|name|code)+:(ct|nct|sw|ew|eq|ne|gt|ge|lt|le|in|nin)+:[^,]+,)*((id|name|code)+:(ct|nct|sw|ew|eq|ne|gt|ge|lt|le|in|nin)+:[^,]+)$/i',
            ],
            'sort' => [
                'nullable',
                'regex:/^([-+]?(id|name|code)+(,[-+]?(id|name|code)+)*)?$/i'
            ]
        ]);

        $options = [
            // 'sort' => 
            'limit' => 20
            // 'page' => 2
        ];

        $params = $this->parseQueryParams($request, $options);
        $query = team::query();
        $userPaginator = $this->applyParams($query, $params);

        // dd($query->toSql());
        return response()->json($userPaginator);
    }

    public function index(Request $request)
    {
        /**
         * REGEX FOR FILTER VALIDATION (Without specify field names)
         * /^([a-zA-Z]+:(ct|nct|sw|ew|eq|ne|gt|ge|lt|le|in|nin)+:[^,]+,)*([a-zA-Z]+:(ct|nct|sw|ew|eq|ne|gt|ge|lt|le|in|nin)+:[^,]+)$/i
         * REGEX FOR SORT VALIDATION (Without specify field names)
         * /^([-+]?[a-zA-Z]+(,[-+]?[a-zA-Z]+)*)?$/i
         */
        $this->validate($request, [
            'page' => 'nullable|integer|min:1',
            'limit' => 'nullable|integer|min:1|max:100',
            'filter' => [
                'nullable',
                'regex:/^((id|name|code)+:(ct|nct|sw|ew|eq|ne|gt|ge|lt|le|in|nin)+:[^,]+,)*((id|name|code)+:(ct|nct|sw|ew|eq|ne|gt|ge|lt|le|in|nin)+:[^,]+)$/i',
            ],
            'sort' => [
                'nullable',
                'regex:/^([-+]?(id|name|code)+(,[-+]?(id|name|code)+)*)?$/i'
            ]
        ]);

        /**
         * Operator	    Description	            Example
         * ct	        String contains         name:ct:Peter
         * nct          String NOT contains     name:nct:Peter
         * sw           String starts with      username:sw:admin
         * ew           String ends with        email:ew:gmail.com
         * eq           Equals                  level:eq:3
         * ne           Not equals              level:ne:4
         * gt           Greater than            level:gt:2
         * ge           Greater than or equal   level:ge:3
         * lt           Lesser than             level:lt:4
         * le           Lesser than or equal    level:le:3
         * in           In array                level:in:1|2|3
         * nin          Not in array            level:nin:1|2|3
         */

        $query = Team::query();

        $filters = $request->get('filter');
        $sorts = $request->get('sort') ?: 'id';

        $filterConditions = [];
        $sortConditions = [];

        if ($filters) {
            foreach (explode(',', $filters) as $filter) {
                list($field, $operator, $value) = explode(':', $filter);

                $table = $query->getModel()->getTable();
                $field1 = sprintf('%s.%s', $table, $field);

                $method = 'where';
                $clauseOperator = null;

                switch ($operator) {
                    case 'ct':
                        $value = '%' . $value . '%';
                        $clauseOperator = 'LIKE';
                        break;
                    case 'nct':
                        $value = '%' . $value . '%';
                        $clauseOperator = 'NOT LIKE';
                        break;
                    case 'sw':
                        $value .= '%';
                        $clauseOperator = 'LIKE';
                        break;
                    case 'ew':
                        $value = '%' . $value;
                        $clauseOperator = 'LIKE';
                        break;
                    case 'eq':
                        $clauseOperator = '=';
                        break;
                    case 'ne':
                        $clauseOperator = '!=';
                        break;
                    case 'gt':
                        $clauseOperator = '>';
                        break;
                    case 'ge':
                        $clauseOperator = '>=';
                        break;
                    case 'lt':
                        $clauseOperator = '<';
                        break;
                    case 'le':
                        $clauseOperator = '<=';
                        break;
                    default:
                        break;
                        // throw new BadRequestHttpException(sprintf('Not allowed operator: %s', $operator));
                }

                if ($operator === 'in') {
                    $query->whereIn($filter, explode('|', $value));
                } else {
                    call_user_func_array(
                        [$query, $method],
                        [$field1, $clauseOperator, $value]
                    );
                }

                // $filterConditions[] = [
                //     'field' => $field,
                //     'operator' => $operator,
                //     'value' => $value,
                // ];
            }

            // dd($filterConditions);
        }

        // dd([$query->toSql(), $filterConditions]);

        foreach (explode(',', $sorts) as $sort) {
            $order = $sort[0] === '-' ? 'DESC' : 'ASC';
            // $order = str_starts_with($sort, '-') ? 'DESC' : 'ASC';
            $field = in_array($sort[0], ['+', '-']) ? substr($sort, 1) : $sort;

            // $sortConditions[] = [
            //     'field' => $field,
            //     'order' => $order,
            // ];

            $query->orderBy($field, $order);
        }

        // dd([$sortConditions, $query->toSql()]);

        $teams = $query->get();

        $currentPage = $request->get('page') ?: '1';
        $pageSize = $request->get('limit') ?: '10';
        $collection = new Collection($teams);

        $paginatedData = new LengthAwarePaginator(
            $collection->forPage($currentPage, $pageSize),
            $collection->count(),
            $pageSize,
            $currentPage,
            [
                'path' => url($this->partialPath),
            ]
        );
// error_log(print_r($paginatedData, true), 3, __DIR__.'/mylog.log');
        return response()->json($paginatedData);

        
        // BEGIN - PAGINACIO NORMAL

        // $teams = Team::all();

        // $currentPage = $request->get('page') ?: '1';
        // $pageSize = $request->get('limit') ?: '10';
        // $collection = new Collection($teams);

        // $paginatedData = new LengthAwarePaginator(
        //     $collection->forPage($currentPage, $pageSize),
        //     $collection->count(),
        //     $pageSize,
        //     $currentPage,
        //     [
        //         'path' => url($this->partialPath),
        //     ]
        // );

        // return response()->json($paginatedData);

        // END - PAGINACIO NORMAL
    }
}
