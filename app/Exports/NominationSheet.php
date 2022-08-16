<?php
namespace App\Exports;

use App\Models\Admodels\NominationModel;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithTitle;


class NominationSheet implements FromQuery, WithTitle
{
    private $nomination;
    private $request;

    public function __construct($nomination,$request)
    {
        $this->nomination = $nomination;
        $this->request = $request;
    }

    /**
     * @return Builder
     */
    public function query()
    {
		
		$query = $this->nomination::query();
		
		if($this->request->id){	
			$query->where('no_id',$this->request->id);
		}
		return ($query->first()->evaluation) ? $query->first()->evaluation : $query;
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'sheet';
    }
}