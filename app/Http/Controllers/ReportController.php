<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tournament;

class ReportController extends Controller
{
	public function csvCompetition(Request $request, $id)
	{
		$tournament = Tournament::findOrFail($id);
		header("Content-type: text/csv; charset=utf-8");
		header("Content-Disposition:attachment; filename=$tournament->slug.csv");
		header("Pragma: no-cache");
		header("Expires: 0");
		$columns = array('sutaz', 'idpar', 'idMuz', 'Menomuz', 'idZena', 'Menozena', 'klub', 'stat', 'Dorsal');
		$str_lg = '';
		foreach ($tournament->prices as $p) {
			foreach ($p->inscriptions as $i) {
				$str = '';
				// sutaz -> CATEGORIAS
				if ($p->category_id == 1) {
					$str = 'OPEN ';
					$str .= $p->subO->name;
				} elseif ($p->category_id == 2) {
					$str = 'LAT '; // Latino
					$str .= $p->subL->name;
					$str .= ' - ' . $p->subL->category_latino->name;
				} else {
					$str = 'STD '; // Standard
					$str .= $p->subS->name;
					$str .= ' - ' . $p->subS->category_standar->name;
				}
				$str .= ';';
				// idpar -> ID de la pareja
				$str .= $i->user_id . ';';
				// idMuz -> ID del Bailarín
				$str .= ';';
				// Menomuz -> nombre de la Bailarín
				$str .= "$i->last_name_1, $i->name_1" . ';';
				// idZena -> ID del Bailarina
				$str .= ';';
				// Menozena -> nombre de la Bailarina
				$str .= "$i->last_name_2, $i->name_2" . ';';
				// klub -> Club
				$str .= $i->user->club->name . ';';
				// stat -> Nacionalidad
				$str .= 'España;';
				// dorsal
				$str .= $i->dorsal . ';';
				$str_lg .= $str .= "\n";
			}
		}
		$str_lg .= 'sutaz; idpar; idMuz; Menomuz; idZena;Menozena; klub; stat; Dorsal';
		echo $str_lg . "\n";
		return;
	}
}
