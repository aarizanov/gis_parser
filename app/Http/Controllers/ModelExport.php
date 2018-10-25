<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use File;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ModelExports;

class ModelExportController extends Controller
{

	public function generateExcel()
	{
		$modelName = request()->segment(2);
		$modelFiles 		= public_path("models/$modelName/output_data"); //path to the output model files
		$fileList = File::files($modelFiles);

		$excelData = [];


		$heds = ['"NAME"',
				'hed1',
				'hed2',
				'hed3',
				'hed4',
				'hed5',
				'hed6',
				'hed7',
				'hed8',
				'hed9',
				'hed10',
				'hed11',
				'hed12',
				'hed13',
				'hed14',
				'hed15',
				'hed16',
				'hed17',
				'hed18',
				'hed19',
				'hed20',
				'hed21',
				'hed22',
				'hed23',
				'hed24',
				'hed25',
				'hed26',
				'hed27',
				'hed28',
				'hed29',
				'hed30',
				'hed31',
				'hed32',
				'hed33',
				'hed34',
				'hed35',
				'hed36',
				'hed37',
				'hed38',
				'hed39',
				'hed40',
				'hed41',
				'hed42',
				'hed43',
				'hed44',
				'hed45',
				'hed46',
				'hed47',
				'hed48',
				'hed49',
				'hed50',
				'hed51',
				'hed52',
				'hed53',
				'hed54',
				'hed55',
				'hed56',
				'hed57',
				'hed58',
				'hed59',
				'hed60',
				'hed61',
				'hed62',
				'hed63',
				'hed64',
				'hed65',
				'hed66',
				'hed67',
				'hed68',
				'hed69',
				'hed70',
				'hed71',
				'hed72',
				'hed73',
				'hed74',
				'hed75',
				'hed76',
				'hed77',
				'hed78',
				'hed79',
				'hed80',
				'hed81',
				'hed82',
				'hed83',
				'hed84',
				'hed85',
				'hed86',
				'hed87',
				'hed88',
				'hed89',
				'hed90',
				'hed91',
				'hed92',
				'hed93',
				'hed94',
				'hed95',
				'hed96',
				'hed97',
				'hed98',
				'hed99',
				'hed100',
				'hed101',
				'hed102',
				'hed103',
				'hed104',
				'hed105',
				'hed106',
				'hed107',
				'hed108',
				'hed109',
				'hed110',
				'hed111',
				'hed112',
				'hed113',
				'hed114',
				'hed115',
				'hed116',
				'hed117',
				'hed118',
				'hed119',
				'hed120',
				'hed121',
				'hed122',
				'hed123',
				'hed124',
				'hed125',
				'hed126',
				'hed127',
				'hed128',
				'hed129',
				'hed130',
				'hed131',
				'hed132',
				'hed133',
				'hed134',
				'hed135',
				'hed136',
				'hed137',
				'hed138',
				'hed139',
				'hed140',
				'hed141',
				'hed142',
				'hed143',
				'hed144',
				'hed145',
				'hed146',
				'hed147',
				'hed148',
				'hed149',
				'hed150',
				'hed151',
				'hed152',
				'hed153',
				'hed154',
				'hed155',
				'hed156',
				'hed157',
				'hed158',
				'hed159',
				'hed160',
				'hed161',
				'hed162',
				'hed163',
				'hed164',
				'hed165',
				'hed166',
				'hed167',
				'hed168',
				'hed169',
				'hed170',
				'hed171',
				'hed172',
				'hed173',
				'hed174',
				'hed175',
				'hed176',
				'hed177',
				'hed178',
				'hed179',
				'hed180',
				'hed181',
				'hed182',
				'hed183',
				'hed184',];

		$obs = [
			'"OBS"',
			'100E-02',
			'100E-02',
			'100E-02',
			'100E-02',
			'100E-02',
			'100E-02',
			'100E-02',
			'100E-02',
			'447E+01',
			'494E+01',
			'494E+01',
			'494E+01',
			'454E+01',
			'429E+01',
			'488E+01',
			'429E+01',
			'429E+01',
			'429E+01',
			'429E+01',
			'429E+01',
			'495E+01',
			'476E+01',
			'491E+01',
			'442E+01',
			'442E+01',
			'442E+01',
			'496E+01',
			'491E+01',
			'509E+01',
			'504E+01',
			'435E+01',
			'437E+01',
			'439E+01',
			'447E+01',
			'447E+01',
			'450E+01',
			'448E+01',
			'448E+01',
			'455E+01',
			'479E+01',
			'452E+01',
			'450E+01',
			'449E+01',
			'452E+01',
			'447E+01',
			'448E+01',
			'452E+01',
			'449E+01',
			'446E+01',
			'448E+01',
			'451E+01',
			'451E+01',
			'448E+01',
			'447E+01',
			'449E+01',
			'452E+01',
			'438E+01',
			'462E+01',
			'434E+01',
			'434E+01',
			'445E+01',
			'446E+01',
			'442E+01',
			'433E+01',
			'437E+01',
			'436E+01',
			'439E+01',
			'495E+01',
			'430E+01',
			'429E+01',
			'429E+01',
			'431E+01',
			'429E+01',
			'446E+01',
			'456E+01',
			'429E+01',
			'429E+01',
			'429E+01',
			'429E+01',
			'429E+01',
			'433E+01',
			'438E+01',
			'438E+01',
			'436E+01',
			'447E+01',
			'439E+01',
			'439E+01',
			'437E+01',
			'434E+01',
			'444E+01',
			'435E+01',
			'429E+01',
			'429E+01',
			'429E+01',
			'433E+01',
			'433E+01',
			'437E+01',
			'438E+01',
			'459E+01',
			'459E+01',
			'459E+01',
			'468E+01',
			'468E+01',
			'459E+01',
			'460E+01',
			'470E+01',
			'488E+01',
			'474E+01',
			'435E+01',
			'442E+01',
			'438E+01',
			'437E+01',
			'438E+01',
			'438E+01',
			'433E+01',
			'433E+01',
			'437E+01',
			'435E+01',
			'438E+01',
			'436E+01',
			'433E+01',
			'432E+01',
			'431E+01',
			'437E+01',
			'437E+01',
			'435E+01',
			'437E+01',
			'444E+01',
			'444E+01',
			'459E+01',
			'437E+01',
			'504E+01',
			'500E+01',
			'543E+01',
			'592E+01',
			'453E+01',
			'479E+01',
			'453E+01',
			'488E+01',
			'559E+01',
			'539E+01',
			'594E+01',
			'609E+01',
			'635E+01',
			'561E+01',
			'559E+01',
			'437E+01',
			'438E+01',
			'464E+01',
			'451E+01',
			'567E+01',
			'561E+01',
			'531E+01',
			'484E+01',
			'471E+01',
			'457E+01',
			'491E+01',
			'483E+01',
			'508E+01',
			'452E+01',
			'455E+01',
			'481E+01',
			'489E+01',
			'507E+01',
			'502E+01',
			'544E+01',
			'538E+01',
			'441E+01',
			'450E+01',
			'442E+01',
			'544E+01',
			'513E+01',
			'545E+01',
			'553E+01',
			'563E+01',
			'540E+01',
			'497E+01',
			'500E+01',
			'561E+01',
			'554E+01',
			'509E+01',
			'518E+01',
			'531E+01',
			'551E+01',
		];

		array_push($excelData, $heds);
		array_push($excelData, $obs);

		foreach( $fileList as $file )
		{
			$fileData = pathinfo($file);

			// $chechNameNumber = str_replace( $modelName.'_', '', $fileData['filename'] );
			// if( $chechNameNumber < 10 )
			// {
			// 	if( substr( $chechNameNumber, 0, 1 ) != '0' )
			// 	{
			// 	$new_name = str_replace( $modelName.'_', $modelName.'_0', $fileData['filename'] );
			// 	rename($file, public_path("models/$modelName/output_data/".$new_name.'.'.$fileData['extension']));
			// 	}
			// }
				
			// read the output files and store them in array
			if ( $fileData['extension'] == 'out' )
			{
				$file = File::get($modelFiles.'/'.$fileData['filename'].'.'.$fileData['extension']);
				
				// check if file converged
				if ( strpos($file, 'Elapsed run time') !== false )
				{					
					$item = [];
					
					$osFile = File::get($modelFiles.'/'.$fileData['filename'].'._os');

					$item[] = $fileData['filename'];

					$osFileLines = explode('\r\n', json_encode($osFile) );

					foreach( $osFileLines as $key => $line )
					{
						if( $key > 0 && strlen($line) > 3 )
						{
							$item[] = (float) substr( $line, 3, 17 );
						}
					}
					array_push( $excelData, $item );
				}
			}
		}

		// flip the array 
		$preparedForExport = [];

	    foreach ($excelData as $key => $subarr) 
	    {
	        foreach ($subarr as $subkey => $subvalue) 
	        {
	            $preparedForExport[$subkey][$key] = $subvalue;
	        }
	    }

	    // generate the excel file
		return Excel::create('ModelExport', function($excel) use ($preparedForExport) {
            $excel->sheet('mySheet', function($sheet) use ($preparedForExport)
            {                                
                if (!empty($preparedForExport)) 
                {                    
                	$sheet->fromArray($preparedForExport, null, 'A1', false, false);
                }
            });
        })->download('xlsx');
	}

}