<?php

class PublicController extends MainController {
    
	public function __construct() {
		$this->constructorBody();
	}
    
    public function getTopCategoryPositions() {

		global $f3, $model;
        
		$model = new TopCategoryPosition();

        if($result = $model->getTopCategoryPositionsByDate($_GET['date'])){

			echo json_encode( [
                "status_code" => '200',
                "message" => "ok",
                "data"=>$result
            ]);

		} else {

            echo json_encode( [
                "status_code" => '400',
                "message" => $f3->get('msg'),
            ], JSON_UNESCAPED_UNICODE);

		}
    }
	
}