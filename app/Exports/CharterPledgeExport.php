<?php

namespace App\Exports;

use App\Models\Admodels\CharterPledgeRegistrationModel;
use App\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Events\BeforeExport;
use \App\ExcelHelper;

class CharterPledgeExport implements FromView, ShouldAutoSize {

	protected $request;

	public function __construct($request) {
		$this->request = $request;
	}
	public function registerEvents(): View {
		return [
			AfterSheet::class => function (AfterSheet $excel) {
				$sheet->setFontSize(12);
			},
		];
	}

	public function view(): View{
		$type = 'excel';

		$tmp = CharterPledgeRegistrationModel::when(request()->input('cpr_name'), function ($q) {
			return $q->where('cpr_name', 'LIKE', '%' . strip_tags(request()->input('cpr_name')) . '%');
		})
			->when(request()->input('cpr_email_address'), function ($q) {
				return $q->where('cpr_email_address', '=', request()->input('cpr_email_address'));
			})
			->when(request()->input('cpr_nationality'), function ($q) {
				return $q->where('cpr_nationality', '=', request()->input('cpr_nationality'));
			})
			->when(request()->input('cpr_age_range'), function ($q) {
				$range = request()->input('cpr_age_range');
				$query = "";

				switch ($range) {
				case '0-16':
					$query = 'cpr_age > 0 AND cpr_age < 17';
					break;

				case '16-25':
					$query = 'cpr_age > 15 AND cpr_age < 26';
					break;

				case '26-40':
					$query = 'cpr_age > 25 AND cpr_age < 41';
					break;

				case '40-60':
					$query = 'cpr_age > 39 AND cpr_age < 61';
					break;

				case '60+':
					$query = 'cpr_age > 60';
					break;
				}

				return $q->whereRaw($query);
			})
			->when(request()->input('from_date'), function ($q) {
				return $q->where('created_at', '>=', date('Y-m-d', strtotime(request()->input('from_date'))));
			})
			->when(request()->input('to_date'), function ($q) {
				return $q->where('created_at', '<=', date('Y-m-d', strtotime(request()->input('to_date'))));
			})
			->orderBy('created_at', 'desc')
			->get();

		$submissionList = $tmp;
		$template = 'admin.charter-pledge-registrations.export';
		return view($template, ['submissionList' => $submissionList]);
	}
}