<?php

class TopCategoryPosition 
{  
	
	public function getTopCategoryPositionsByDate($date){
		global $f3;

        if( !(DateTime::createFromFormat('Y-m-d',$date)) ) {
            $f3->set('msg','Некорректный формат даты');
            return 0;
        }

        $url = "https://api.apptica.com/package/top_history/1421444/1?date_from=$date&date_to=$date&B4NKGg=fVN5Q9KVOlOHDx9mOsKPAQsFBlEhBOwguLkNEDTZvKzJzT3l";
        $context = stream_context_create(['http'=>[ 'method' => "GET"]]);
        $contents = json_decode(file_get_contents($url, false, $context), true);

        if ( ! empty($contents)) {
            foreach ( $contents['data'] as $category => $sub_category ){
                $topCategory = 999;
               
                foreach ( $sub_category as $sub_category_data ){
                    foreach ( $sub_category_data as $dateTop => $position ){

                        if ( $position < $topCategory && $date == $dateTop ){
                            $topCategory = $position;
                        }

                    }
                }
                if ( $topCategory == 999 || is_null($topCategory) ) {

                    $f3->set('msg','Отсутствуют данные на текущую дату');
                    return 0;

                } else {

                    $result[$category] = $topCategory;
                }
            } 
    
            return $result;

        } else {

            $f3->set('msg','ошибка обращения к Api');
            return 0;

        }
    }

}