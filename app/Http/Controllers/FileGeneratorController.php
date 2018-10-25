<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use File;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ModelExports;
use Zip;

class FileGeneratorController extends Controller
{
	public function generator()
	{	
		$modelName = 'GSMv1_dt101918MS';

		$modelFiles 		= public_path("models/$modelName"); //path to model files
		$dummyUpw 			= public_path("models/$modelName/dummy/Dummy.upw"); // dummy upw path
		$dummyPval 			= public_path("models/$modelName/dummy/Dummy.pval"); // dummy pval path
		// $dummyMfn 			= public_path("models/$modelName/dummy/Dummy.mfn"); // dummy mfn file
		$paramFiles 		= public_path("models/$modelName/parameters/parameters.xls"); // path to excel sheet
		$jumpRowsInExcel 	= 3; //jump rows in excel files


		$dummyPvalArr = $this->getDummyPvalValues( $dummyPval ); // values for the model from the dummy pval file

		$fileList = File::files($modelFiles);  //model files

		$excelRows = Excel::load($paramFiles)->get(); //excel spreadsheet data		
		// dd($excelRows);
		$excelData = $this->generateArrayFromExcel( $excelRows, $jumpRowsInExcel );

		// dd($excelData);	

		foreach( $excelData as $key => $row )
		{
			$fileName = $row['aname'];
			unset($row['aname']);

			if( strpos($fileName, 'GSMv1') === false )
			{
				$fileName = 'GSMv1'.$fileName;
			}

			// $fileName = str_replace( 'GSMv1', 'GSMv6', $fileName );


			foreach( $fileList as $file )
			{
				$fileData = pathinfo($file);

				switch( $fileData['extension'] )
				{
					case 'pval':
						$fileString = '';
						$file = fopen($modelFiles.'/'.$fileName.'.'.$fileData['extension'], 'w');

						$fileString .= count($row) . "\r\n";
						foreach( $row as $rowName => $line )
						{
							$fileString .= strtoupper($rowName) . ' ' . $line . "\r\n";
						}
						fputs($file, $fileString);
					break;

					case 'upw':
						$fileString = '';
						$file = File::get($dummyUpw);
						$filewrite = fopen($modelFiles.'/'.$fileName.'.'.$fileData['extension'], 'w');
		
						$fileString = str_replace($dummyPvalArr, $row, $file);
						fputs($filewrite, $fileString);
						$fileString = '';
					break;

					case 'mfn':
						// $fileString = '';
						// $file = File::get($dummyMfn);
						// $filewrite = fopen($modelFiles.'/'.$fileName.'.'.$fileData['extension'], 'w');
		
						// $fileString = str_replace('Dummy', $fileName, $file);
						// fputs($filewrite, $fileString);
						// $fileString = '';
					break;

					default:
						// File::copy($file, $modelFiles.'/'.$fileName.'.'.$fileData['extension']);
					break;
				}
			}
		}
	}


	public static function generateArrayFromExcel( $fileData, $jumpRows = 0 )
	{
		$variablesArray = [];
		foreach( $fileData as $key => $row )
		{
			if( $key > $jumpRows )
			{ 	
				$item = [];
				foreach( $row as $a => $b )
				{
					if( $a === 0 )
						$item["aname"] = $b;
					else
						$item[$a] = $b;
				}

				ksort($item);

				array_push($variablesArray, $item);
			}
		}

		return $variablesArray;
	}


	public function getDummyPvalValues( $filePath )
	{
		$fileData = json_encode(File::get($filePath));
		
		$values = explode('\r\n', $fileData);

		$items = [];
		foreach( $values  as $key => $val )
		{
			if( $key > 0 && strlen($val) > 1 )
			{
				$thisRow = explode(' ', $val);
				$items[] = $thisRow[1];
			}
		} 

		return $items;
	}



	public function checkConvergance()
	{	
		// $modelName = 'GSMv6';
		$modelName = request()->segment(2);

		$modelFiles 		= public_path("models/$modelName/output_data"); //path to the output model files

		$checkedFiles = 0;
		$convergedFiles = [];
		$nonConvergedFiles = [];

		$fileList = File::files($modelFiles);  //output model files

		foreach( $fileList as $file )
		{
			$fileData = pathinfo($file);

			switch( $fileData['extension'] )
			{
				case 'out':
					$checkedFiles ++;

					$file = File::get($modelFiles.'/'.$fileData['filename'].'.'.$fileData['extension']);
					
					// if (strpos($file, 'CHD FLOW SUM OF SQUARED DIFFERENCE') !== false && strpos($file, 'Elapsed run time') !== false )
					if ( strpos($file, 'Elapsed run time') !== false )
					{
						$convergedFiles[] = $fileData['filename'];
					}
					else
					{
						$nonConvergedFiles[] = $fileData['filename'];	
					}
				break;

				default:
					// File::copy($file, $modelFiles.'/'.$fileName.'.'.$fileData['extension']);
				break;
			}
		}

		echo 'Checked: ' . $checkedFiles . ' files <br>';
		echo '-----------------------------------------------------------------------<br>';
		echo 'The number of models that did not converge is: ' . count($nonConvergedFiles) . '<br>';
		echo 'List of files that did not converge: <br>';
		foreach( $nonConvergedFiles as $ncf )
		{
			echo $ncf . '<br>';
		}

		echo '-----------------------------------------------------------------------<br>';

		echo 'The number of models that converge is: ' . count($convergedFiles) . '<br>';
		echo 'List of files that converge: <br>';
		foreach( $convergedFiles as $ncf )
		{
			echo $ncf . '<br>';
		}		
	}


	public function create_zip() 
	{

		$zip = Zip::create('file.zip');

		$modelName = request()->segment(2);

		$modelFiles 		= public_path("models/$modelName"); //path to model files
		
		$zip->add($modelFiles);
	}

}