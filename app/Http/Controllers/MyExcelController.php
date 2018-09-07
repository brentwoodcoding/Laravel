<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;

class MyExcelController extends Controller
{
    public function loadExcel($value='')
    {
        ini_set('max_execution_time', 10*60); //seconds
	    
        echo "<pre>";

        $file = storage_path().'\testExcel.xlsx';
        $rows = Excel::selectSheetsByIndex(0)
		             ->load($file)
		             ->get();
		// dump($rows);
	    
		foreach ($rows as $key => $row) {
			$phone = str_replace(["(", ")", ".", " ", "+", "-"], "", $row->phone);
			if (strlen($phone) == 11) $rows[$key]["phone"] = $this->formatPhone($phone, 1);
			if (strlen($phone) == 10) $rows[$key]["phone"] = $this->formatPhone($phone, 2);
			// echo $rows[$key]->phone."<br>";
		}


		// write excel file
		$textExcel_new = [];
		$testExcel_new[] = ["Case #", "Client Name", "Representative Name", "Caller", "Phone  #", "Asbestos Injury", "Case Status"];

        foreach ($rows as $row) {
            $record = [];

            foreach ($row as $key => $value)
            {
                $record[] = $value;
            }

            $testExcel_new[] = $record;
        }

        Excel::create('testExcel_new', function($excel) use($testExcel_new) {
            $excel->sheet('test new sheet', function($sheet) use($testExcel_new) {
                $sheet->fromArray($testExcel_new, null, 'A1', true, false);
            });
        })->store('xls', storage_path());


        // read csv file
        $rows = $this->read_csv(storage_path(), 'testCSV.csv');
        // dump($rows);

		foreach ($rows as $key => $row) {
			$phone = str_replace(["(", ")", ".", " ", "+", "-"], "", $row["Phone #"]);
			if (strlen($phone) == 11) $rows[$key]["Phone #"] = $this->formatPhone($phone, 1);
			if (strlen($phone) == 10) $rows[$key]["Phone #"] = $this->formatPhone($phone, 2);
			// echo $rows[$key]["Phone #"]."<br>";
		}

		// write csv file
		$csv_header = ["Case #", "Client Name", "Representative Name", "Caller", "Phone  #", "Asbestos Injury", "Case Status"];
        
        $this->write_csv(storage_path(), "testCSV_new.csv", $csv_header, $rows);

	    dd();
    }

    /**
     * Convert phone_number to different format
     * option:
     *  1. 1xxxxxxxxxx to xxx-xxx-xxxx
     *  2.  xxxxxxxxxx to xxx-xxx-xxxx
     */
    private function formatPhone($phone_number, $option)
    {
        switch ($option) {
            case '1':
                $formatted_phone_number = substr($phone_number, 1, 3)."-".
                                          substr($phone_number, 4, 3)."-".
                                          substr($phone_number, 7);
                break;
            case '2':
                $formatted_phone_number = substr($phone_number, 0, 3)."-".
                                          substr($phone_number, 3, 3)."-".
                                          substr($phone_number, 6);
                break;
        }

        return $formatted_phone_number;
    }

    /**
     * Write csv file.
     *
     * @return void
     */
    public function write_csv($folder, $filename, $header, $records)
    {
        if (!file_exists($folder)) mkdir($folder, 0777, true);

        $filename = $folder.'/'.$filename;

        // dump($filename);

        $fp = fopen($filename, 'w');

        fputcsv($fp, $header);

        foreach ($records as $record) {
            fputcsv($fp, $record);
        }

        fclose($fp);

        // convert from unix to dos
        $unixfile = file_get_contents($filename);
        $dosfile  = str_replace("\n", "\r\n", $unixfile );
        file_put_contents($filename, $dosfile);
    }

    /**
     * Read csv file.
     *
     * @return associative array $records
     */
    public function read_csv($path, $filename, $delimiter = ",")
    {
        ini_set("auto_detect_line_endings", true);
        $filename = $path.'/'.$filename;

        if (!file_exists($filename)) {
            dump('File: '.$filename.' does not exist!');
            return [];
        }

        $rows = array_map(function ($input) use ($delimiter) {
            return str_getcsv($input, $delimiter);
        }, file($filename, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES));

        $header = array_shift($rows);

        $records = [];

        foreach($rows as $row) {
            $records[] = array_combine($header, $row);
        }

        return $records;
    }
}
