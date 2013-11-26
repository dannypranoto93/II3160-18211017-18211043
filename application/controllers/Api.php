<?php defined('BASEPATH') OR exit('No direct script access allowed');
	require APPPATH.'/libraries/REST_Controller.php';

	class Api extends REST_Controller {
	
		function __construct() {
			parent::__construct();
			$this->load->helper('file');
		}

		function xml_from_csv_get()
		{
			$filename = "./database_collection/csvdb.csv";
			$delimiter = ",";
			$header = NULL;
			$data = array();
			if (($handle = fopen($filename, 'r')) !== FALSE)
			{
				while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
				{
					if(!$header)
						$header = $row;
					else
						$data[] = array_combine($header, $row);
				}
				fclose($handle);
			}
			if($data)
			{
				$this->response($data, 200, 'csv', 'xml'); // 200 being the HTTP response code
			}
			else
			{
				$this->response(array('error' => 'Couldn\'t find any users!'), 404, 'csv', 'xml');
			}
		}
		
		function xml_from_xml_get(){
			$filename = "./database_collection/xmldb.xml";
			$sxe = simplexml_load_file($filename);
			$json = json_encode($sxe);
			$output_array = json_decode($json, TRUE);
			if($output_array)
			{
				$this->response($output_array, 200, 'xml', 'xml'); // 200 being the HTTP response code
			}
			else
			{
				$this->response(array('error' => 'Couldn\'t find any users!'), 404, 'xml', 'xml');
			}
		}
		
		function xml_from_sql_get(){
			//Melakukan koneksi ke dalam database, sebelumnya database sudah diimport ke dalam phpMySQL
			$conn = mysqli_connect('localhost', 'root', '', 'itb', '3306') or die("Error " . mysqli_error($conn));;
			//Tabel yang akan diakses adalah tabel mahasiswa
			$query = 'select * from mahasiswa' or die ("Error in accessing the table". mysql_error($conn));
			$data = $conn->query($query);
			$xml = new SimpleXMLElement('<itb></itb>'); //Membuat file format xml
			while($element=$data->fetch_field()){ 		
				while($row=$data->fetch_assoc()) //Pengulangan terjadi ketika data dalam $data masih ada
				{
					$element1 = $xml->addChild('mahasiswa'); //Menambah anak dari file xml, dalam hal ini menambahkan elemen mahasiswa ke dalam file xml
					foreach ($row as $element_data){
						$element2 = $element1->addchild($element->name, $element_data); //Menambah anak dari mahasiswa dengan atribut-atribut dalam tabel mahasiswa
					}
				}
			}
			Header('Content-type:text/xml');
			echo $xml->asXML(); //print file xml ke dalam web
			mysqli_close($conn); //Menutup koneksi database sql  
		}
		
		function html_from_xml_get(){
			$filename = "./database_collection/xmldb.xml";
			$sxe = simplexml_load_file($filename);
			$json = json_encode($sxe);
			$output_array = json_decode($json, TRUE);
			if($output_array)
			{
				$this->response($output_array, 200, 'xml', 'html'); // 200 being the HTTP response code
			}
			else
			{
				$this->response(array('error' => 'Couldn\'t find any users!'), 404, 'xml', 'html');
			}
		}
		
		function html_from_xml_all_get(){
			$filename1 = "../18211010-18211035/progin.xml";
			$filename2 = "../18211037/RestWebService/data/shortlist.xml";
			$filename3 = "../BintangAdinandra/menu.xml";
			$filename4 = "../II3160-18211003-18211050/menu.xml";
			$filename5 = "../II3160--Pemrograman-Integratif-/DaftarIdol.xml";
			$filename6 = "../II3160-Tugas1-Tugas2/tab2.xml";
			$filename7 = "../IPT-Assignments/data2.xml";
			$filename8 = "../pemrograman_integratif/output.xml";
			$filename9 = "../Pemrograman-Intergratif/dbxml.xml";
			$filename10 = "../progin/contoh.xml";
			$filename11 = "../Progint/data/xml/1.xml";
			$filename12 = "../BernadetteVina/DataXML.xml";
			$filename13 = "../testPHP2/test.xml";
			$filename14 = "../tugas-2-pemrograman-integratif/data3.xml";
			$filename15 = "../web-service/datasiswa.xml";
			$filename16 = "../Workspace/Menu.xml";
			$filename17 = "../Protif/Protif/database/rumah.xml";
			echo "<h1> Retrieve All XML Data from other URI </h1>";
			for ($i=1; $i<18; $i++){
				$namafile="filename".$i;
				echo "No.$i".$$namafile;
 				$xml = simplexml_load_file($$namafile);
				if (count($xml) != 0){					
					echo "<table border=\"1\">";
					foreach($xml->children()->children() as $child1){
						echo "<th>".$child1->getName()."</th>";
					}
					foreach($xml->children() as $child){
						echo "<tr>";
						foreach($child->children() as $child1){
							echo "<td>$child1</td>";
						}
						echo "</tr>";
					}				
					echo "</table>";
				}
				else {
					echo "Data Kosong";
				}
				echo "<br>";
			}
		}
	}