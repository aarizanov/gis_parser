<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

use App\GisModel;
use File;

class GisModelsController extends Controller
{

	public function listModels()
	{	
		$models = GisModel::all();

		return view( 'list_models', compact( 'models' ) );
	}


	public function createModel()
	{	
		return view( 'create_model');
	}

	public function viewModel(Request $request)
	{	
		$segment = $request->segment(2);
		
		$theModel = GisModel::where( 'name', $segment )->first();

		$path = public_path("models/$theModel->name");
    	$dummyFilesPath = public_path("models/$theModel->name/dummy");
    	$excelExportFilesPath = public_path("models/$theModel->name/excel_export");
    	$outputFilesPath = public_path("models/$theModel->name/output_data");
    	$parametersFilePath = public_path("models/$theModel->name/parameters");
    	$generatedFilesPath = public_path("models/$theModel->name/model_versions");

		if( $theModel->id )
		{
			$filesList 				= File::files($path);
			$dummyFilesList 		= File::files($dummyFilesPath);
			$generatedFilesList 	= File::files($generatedFilesPath);
			$outputFilesList 		= File::files($outputFilesPath);

			// dd($fileList);
			
			return view( 'view_model', compact( 'theModel' ) );			
		}
		else
		{
			return redirect('list_models');
		}

	}

	public function postCreateModel(Request $request)
	{	
		$validation = $this->validate($request, [
	        'model_name' => 'required|min:3|max:255',
	    ]);

	    $modelName = str_replace( ' ', '_', $request->input('model_name') );

	    $the_model = GisModel::create([
            'name' => $modelName,
        ]);


	    if( $the_model->id )
	    {
	    	$path = public_path("models/$modelName");
	    	$dummyFilesPath = public_path("models/$modelName/dummy");
	    	$excelExportFilesPath = public_path("models/$modelName/excel_export");
	    	$outputFilesPath = public_path("models/$modelName/output_data");
	    	$parametersFilePath = public_path("models/$modelName/parameters");
	    	$generatedFilesPath = public_path("models/$modelName/model_versions");
	    	
	    	// create the directories
	    	File::makeDirectory($path, 					$mode = 0777, true, true);
	    	File::makeDirectory($dummyFilesPath, 		$mode = 0777, true, true);
	    	File::makeDirectory($excelExportFilesPath, 	$mode = 0777, true, true);
	    	File::makeDirectory($outputFilesPath, 		$mode = 0777, true, true);
	    	File::makeDirectory($parametersFilePath, 	$mode = 0777, true, true);
	    	File::makeDirectory($generatedFilesPath, 	$mode = 0777, true, true);
	    }

        // redirect
        return redirect('list_models')->with('status', 'success')->with('message', 'Successfully created!');
	}

}