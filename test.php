<?
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_admin_before.php");
CModule::IncludeModule("iblock");
$path = $_SERVER["DOCUMENT_ROOT"]."/examples/download/files";
parsing_data($path);

echo '<br>Working...';
$el = new CIBlockElement;
$tm = new CIBlock;

$arLoadProductArray = Array(
  "MODIFIED_BY"    => $USER->GetID(), 
  "IBLOCK_SECTION_ID" => false,         
  "IBLOCK_ID"      => 2,
  "PROPERTY_VALUES"=> ['ID'=>1,'name'=>'name1','preview_text'=>'prev_test1','detail_text'=>'det_test1','prop1'=>'op_test2','prop2'=>'op1_test1'],
  "NAME"           => "Элемент",
  "ACTIVE"         => "Y",            // активен
    
  );

$product = \Bitrix\Iblock\Elements\ElementProductsTable::getByPrimary(2);

#if($PRODUCT_ID = $el->Add($arLoadProductArray))
#  echo "New ID: ".$PRODUCT_ID;
#else
#  echo "Error: ".$el->LAST_ERROR;

function parsing_data($path){
	$csv_data = array_map('str_getcsv', file($path.'/test.csv'));
	$keys =  explode(';',$csv_data[0][0]);
	foreach($keys as $key){
		echo $key."<br>";
	}
	for ($i = 1 ;$i < count($csv_data); $i++){
		echo '<br>';
		
		$values = explode(';',$csv_data[$i][0]);
		\Bitrix\Iblock\TypeTable::add($values);
		for($j = 0; $j < count($csv_data); $j++){
			echo "|".$values[$j];
		}
	}
}

function show_block($items){
		foreach($items as $item){
			echo "<br>";
		foreach($item as $value){
			echo $value."|";
		}
	}
}
?>