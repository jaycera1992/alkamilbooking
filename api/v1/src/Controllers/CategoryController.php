<?php
namespace App\Controllers;

use App\Models\Category;

use Respect\Validation\Validator as v;

/**
 * Class CategoryController
 * @package App\Controllers
 */

class CategoryController
{
    protected $category;
    protected $commonFunction;
    protected $passwordHash;

    public function __construct(Category $category)
    {
        $this->category         = $category;
    }

    /**
     * @param $request
     * @param $response
     * @return $response
     */
    
    public function addCategory($request, $response, $args) {

        $currentUserId = (!empty($args['user_id'])) ? $args['user_id'] : null;
        
        $data = $request->getParam("data");
        $data = (!empty($data)) ? json_decode($data) : null;
        
        if (empty($data) || empty($currentUserId)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false
            ));
        }

        $category = (!empty($data->category)) ? $data->category : null;
        
        if (v::nullType()->validate($category)) {

            return $response->withStatus(200)->withJson(array(
            'success' => false,
            'valid'   => false
            ));
        }

        $result = $this->category->addCategory($category);

        if (empty($result)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false,
                'error' => 'Category Creation'
            ));
        }
  
        $output = array(
            'success' => true,
            'data'    => $result,
        );

        return $response->withStatus(200)->withJson($output);
    }

    public function addGroceryMarket($request, $response, $args) {

        $currentUserId = (!empty($args['user_id'])) ? $args['user_id'] : null;
        
        $data = $request->getParam("data");
        $data = (!empty($data)) ? json_decode($data) : null;
        
        if (empty($data) || empty($currentUserId)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false
            ));
        }

        $categoryId = (!empty($data->categoryRef)) ? $data->categoryRef : null;
        
        if (v::nullType()->validate($categoryId)) {

            return $response->withStatus(200)->withJson(array(
            'success' => false,
            'valid'   => false
            ));
        }

        $result = $this->category->addGroceryMarket($categoryId);

        if (empty($result)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false,
                'error' => 'Category Creation'
            ));
        }
  
        $output = array(
            'success' => true,
            'data'    => $result,
        );

        return $response->withStatus(200)->withJson($output);
    }

    public function generateData($request, $response, $args) {

        $result = $this->category->generateData();

        if (empty($result)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false,
                'error' => 'Data Creation'
            ));
        }
  
        $output = array(
            'success' => true,
            'data'    => $result,
        );

        return $response->withStatus(200)->withJson($output);

    }

    public function getCategoryData($request, $response, $args)
    {   
        $currentUserId  = $args['user_id'];
        $offset         = ($args['offset'] == 1) ? 0 : $args['offset'] * 10     ;
        $limit  = 10;

        if(empty($currentUserId)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false
            ));
        }
        if($offset != 0) {
            $offset -= 10;
        }

        $result = $this->category->getCategoryData($limit, $offset);

        foreach ($result as $key => $value) {
            if ($result[$key]['date_created']) {
                $old_date_timestamp           = strtotime($value['date_created']);
                $result[$key]['date_created'] = date('F d Y', $old_date_timestamp); 
            }
        }
        
        if (empty($result)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false,
            ));
        }
  
        $output = array(
            'success' => true,
            'data'    => $result,
        );

        return $response->withStatus(200)->withJson($output);
    }

    public function getTotalCategory($request, $response, $args)
    {   
        $currentUserId  = $args['user_id'];

        if(empty($currentUserId)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false
            ));
        }

        $result = $this->category->getTotalCategory();

        if (empty($result)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false,
            ));
        }
  
        $output = array(
            'success' => true,
            'data'    => $result,
        );

        return $response->withStatus(200)->withJson($output);
    }

    public function getCategoryCount($request, $response, $args) {
        $currentUserId  = $args['user_id'];
        $categoryId  = $args['category_id'];

        if(empty($currentUserId) || empty($categoryId)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false
            ));
        }

        $result = $this->category->getCategoryCount($categoryId);

        if (empty($result)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false,
            ));
        }
  
        $output = array(
            'success' => true,
            'data'    => $result,
        );

        return $response->withStatus(200)->withJson($output);
    }

    public function getCategoryReference($request, $response, $args)
    {   
        $currentUserId  = $args['user_id'];

        if(empty($currentUserId)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false
            ));
        }

        $result = $this->category->getCategoryReference();
        
        if (empty($result)) {
            return $response->withStatus(200)->withJson(array(
                'success' => false,
            ));
        }
  
        $output = array(
            'success' => true,
            'data'    => $result,
        );

        return $response->withStatus(200)->withJson($output);
    }



}
