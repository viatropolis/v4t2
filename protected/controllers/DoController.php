<?php class DoController extends Controller {

	public $themes=array(
		'Gavoratizon'=>array('gstart'=>'212121','gend'=>'000000'),
		'Mo'=>array('gstart'=>'4B4B4B', 'gend'=>'2F2F2F'),
		'Makoto'=>array('gstart'=>'BAA7FF', 'gend'=>'9385D0'),
		'Venus'=>array('gstart'=>'E0E000', 'gend'=>'BEBE00'),
		'Janusch'=>array('gstart'=>'FF0000', 'gend'=>'E00000'),
		'Anthy'=>array('gstart'=>'B52A62', 'gend'=>'992864'),
		'Dan&Gakuen'=>array('gstart'=>'0000FF', 'gend'=>'0000D5'),
		"Shi'ran"=>array('gstart'=>'FF9D00', 'gend'=>'BC7400'),
		'Leon'=>array('gstart'=>'985E00', 'gend'=>'623C00'),
		'Judgement Dragon'=>array('gstart'=>'E8E274', 'gend'=>'B0AA49'),
		'Aria'=>array('gstart'=>'C20000', 'gend'=>'8B0000'),
		'Xian'=>array('gstart'=>'FFFFFF', 'gend'=>'ECECEC'),
		'Dayori'=>array('gstart'=>'0000BA', 'gend'=>'00008E'),
		'Legiza'=>array('gstart'=>'FFAFFF', 'gend'=>'FE86FE'),
		'Ceinios'=>array('gstart'=>'96D84F', 'gend'=>'75AA3D'),
		'Ranshiin'=>array('gstart'=>'4169E4', 'gend'=>'6699CC'),
		"Alter're"=>array('gstart'=>'C500D7', 'gend'=>'A83BB2'),
		'Rier'=>array('gstart'=>'FF2600', 'gend'=>'E32A00'),
		"Ess'radu"=>array('gstart'=>'C8E0FF', 'gend'=>'8EBFFF'),
		'Kyrziz'=>array('gstart'=>'85ffdf', 'gend'=>'71CCA5'),
		'Totus'=>array('gstart'=>'d5c988', 'gend'=>'ACA26D'),
		'Blaze'=>array('gstart'=>'FF3ad5', 'gend'=>'C80084'),
		'Minecraft'=>array('gstart'=>'5DC800', 'gend'=>'7F5500'),
		'Nether'=>array('gstart'=>'985967', 'gend'=>'773847'),
		'End' =>array('gstart'=>'3CD097', 'gend'=>'1E8B61'),
		'Leviathan-Landon' =>array('gstart'=>'F8FFD2', 'gend'=>'DAE0B8'),
		'Bloodlust'=>array('gstart'=>'6F0000', 'gend'=>'5B0000'),
		'Mermaid'=>array('gstart'=>'00518f', 'gend'=>'003963'),
		'Royalty'=>array('gstart'=>'735989', 'gend'=>'584469'),
		'D'=>array('gstart'=>'740a00', 'gend'=>'000000'),
		'Black Ice'=>array('gstart'=>'3d656d', 'gend'=>'000000'),
		'Genom'=>array('gstart'=>'1f567a', 'gend'=>'003366'),
		'Corpse Party'=>array('gstart'=>'743d46', 'gend'=>'000000')
	);

	/*public function actionIndex() {
		foreach($this->themes as $name=>$detail) {
			$t = new Themes;
			$t->name=$name;
			$t->gstart=$detail['gstart'];
			$t->gend=$detail['gend'];
			if(!isset($detail['shadow']))
				$t->shadow=$detail['gstart'];
			else
				$t->shadow=$detail['shadow'];
			if($t->save())
				echo "[$t->name]--> Saved. <br>\n";
			else {
				echo "ERROR.";
				print_r($t->errors);
				echo "\n";
				break;
			}
		}
	}*/
	
	public function actionIndex() {
		$this->render("index");
	}

} ?>