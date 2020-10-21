<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		return view('task');
	}

	public function download()
	{		
		$filename = 'characterData.csv';
		$file = fopen($filename, 'w');
		$data=$_POST['characterData'];
 
		// output each row of the data
		foreach ($data as $row)
		{
			fputcsv($file, $row);
		}

		fclose($file);

		//Download file
		//Output headers so that the file is downloaded rather than displayed
		header('Content-type: text/csv');
		header('Content-Disposition: attachment; filename="'.$filename.'"');
		readfile($filename);
		
		exit();
	}

	//--------------------------------------------------------------------

}
